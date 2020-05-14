<?php

namespace App\Controller\Api;

use App\Entity\ClottingTime;
use App\Repository\ClottingTimeRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ClottingTimeController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/clotting_time")
     * @param ClottingTimeRepository $clottingTimeRepository
     * @return View
     *
     * @SWG\Tag(name="ClottingTime")
     * @SWG\Response(response=200, description="Regresa un listado",
     *     @SWG\Schema(type="array", @Model(type=ClottingTime::class))
     * )
     */
    public function index(ClottingTimeRepository $clottingTimeRepository): View
    {
        return View::create($clottingTimeRepository->findAll());
    }


    /**
     * @Rest\Get("/clotting_time/{id}")
     * @param ClottingTime $clottingTime
     * @return View
     *
     * @SWG\Tag(name="ClottingTime")
     * @SWG\Parameter(name="id", in="path", type="integer", description="Clotting Time resource Id")
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
     * @param ValidatorInterface $validator
     * @param Request $request
     * @return View
     *
     * @SWG\Tag(name="ClottingTime")
     * @SWG\Parameter(name="body", in="body",
     *    @SWG\Schema(type="object",
     *         @SWG\Property(property="prothrombin", type="integer", description="", example="Prothrombin"),
     *         @SWG\Property(property="thromboplastin", type="integer", description="", example="thromboplastin")
     *    )
     * )
     *
     * @SWG\Response(response=200, description="Regresa el objecto creado", @Model(type=ClottingTime::class))
     */
    public function create(Request $request, ValidatorInterface $validator): View
    {
        $clottingTime = new ClottingTime();
        $clottingTime->setProthrombin($request->get('prothrombin'));
        $clottingTime->setThromboplastin($request->get('thromboplastin'));
        
        //TODO: Revisar el caso cuando el usuario no manda un parámetro, formar un response 400
        $errors = $validator->validate($clottingTime);
        if (count($errors) > 0) {
            return View::create($errors, Response::HTTP_BAD_REQUEST);
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($clottingTime);
        $manager->flush();

        return View::create($clottingTime);
    }

    /**
     * @Rest\Put("/clotting_time/{id}")
     * @param Request $request
     * @param $id
     * @return View
     *
     * @SWG\Tag(name="ClottingTime")
     * @SWG\Parameter(name="id", in="path", type="integer", description="Edditing Clotting Time ID")
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
    public function edit(Request $request, $id): View
    {
        $manager = $this->getDoctrine()->getManager();
        $clottingTime = $manager->getRepository(ClottingTime::class)->find($id);

        if(!$clottingTime){
            return View::create(
                ["code" => 404, "message" => "¡Registro no encontrado!"],
                Response::HTTP_NOT_FOUND
            );
        }
        //TODO: Validate input
        $clottingTime->setProthrombin($request->get('prothrombin'));
        $clottingTime->setThromboplastin($request->get('thromboplastin'));
        $manager->flush();

        return View::create($clottingTime);
    }

    /**
     * @Rest\Delete("/clotting_time/{id}")
     * @param ClottingTime $clottingTime
     * @return View
     *
     * @SWG\Tag(name="ClottingTime")
     * @SWG\Parameter(name="id", in="path", type="integer", description="Clotting Time Id to delete")
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
