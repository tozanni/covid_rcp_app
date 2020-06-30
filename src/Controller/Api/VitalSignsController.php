<?php

namespace App\Controller\Api;

use App\Entity\VitalSigns;
use App\Form\VitalSignsType;
use App\Repository\VitalSignsRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class VitalSignsController
 * @package App\Controller\Api
 * @SWG\Tag(name="VitalSigns")
 */
class VitalSignsController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/vital_signs")
     * @param VitalSignsRepository $vitalSignsRepository
     * @return View
     *
     * @SWG\Response(response=200, description="Regresa un listado",
     *     @SWG\Schema(type="array", @Model(type=VitalSigns::class))
     * )
     *
     * @SWG\Response(response=404, description="HTTP_NOT_FOUND - La dirección con el Id solicitado no se encuentra.",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="success", type="string", description="El código del error.", example= "false"),
     *          @SWG\Property(property="error_description", type="string", description="Detalles del error.")
     *    )
     * )
     */
    public function index(VitalSignsRepository $vitalSignsRepository): View
    {
        return View::create($vitalSignsRepository->findAll(), Response::HTTP_OK);
    }


    /**
     * @Rest\Get("/vital_signs/{id}")
     * @param VitalSigns $vitalSigns
     * @return View
     *
     * @SWG\Parameter(name="id", in="path", type="string", description="Vital Signs resource Id")
     * @SWG\Response(response=200, description="Returns recorded clotting time.", @Model(type=VitalSigns::class))
     * @SWG\Response(response=404, description="Vital Signs not found.",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="code", type="string", example="Error code."),
     *          @SWG\Property(property="message", type="string", example="Vital Signs not found.")
     *     )
     * )
     */
    public function show(VitalSigns $vitalSigns): View
    {
        return View::create($vitalSigns);
    }

    /**
     * @Rest\Post("/vital_signs")
     * @param ValidatorInterface $validator
     * @param Request $request
     * @return View
     *
     * @SWG\Parameter(name="body", in="body",
     *    @SWG\Schema(type="object",
     *         @SWG\Property(property="age", type="integer", description="age", example="54"),
     *         @SWG\Property(property="gender", type="string", description="gender", example="female"),
     *         @SWG\Property(property="weight", type="float", description="weight", example="85.5"),
     *         @SWG\Property(property="height", type="float", description="height", example="1.75"),
     *         @SWG\Property(property="diastolic_blood_pressure", type="float", description="diastolic_blood_pressure", example="98"),
     *         @SWG\Property(property="systolic_blood_pressure", type="floatr", description="systolic_blood_pressure", example="100"),
     *         @SWG\Property(property="heart_rate", type="float", description="heart_rate", example="120"),
     *         @SWG\Property(property="breathing_frequency", type="float", description="breathing_frequency", example="60"),
     *         @SWG\Property(property="temperature", type="float", description="temperature", example="34.0"),
     *         @SWG\Property(property="oximetry", type="float", description="oximetry", example="30"),
     *         @SWG\Property(property="capillary_glucose", type="float", description="capillary_glucose", example="35")
     *    )
     * )
     *
     * @SWG\Response(response=201, description="Regresa el objecto creado", @Model(type=VitalSigns::class))
     */
    public function create(Request $request): View
    {
        $body = $request->getContent();
        $data = json_decode($body, true);

        $vitalSigns = new VitalSigns();
        $form = $this->createForm(VitalSignsType::class, $vitalSigns);
        $form->submit($data);

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($vitalSigns);
        $manager->flush();

        return View::create($vitalSigns, Response::HTTP_CREATED);
    }

    /**
     * @Rest\Put("/vital_signs/{id}")
     * @param Request $request
     * @param $id
     * @return View
     *
     * @SWG\Parameter(name="id", in="path", type="string", description="Edditing Vital Signs ID")
     * @SWG\Parameter(name="body", in="body",
     *    @SWG\Schema(type="object",
     *         @SWG\Property(property="age", type="date", description="age", example=""),
     *         @SWG\Property(property="gender", type="string", description="gender", example=""),
     *         @SWG\Property(property="weight", type="integer", description="weight", example=""),
     *         @SWG\Property(property="height", type="integer", description="height", example=""),
     *         @SWG\Property(property="diastolic_blood_pressure", type="integer", description="diastolic_blood_pressure", example=""),
     *         @SWG\Property(property="systolic_blood_pressure", type="integer", description="systolic_blood_pressure", example=""),
     *         @SWG\Property(property="heart_rate", type="integer", description="heart_rate", example=""),
     *         @SWG\Property(property="breathing_frequency", type="integer", description="breathing_frequency", example=""),
     *         @SWG\Property(property="temperature", type="float", description="temperature", example=""),
     *         @SWG\Property(property="oximetry", type="integer", description="oximetry", example=""),
     *         @SWG\Property(property="capillary_glucose", type="integer", description="capillary_glucose", example="")
     *    )
     * )
     * 
     * @SWG\Response(response=200, description="Regresa el objecto actualizado", @Model(type=VitalSigns::class))
     * @SWG\Response(response=404, description="Vital Signs resource not found.",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="code", type="string", example="Código del error"),
     *          @SWG\Property(property="message", type="string", example="Vital Signs resource not found.")
     *     )
     * )
     */
    public function edit(Request $request, $id): View
    {
        $manager = $this->getDoctrine()->getManager();
        $vitalSigns = $manager->getRepository(VitalSigns::class)->find($id);

        if(!$vitalSigns){
            return View::create(
                ["code" => 404, "message" => "¡Registro no encontrado!"],
                Response::HTTP_NOT_FOUND
            );
        }
        //TODO: Validate input
        $vitalSigns->setAge($request->get('age'));
        $vitalSigns->setGender($request->get('gender'));
        $vitalSigns->setWeight($request->get('weight'));
        $vitalSigns->setHeight($request->get('height'));
        $vitalSigns->setDiastolicBloodPressure($request->get('diastolic_blood_pressure'));
        $vitalSigns->setSystolicBloodPressure($request->get('systolic_blood_pressure'));
        $vitalSigns->setHeartRate($request->get('heart_rate'));
        $vitalSigns->setBreathingFrequency($request->get('breathing_frequency'));
        $vitalSigns->setTemperature($request->get('temperature'));
        $vitalSigns->setOximetry($request->get('oximetry'));
        $vitalSigns->setCapillaryGlucose($request->get('capillary_glucose'));
        $manager->flush();

        return View::create($vitalSigns);
    }

    /**
     * @Rest\Delete("/vital_signs/{id}")
     * @param VitalSigns $vitalSigns
     * @return View
     *
     * @SWG\Parameter(name="id", in="path", type="string", description="Vital Signs Id to delete")
     * @SWG\Response(response=200, description="Returns deleted Entity", @Model(type=VitalSigns::class))
     * @SWG\Response(response=404, description="Vital Signss deleted",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="code", type="string", example="Código del error"),
     *          @SWG\Property(property="message", type="string", example="Vital Signss deleted")
     *     )
     * )
     */
    public function delete(VitalSigns $vitalSigns): View
    {
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($vitalSigns);
        $manager->flush();

        return View::create(['code' => 200, 'message' => '¡Registro eliminado correctamente!']);
    }
}
