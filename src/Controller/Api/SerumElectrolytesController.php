<?php

namespace App\Controller\Api;

use App\Entity\SerumElectrolytes;
use App\Form\SerumElectrolytesType;
use App\Repository\SerumElectrolytesRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SerumElectrolytesController
 * @package App\Controller\Api
 * @SWG\Tag(name="SerumElectrolytes")
 */
class SerumElectrolytesController extends AbstractFOSRestController
{
    use ProcessFormsTrait;

    /**
     * @Rest\Get("/serum_electrolytes")
     * @param SerumElectrolytesRepository $serumElectrolytesRepository
     * @return View
     *
     * @SWG\Response(response=200, description="Regresa un listado",
     *     @SWG\Schema(type="array", @Model(type=SerumElectrolytes::class))
     * )
     *
     * @SWG\Response(response=404, description="HTTP_NOT_FOUND - La dirección con el Id solicitado no se encuentra.",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="success", type="string", description="El código del error.", example= "false"),
     *          @SWG\Property(property="error_description", type="string", description="Detalles del error.")
     *    )
     * )
     */
    public function index(SerumElectrolytesRepository $serumElectrolytesRepository): View
    {
        return View::create($serumElectrolytesRepository->findAll(), Response::HTTP_OK);
    }


    /**
     * @Rest\Get("/serum_electrolytes/{id}")
     * @param SerumElectrolytes $serumElectrolytes
     * @return View
     *
     * @SWG\Parameter(name="id", in="path", type="string", description="Serum Electrolytes resource Id")
     * @SWG\Response(response=200, description="Returns recorded clotting time.", @Model(type=SerumElectrolytes::class))
     * @SWG\Response(response=404, description="Serum Electrolytes not found.",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="code", type="string", example="Error code."),
     *          @SWG\Property(property="message", type="string", example="Serum Electrolytes not found.")
     *     )
     * )
     */
    public function show(SerumElectrolytes $serumElectrolytes): View
    {
        return View::create($serumElectrolytes);
    }

    /**
     * @Rest\Post("/serum_electrolytes")
     * @param Request $request
     * @return View
     *
     * @SWG\Parameter(name="body", in="body",
     *    @SWG\Schema(type="object",
     *         @SWG\Property(property="sodium", type="integer", description="sodium", example=""),
     *         @SWG\Property(property="potassium", type="integer", description="potassium", example="")
     *    )
     * )
     *
     * @SWG\Response(response=200, description="Regresa el objecto creado", @Model(type=SerumElectrolytes::class))
     */
    public function create(Request $request): View
    {
        $serumElectrolytes = new SerumElectrolytes();
        $form = $this->createForm(SerumElectrolytesType::class, $serumElectrolytes);
        $this->processForm($request, $form);

        if (!$form->isValid()) {
            return $this->createValidationErrorResponse($form);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($serumElectrolytes);
        $entityManager->flush();

        return View::create($serumElectrolytes, Response::HTTP_CREATED);
    }

    /**
     * @Rest\Put("/serum_electrolytes/{id}")
     * @param Request $request
     * @param SerumElectrolytes $serumElectrolytes
     * @return View
     *
     * @SWG\Parameter(name="id", in="path", type="string", description="Edditing Serum Electrolytes ID")
     * @SWG\Parameter(name="body", in="body",
     *    @SWG\Schema(type="object",
     *         @SWG\Property(property="sodium", type="integer", description="sodium", example=""),
     *         @SWG\Property(property="potassium", type="integer", description="potassium", example="")
     *    )
     * )
     *
     * @SWG\Response(response=200, description="Regresa el objecto actualizado", @Model(type=SerumElectrolytes::class))
     * @SWG\Response(response=404, description="Serum Electrolytes resource not found.",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="code", type="string", example="Código del error"),
     *          @SWG\Property(property="message", type="string", example="Serum Electrolytes resource not found.")
     *     )
     * )
     */
    public function edit(Request $request, SerumElectrolytes $serumElectrolytes): View
    {
        $form = $this->createForm(SerumElectrolytesType::class, $serumElectrolytes);
        $this->processForm($request, $form);

        if (!$form->isValid()) {
            return $this->createValidationErrorResponse($form);
        }

        $this->getDoctrine()->getManager()->flush();

        return View::create($serumElectrolytes);
    }

    /**
     * @Rest\Delete("/serum_electrolytes/{id}")
     * @param SerumElectrolytes $serumElectrolytes
     * @return View
     *
     * @SWG\Parameter(name="id", in="path", type="string", description="Serum Electrolytes Id to delete")
     * @SWG\Response(response=200, description="Returns deleted Entity", @Model(type=SerumElectrolytes::class))
     * @SWG\Response(response=404, description="Serum Electrolytess deleted",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="code", type="string", example="Código del error"),
     *          @SWG\Property(property="message", type="string", example="Serum Electrolytess deleted")
     *     )
     * )
     */
    public function delete(SerumElectrolytes $serumElectrolytes): View
    {
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($serumElectrolytes);
        $manager->flush();

        return View::create(['code' => 200, 'message' => '¡Registro eliminado correctamente!']);
    }
}
