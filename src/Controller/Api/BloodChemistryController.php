<?php
/**
 * Created by PhpStorm.
 * User: heriberto
 * Date: 9/05/20
 * Time: 10:47 PM
 */

namespace App\Controller\Api;

use App\Form\BloodChemistryType;
use App\Repository\BloodChemistryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Entity\BloodChemistry;

/**
 * Class BloodChemistryController
 * @package App\Controller\Api
 * @SWG\Tag(name="BloodChemistry")
 */
class BloodChemistryController extends AbstractFOSRestController
{
    use ProcessFormsTrait;

    /**
     * @Rest\Get("blood_chemistry")
     * @param BloodChemistryRepository $bloodChemistryRepository
     * @return View
     *
     * @SWG\Response(response=200, description="Regresa un listado",
     *     @SWG\Schema(type="array", @Model(type=BloodChemistry::class))
     * )
     *
     * @SWG\Response(response=404, description="HTTP_NOT_FOUND - La dirección con el Id solicitado no se encuentra.",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="success", type="string", description="El código del error.", example= "false"),
     *          @SWG\Property(property="error_description", type="string", description="Detalles del error.")
     *    )
     * )
     */
    public function index(BloodChemistryRepository $bloodChemistryRepository): View
    {
        return View::create($bloodChemistryRepository->findAll(), Response::HTTP_OK);
    }


    /**
     * @Rest\Get("/blood_chemistry/{id}")
     * @param BloodChemistry $bloodChemistry
     * @return View
     *
     * @SWG\Parameter(name="id", in="path", type="string", description="Blood Chemistry resource Id")
     * @SWG\Response(response=200, description="Returns recorded Blood Chemistry.", @Model(type=BloodChemistry::class))
     * @SWG\Response(response=404, description="Blood Chemistry not found.",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="code", type="string", example="Error code."),
     *          @SWG\Property(property="message", type="string", example="Blood Chemistry not found.")
     *     )
     * )
     */
    public function show(BloodChemistry $bloodChemistry): View
    {
        return View::create($bloodChemistry);
    }

    /**
     * @Rest\Post("blood_chemistry")
     * @param Request $request
     * @return View
     * @throws \Exception
     *
     * @SWG\Parameter(name="body", in="body",
     *    @SWG\Schema(type="object",
     *         @SWG\Property(property="glucose", type="integer", description="", example="10"),
     *         @SWG\Property(property="urea", type="integer", description="", example="12"),
     *         @SWG\Property(property="creatinine", type="integer", description="", example="13"),
     *         @SWG\Property(property="cholesterol", type="integer", description="", example="123"),
     *         @SWG\Property(property="triglycerides", type="integer", description="", example="12"),
     *         @SWG\Property(property="glycated_hemoglobin", type="integer", description="", example="65"),
     *    )
     * )
     *
     * @SWG\Response(response=200, description="Regresa el objecto creado", @Model(type=BloodChemistry::class))
     */
    public function create(Request $request): View
    {
        $bloodChemistry = new BloodChemistry();
        $form = $this->createForm(BloodChemistryType::class, $bloodChemistry);
        $this->processForm($request, $form);

        if (!$form->isValid()) {
            return $this->createValidationErrorResponse($form);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($bloodChemistry);
        $entityManager->flush();

        return View::create($bloodChemistry, Response::HTTP_CREATED);
    }

    /**
     * @Rest\Put("/blood_chemistry/{id}")
     * @param Request $request
     * @param BloodChemistry $bloodChemistry
     * @return View
     *
     * @SWG\Parameter(name="id", in="path", type="string", description="Edditing Blood Chemistry ID")
     * @SWG\Parameter(name="body", in="body",
     *    @SWG\Schema(type="object",
     *         @SWG\Property(property="glucose", type="integer", description="", example="10"),
     *         @SWG\Property(property="urea", type="integer", description="", example="12"),
     *         @SWG\Property(property="creatinine", type="integer", description="", example="13"),
     *         @SWG\Property(property="cholesterol", type="integer", description="", example="123"),
     *         @SWG\Property(property="triglycerides", type="integer", description="", example="12"),
     *         @SWG\Property(property="glycated_hemoglobin", type="integer", description="", example="65"),
     *    )
     * )
     * @SWG\Response(response=200, description="Regresa el objecto actualizado", @Model(type=BloodChemistry::class))
     * @SWG\Response(response=404, description="Blood Chemistry resource not found.",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="code", type="string", example="Código del error"),
     *          @SWG\Property(property="message", type="string", example="Blood Chemistry resource not found.")
     *     )
     * )
     */
    public function edit(Request $request, BloodChemistry $bloodChemistry): View
    {
        $form = $this->createForm(BloodChemistryType::class, $bloodChemistry);
        $this->processForm($request, $form);

        if (!$form->isValid()) {
            return $this->createValidationErrorResponse($form);
        }

        $this->getDoctrine()->getManager()->flush();

        return View::create($bloodChemistry);
    }

    /**
     * @Rest\Delete("/blood_chemistry/{id}")
     * @param BloodChemistry $bloodChemistry
     * @return View
     *
     * @SWG\Parameter(name="id", in="path", type="string", description="Clotting Time Id to delete")
     * @SWG\Response(response=200, description="Returns deleted Entity", @Model(type=BloodChemistry::class))
     * @SWG\Response(response=404, description="Clotting Times deleted",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="code", type="string", example="Código del error"),
     *          @SWG\Property(property="message", type="string", example="Clotting Times deleted")
     *     )
     * )
     */
    public function delete(BloodChemistry $bloodChemistry): View
    {
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($bloodChemistry);
        $manager->flush();

        return View::create(['code' => 200, 'message' => '¡Registro eliminado correctamente!']);
    }
}