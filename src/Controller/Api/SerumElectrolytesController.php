<?php

namespace App\Controller\Api;

use App\Entity\SerumElectrolytes;
use App\Repository\SerumElectrolytesRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class SerumElectrolytesController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/serum_electrolytes")
     * @param SerumElectrolytesRepository $serumElectrolytesRepository
     * @return View
     *
     * @SWG\Tag(name="SerumElectrolytes")
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
     * @SWG\Tag(name="SerumElectrolytes")
     * @SWG\Parameter(name="id", in="path", type="integer", description="Serum Electrolytes resource Id")
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
     * @param ValidatorInterface $validator
     * @param Request $request
     * @return View
     *
     * @SWG\Tag(name="SerumElectrolytes")
     * @SWG\Parameter(name="body", in="body",
     *    @SWG\Schema(type="object",
     *         @SWG\Property(property="sodium", type="integer", description="sodium", example=""),
     *         @SWG\Property(property="potassium", type="integer", description="potassium", example="")
     *    )
     * )
     *
     * @SWG\Response(response=200, description="Regresa el objecto creado", @Model(type=SerumElectrolytes::class))
     */
    public function create(Request $request, ValidatorInterface $validator): View
    {
        $serumElectrolytes = new SerumElectrolytes();
        $serumElectrolytes->setSodium($request->get('sodium'));
        $serumElectrolytes->setPotassium($request->get('potassium'));
        
        //TODO: Revisar el caso cuando el usuario no manda un parámetro, formar un response 400
        $errors = $validator->validate($serumElectrolytes);
        if (count($errors) > 0) {
            return View::create($errors, Response::HTTP_BAD_REQUEST);
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($serumElectrolytes);
        $manager->flush();

        return View::create($serumElectrolytes);
    }

    /**
     * @Rest\Put("/serum_electrolytes/{id}")
     * @param Request $request
     * @param $id
     * @return View
     *
     * @SWG\Tag(name="SerumElectrolytes")
     * @SWG\Parameter(name="id", in="path", type="integer", description="Edditing Serum Electrolytes ID")
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
    public function edit(Request $request, $id): View
    {
        $manager = $this->getDoctrine()->getManager();
        $serumElectrolytes = $manager->getRepository(SerumElectrolytes::class)->find($id);

        if(!$serumElectrolytes){
            return View::create(
                ["code" => 404, "message" => "¡Registro no encontrado!"],
                Response::HTTP_NOT_FOUND
            );
        }
        //TODO: Validate input
        $serumElectrolytes->setSodium($request->get('sodium'));
        $serumElectrolytes->setPotassium($request->get('potassium'));
        $manager->flush();

        return View::create($serumElectrolytes);
    }

    /**
     * @Rest\Delete("/serum_electrolytes/{id}")
     * @param SerumElectrolytes $serumElectrolytes
     * @return View
     *
     * @SWG\Tag(name="SerumElectrolytes")
     * @SWG\Parameter(name="id", in="path", type="integer", description="Serum Electrolytes Id to delete")
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
