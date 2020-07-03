<?php

namespace App\Controller\Api;

use App\Entity\ClottingTime;
use App\Form\ClottingTimeType;
use App\Repository\ClottingTimeRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class ClottingTimeController
 * @package App\Controller\Api
 * @SWG\Tag(name="ClottingTime")
 */
class ClottingTimeController extends AbstractFOSRestController
{
    use ProcessFormsTrait;

    /**
     * @Rest\Get("/clotting_time")
     * @param ClottingTimeRepository $clottingTimeRepository
     * @return View
     *
     * @SWG\Response(response=200, description="Regresa un listado",
     *     @SWG\Schema(type="array", @Model(type=ClottingTime::class))
     * )
     *
     * @SWG\Response(response=404, description="HTTP_NOT_FOUND - La dirección con el Id solicitado no se encuentra.",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="success", type="string", description="El código del error.", example= "false"),
     *          @SWG\Property(property="error_description", type="string", description="Detalles del error.")
     *    )
     * )
     */
    public function index(ClottingTimeRepository $clottingTimeRepository): View
    {
        return View::create($clottingTimeRepository->findAll(), Response::HTTP_OK);
    }


    /**
     * @Rest\Get("/clotting_time/{id}")
     * @param ClottingTime $clottingTime
     * @return View
     *
     * @SWG\Parameter(name="id", in="path", type="string", description="Clotting Time resource Id")
     * @SWG\Response(response=200, description="Returns recorded clotting time.", @Model(type=ClottingTime::class))
     * @SWG\Response(response=404, description="Clotting Time not found.",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="code", type="string", example="Error code."),
     *          @SWG\Property(property="message", type="string", example="Clotting Time not found.")
     *     )
     * )
     */
    public function show(ClottingTime $clottingTime): View
    {
        return View::create($clottingTime);
    }

    /**
     * @Rest\Post("/clotting_time")
     * @param Request $request
     * @return View
     *
     * @SWG\Parameter(name="body", in="body",
     *    @SWG\Schema(type="object",
     *         @SWG\Property(property="prothrombin", type="integer", description="", example="Prothrombin"),
     *         @SWG\Property(property="thromboplastin", type="integer", description="", example="thromboplastin")
     *    )
     * )
     *
     * @SWG\Response(response=200, description="Regresa el objecto creado", @Model(type=ClottingTime::class))
     */
    public function create(Request $request): View
    {
        $clottingTime = new ClottingTime();
        $form = $this->createForm(ClottingTimeType::class, $clottingTime);
        $this->processForm($request, $form);

        if (!$form->isValid()) {
            return $this->createValidationErrorResponse($form);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($clottingTime);
        $entityManager->flush();

        return View::create($clottingTime, Response::HTTP_CREATED);
    }

    /**
     * @Rest\Put("/clotting_time/{id}")
     * @param Request $request
     * @param ClottingTime $clottingTime
     * @return View
     *
     * @SWG\Parameter(name="id", in="path", type="string", description="Edditing Clotting Time ID")
     * @SWG\Parameter(name="body", in="body",
     *    @SWG\Schema(type="object",
     *         @SWG\Property(property="prothrombin", type="integer", description="Prothrombin", example=""),
     *         @SWG\Property(property="thromboplastin", type="integer", description="Thromboplastin", example="")
     *    )
     * )
     * @SWG\Response(response=200, description="Regresa el objecto actualizado", @Model(type=ClottingTime::class))
     * @SWG\Response(response=404, description="Clotting Time resource not found.",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="code", type="string", example="Código del error"),
     *          @SWG\Property(property="message", type="string", example="Clotting Time resource not found.")
     *     )
     * )
     */
    public function edit(Request $request, ClottingTime $clottingTime): View
    {
        $form = $this->createForm(ClottingTimeType::class, $clottingTime);
        $this->processForm($request, $form);

        if (!$form->isValid()) {
            return $this->createValidationErrorResponse($form);
        }

        $this->getDoctrine()->getManager()->flush();

        return View::create($clottingTime);
    }

    /**
     * @Rest\Delete("/clotting_time/{id}")
     * @param ClottingTime $clottingTime
     * @return View
     *
     * @SWG\Parameter(name="id", in="path", type="string", description="Clotting Time Id to delete")
     * @SWG\Response(response=200, description="Returns deleted Entity", @Model(type=ClottingTime::class))
     * @SWG\Response(response=404, description="Clotting Times deleted",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="code", type="string", example="Código del error"),
     *          @SWG\Property(property="message", type="string", example="Clotting Times deleted")
     *     )
     * )
     */
    public function delete(ClottingTime $clottingTime): View
    {
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($clottingTime);
        $manager->flush();

        return View::create(['code' => 200, 'message' => '¡Registro eliminado correctamente!']);
    }
}
