<?php

namespace App\Controller\Api;

use App\Entity\Triage;
use App\Repository\TriageRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class TriageController
 * @package App\Controller\Api
 * @SWG\Tag(name="Triage")
 */
class TriageController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/triage")
     * @param TriageRepository $triageRepository
     * @return View
     *
     * @SWG\Response(response=200, description="Regresa un listado",
     *     @SWG\Schema(type="array", @Model(type=Triage::class))
     * )
     *
     * @SWG\Response(response=404, description="HTTP_NOT_FOUND - La dirección con el Id solicitado no se encuentra.",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="success", type="string", description="El código del error.", example= "false"),
     *          @SWG\Property(property="error_description", type="string", description="Detalles del error.")
     *    )
     * )
     */
    public function index(TriageRepository $triageRepository): View
    {
        return View::create($triageRepository->findAll(), Response::HTTP_OK);
    }


    /**
     * @Rest\Get("/triage/{id}")
     * @param Triage $triage
     * @return View
     *
     * @SWG\Parameter(name="id", in="path", type="string", description="Triage resource Id")
     * @SWG\Response(response=200, description="Returns recorded clotting time.", @Model(type=Triage::class))
     * @SWG\Response(response=404, description="Triage not found.",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="code", type="string", example="Error code."),
     *          @SWG\Property(property="message", type="string", example="Triage not found.")
     *     )
     * )
     */
    public function show(Triage $triage): View
    {
        return View::create($triage);
    }

    /**
     * @Rest\Post("/triage")
     * @param ValidatorInterface $validator
     * @param Request $request
     * @return View
     *
     * @SWG\Parameter(name="body", in="body",
     *    @SWG\Schema(type="object",
     *         @SWG\Property(property="days_before_admission", type="integer", description="days_before_admission", example=""),
     *         @SWG\Property(property="difficulty_breathing", type="boolean", description="difficulty_breathing", example=""),
     *         @SWG\Property(property="chest_pain", type="boolean", description="chest_pain", example=""),
     *         @SWG\Property(property="headache", type="string", description="headache", example=""),
     *         @SWG\Property(property="cough", type="string", description="cough", example=""),
     *         @SWG\Property(property="other_symptoms", type="json", description="other_symptoms", example=""),
     *         @SWG\Property(property="comorbidities", type="json", description="comorbidities", example=""),
     *         @SWG\Property(property="smoker", type="boolean", description="smoker", example=""),
     *         @SWG\Property(property="pregnant", type="boolean", description="pregnant", example="")
     *    )
     * )
     *
     * @SWG\Response(response=200, description="Regresa el objecto creado", @Model(type=Triage::class))
     */
    public function create(Request $request, ValidatorInterface $validator): View
    {
        $triage = new Triage();
        $triage->setDaysBeforeAdmission($request->get('days_before_admission'));
        $triage->setDifficultyBreathing($request->get('difficulty_breathing'));
        $triage->setChestPain($request->get('chest_pain'));
        $triage->setHeadache($request->get('headache'));
        $triage->setCough($request->get('cough'));
        $triage->setOtherSymptoms($request->get('other_symptoms'));
        $triage->setComorbidities($request->get('comorbidities'));
        $triage->setSmoker($request->get('smoker'));
        $triage->setPregnant($request->get('pregnant'));
        
        //TODO: Revisar el caso cuando el usuario no manda un parámetro, formar un response 400
        $errors = $validator->validate($triage);
        if (count($errors) > 0) {
            return View::create($errors, Response::HTTP_BAD_REQUEST);
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($triage);
        $manager->flush();

        return View::create($triage);
    }

    /**
     * @Rest\Put("/triage/{id}")
     * @param Request $request
     * @param $id
     * @return View
     *
     * @SWG\Parameter(name="id", in="path", type="string", description="Edditing Triage ID")
     * @SWG\Parameter(name="body", in="body",
     *    @SWG\Schema(type="object",
     *         @SWG\Property(property="days_before_admission", type="integer", description="days_before_admission", example=""),
     *         @SWG\Property(property="difficulty_breathing", type="boolean", description="difficulty_breathing", example=""),
     *         @SWG\Property(property="chest_pain", type="boolean", description="chest_pain", example=""),
     *         @SWG\Property(property="headache", type="string", description="headache", example=""),
     *         @SWG\Property(property="cough", type="string", description="cough", example=""),
     *         @SWG\Property(property="other_symptoms", type="json", description="other_symptoms", example=""),
     *         @SWG\Property(property="comorbidities", type="json", description="comorbidities", example=""),
     *         @SWG\Property(property="smoker", type="boolean", description="smoker", example=""),
     *         @SWG\Property(property="pregnant", type="boolean", description="pregnant", example="")
     *    )
     * )
     * 
     * @SWG\Response(response=200, description="Regresa el objecto actualizado", @Model(type=Triage::class))
     * @SWG\Response(response=404, description="Triage resource not found.",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="code", type="string", example="Código del error"),
     *          @SWG\Property(property="message", type="string", example="Triage resource not found.")
     *     )
     * )
     */
    public function edit(Request $request, $id): View
    {
        $manager = $this->getDoctrine()->getManager();
        $triage = $manager->getRepository(Triage::class)->find($id);

        if(!$triage){
            return View::create(
                ["code" => 404, "message" => "¡Registro no encontrado!"],
                Response::HTTP_NOT_FOUND
            );
        }
        //TODO: Validate input
        $triage->setDaysBeforeAdmission($request->get('days_before_admission'));
        $triage->setDifficultyBreathing($request->get('difficulty_breathing'));
        $triage->setChestPain($request->get('chest_pain'));
        $triage->setHeadache($request->get('headache'));
        $triage->setCough($request->get('cough'));
        $triage->setOtherSymptoms($request->get('other_symptoms'));
        $triage->setComorbidities($request->get('comorbidities'));
        $triage->setSmoker($request->get('smoker'));
        $triage->setPregnant($request->get('pregnant'));
        $manager->flush();

        return View::create($triage);
    }

    /**
     * @Rest\Delete("/triage/{id}")
     * @param Triage $triage
     * @return View
     *
     * @SWG\Parameter(name="id", in="path", type="string", description="Triage Id to delete")
     * @SWG\Response(response=200, description="Returns deleted Entity", @Model(type=Triage::class))
     * @SWG\Response(response=404, description="Triages deleted",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="code", type="string", example="Código del error"),
     *          @SWG\Property(property="message", type="string", example="Triages deleted")
     *     )
     * )
     */
    public function delete(Triage $triage): View
    {
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($triage);
        $manager->flush();

        return View::create(['code' => 200, 'message' => '¡Registro eliminado correctamente!']);
    }
}
