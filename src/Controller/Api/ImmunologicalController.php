<?php

namespace App\Controller\Api;

use App\Form\ImmunologicalType;
use App\Repository\ImmunologicalRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use App\Entity\Immunological;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ImmunologicalController
 * @package App\Controller\Api
 * @SWG\Tag(name="Immunological")
 */
class ImmunologicalController extends AbstractFOSRestController
{
    use ProcessFormsTrait;

    /**
     * @Rest\Get("/immunological")
     * @param ImmunologicalRepository $immunologicalRepository
     * @return View
     *
     * @SWG\Response(response=200, description="Regresa un listado",
     *     @SWG\Schema(type="array", @Model(type=Immunological::class))
     * )
     */
    public function index(ImmunologicalRepository $immunologicalRepository): View
    {
        return View::create($immunologicalRepository->findAll());
    }

    /**
     * @Rest\Post("/immunological")
     * @param Request $request
     * @return View
     *
     * @SWG\Parameter(name="body", in="body",
     *    @SWG\Schema(type="object",
     *         @SWG\Property(property="reactive_protein_c", type="text", description="Descripción de la propiedad", example=1234),
     *         @SWG\Property(property="procalcitonin", type="text", description="Descripción de la propiedad", example=1234),
     *         @SWG\Property(property="d_dimero", type="text", description="Descripción de la propiedad", example=1234)
     *    )
     * )
     *
     * @SWG\Response(response=200, description="Regresa el objecto creado", @Model(type=Immunological::class))
     */
    public function create(Request $request): View
    {
        $immunological = new Immunological();
        $form = $this->createForm(ImmunologicalType::class, $immunological);
        $this->processForm($request, $form);

        if (!$form->isValid()) {
            return $this->createValidationErrorResponse($form);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($immunological);
        $entityManager->flush();

        return View::create($immunological, Response::HTTP_CREATED);
    }

    /**
     * @Rest\Put("/immunological/{id}")
     * @param Request $request
     * @param Immunological $immunological
     * @return View
     *
     * @SWG\Parameter(name="id", in="path", type="string", description="ID del expendiente a buscar")
     * @SWG\Parameter(name="body", in="body",
     *    @SWG\Schema(type="object",
     *         @SWG\Property(property="reactive_protein_c", type="text", description="Descripción de la propiedad", example=1234),
     *         @SWG\Property(property="procalcitonin", type="text", description="Descripción de la propiedad", example=1234),
     *         @SWG\Property(property="d_dimero", type="text", description="Descripción de la propiedad", example=1234)
     *    )
     * )
     * @SWG\Response(response=200, description="Actualiza los datos de un expediente", @Model(type=Immunological::class))
     * @SWG\Response(response=404, description="Record resource not found.",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="code", type="integer", example=404),
     *          @SWG\Property(property="message", type="string", example="Record resource not found.")
     *     )
     * )
     */
    public function edit(Request $request, Immunological $immunological): View
    {
        $form = $this->createForm(ImmunologicalType::class, $immunological);
        $this->processForm($request, $form);

        if (!$form->isValid()) {
            return $this->createValidationErrorResponse($form);
        }

        $this->getDoctrine()->getManager()->flush();

        return View::create($immunological);
    }
}