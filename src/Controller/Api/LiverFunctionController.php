<?php

namespace App\Controller\Api;

use App\Entity\LiverFunction;
use App\Form\LiverFunctionType;
use App\Repository\LiverFunctionRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class LiverFunctionController
 * @package App\Controller\Api
 * @SWG\Tag(name="LiverFunction")
 */
class LiverFunctionController extends AbstractFOSRestController
{
    use ProcessFormsTrait;

    /**
     * @Rest\Get("/liver_function")
     * @param LiverFunctionRepository $liverFunctionRepository
     * @return View
     *
     * @SWG\Response(response=200, description="Regresa un listado",
     *     @SWG\Schema(type="array", @Model(type=LiverFunction::class))
     * )
     *
     * @SWG\Response(response=404, description="HTTP_NOT_FOUND - La dirección con el Id solicitado no se encuentra.",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="success", type="string", description="El código del error.", example= "false"),
     *          @SWG\Property(property="error_description", type="string", description="Detalles del error.")
     *    )
     * )
     */
    public function index(LiverFunctionRepository $liverFunctionRepository): View
    {
        return View::create($liverFunctionRepository->findAll(), Response::HTTP_OK);
    }


    /**
     * @Rest\Get("/liver_function/{id}")
     * @param LiverFunction $liverFunction
     * @return View
     *
     * @SWG\Parameter(name="id", in="path", type="string", description="Liver Function resource Id")
     * @SWG\Response(response=200, description="Returns recorded clotting time.", @Model(type=LiverFunction::class))
     * @SWG\Response(response=404, description="Liver Function not found.",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="code", type="string", example="Error code."),
     *          @SWG\Property(property="message", type="string", example="Liver Function not found.")
     *     )
     * )
     */
    public function show(LiverFunction $liverFunction): View
    {
        return View::create($liverFunction);
    }

    /**
     * @Rest\Post("/liver_function")
     * @param ValidatorInterface $validator
     * @param Request $request
     * @return View
     *
     * @SWG\Parameter(name="body", in="body",
     *    @SWG\Schema(type="object",
     *         @SWG\Property(property="aspartateAminotransferase", type="integer", description="aspartateAminotransferase", example=""),
     *         @SWG\Property(property="alanineTransaminase", type="integer", description="alanineTransaminase", example=""),
     *         @SWG\Property(property="bloodUreaNitrogen", type="integer", description="bloodUreaNitrogen", example="")
     *    )
     * )
     *
     * @SWG\Response(response=200, description="Regresa el objecto creado", @Model(type=LiverFunction::class))
     */
    public function create(Request $request): View
    {
        $liverFunction = new LiverFunction();
        $form = $this->createForm(LiverFunctionType::class, $liverFunction);
        $this->processForm($request, $form);

        if (!$form->isValid()) {
            return $this->createValidationErrorResponse($form);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($liverFunction);
        $entityManager->flush();

        return View::create($liverFunction, Response::HTTP_CREATED);
    }

    /**
     * @Rest\Put("/liver_function/{id}")
     * @param Request $request
     * @param LiverFunction $liverFunction
     * @return View
     *
     * @SWG\Parameter(name="id", in="path", type="string", description="Edditing Liver Function ID")
     * @SWG\Parameter(name="body", in="body",
     *    @SWG\Schema(type="object",
     *         @SWG\Property(property="aspartateAminotransferase", type="integer", description="aspartateAminotransferase", example=""),
     *         @SWG\Property(property="alanineTransaminase", type="integer", description="alanineTransaminase", example=""),
     *         @SWG\Property(property="bloodUreaNitrogen", type="integer", description="bloodUreaNitrogen", example="")
     *    )
     * )
     *
     * @SWG\Response(response=200, description="Regresa el objecto actualizado", @Model(type=LiverFunction::class))
     * @SWG\Response(response=404, description="Liver Function resource not found.",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="code", type="string", example="Código del error"),
     *          @SWG\Property(property="message", type="string", example="Liver Function resource not found.")
     *     )
     * )
     */
    public function edit(Request $request, LiverFunction $liverFunction): View
    {
        $form = $this->createForm(LiverFunctionType::class, $liverFunction);
        $this->processForm($request, $form);

        if (!$form->isValid()) {
            return $this->createValidationErrorResponse($form);
        }

        $this->getDoctrine()->getManager()->flush();

        return View::create($liverFunction);
    }

    /**
     * @Rest\Delete("/liver_function/{id}")
     * @param LiverFunction $liverFunction
     * @return View
     *
     * @SWG\Parameter(name="id", in="path", type="string", description="Liver Function Id to delete")
     * @SWG\Response(response=200, description="Returns deleted Entity", @Model(type=LiverFunction::class))
     * @SWG\Response(response=404, description="Liver Functions deleted",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="code", type="string", example="Código del error"),
     *          @SWG\Property(property="message", type="string", example="Liver Functions deleted")
     *     )
     * )
     */
    public function delete(LiverFunction $liverFunction): View
    {
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($liverFunction);
        $manager->flush();

        return View::create(['code' => 200, 'message' => '¡Registro eliminado correctamente!']);
    }
}
