<?php

namespace App\Controller\Api;

use App\Repository\ImmunologicalRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use App\Entity\Immunological;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class ImmunologicalController
 * @package App\Controller\Api
 * @SWG\Tag(name="Immunological")
 */
class ImmunologicalController extends AbstractFOSRestController
{
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
     * @param ValidatorInterface $validator
     * @return View
     *
     * @SWG\Parameter(name="body", in="body",
     *    @SWG\Schema(type="object",
     *         @SWG\Property(property="reactive_protein_c", type="text", description="Descripción de la propiedad", example=1234),
     *    )
     * )
     *
     * @SWG\Response(response=200, description="Regresa el objecto creado", @Model(type=MedicalNotes::class))
     */
    public function create(Request $request, ValidatorInterface $validator): View
    {
        $immunological = new Immunological();
        $immunological->setReactiveProteinC($request->get('reactive_protein_c'));

        $errors = $validator->validate($immunological);
        if (count($errors) > 0) {
            return View::create($errors, Response::HTTP_BAD_REQUEST);
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($immunological);
        $manager->flush();

        return View::create($immunological);
    }
}