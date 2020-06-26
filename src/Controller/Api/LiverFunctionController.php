<?php

namespace App\Controller\Api;

use App\Entity\LiverFunction;
use App\Repository\LiverFunctionRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class LiverFunctionController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/liver_function")
     * @param LiverFunctionRepository $liverFunctionRepository
     * @return View
     *
     * @SWG\Tag(name="LiverFunction")
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
     * @SWG\Tag(name="LiverFunction")
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
     * @SWG\Tag(name="LiverFunction")
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
    public function create(Request $request, ValidatorInterface $validator): View
    {
        $liverFunction = new LiverFunction();
        $liverFunction->setAspartateAminotransferase($request->get('aspartateAminotransferase'));
        $liverFunction->setAlanineTransaminase($request->get('alanineTransaminase'));
        $liverFunction->setBloodUreaNitrogen($request->get('bloodUreaNitrogen'));
        
        //TODO: Revisar el caso cuando el usuario no manda un parámetro, formar un response 400
        $errors = $validator->validate($liverFunction);
        if (count($errors) > 0) {
            return View::create($errors, Response::HTTP_BAD_REQUEST);
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($liverFunction);
        $manager->flush();

        return View::create($liverFunction);
    }

    /**
     * @Rest\Put("/liver_function/{id}")
     * @param Request $request
     * @param $id
     * @return View
     *
     * @SWG\Tag(name="LiverFunction")
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
    public function edit(Request $request, $id): View
    {
        $manager = $this->getDoctrine()->getManager();
        $liverFunction = $manager->getRepository(LiverFunction::class)->find($id);

        if(!$liverFunction){
            return View::create(
                ["code" => 404, "message" => "¡Registro no encontrado!"],
                Response::HTTP_NOT_FOUND
            );
        }
        //TODO: Validate input
        $liverFunction->setAspartateAminotransferase($request->get('aspartateAminotransferase'));
        $liverFunction->setAlanineTransaminase($request->get('alanineTransaminase'));
        $liverFunction->setBloodUreaNitrogen($request->get('bloodUreaNitrogen'));
        $manager->flush();

        return View::create($liverFunction);
    }

    /**
     * @Rest\Delete("/liver_function/{id}")
     * @param LiverFunction $liverFunction
     * @return View
     *
     * @SWG\Tag(name="LiverFunction")
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
