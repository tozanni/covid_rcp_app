<?php
/**
 * Created by PhpStorm.
 * User: heriberto
 * Date: 9/05/20
 * Time: 10:47 PM
 */

namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Entity\BloodChemistry;

class BloodChemistryController extends AbstractFOSRestController
{
    /**
     * Muestra un listado de objeto
     *
     * @Rest\Get("blood_chemistry")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Regresa un listado",
     *     @SWG\Schema(type="array",
     *          @Model(type=BloodChemistry::class)
     *    )
     * )
     *
     * @SWG\Response(response=404, description="HTTP_NOT_FOUND - La dirección con el Id solicitado no se encuentra.",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="success", type="string", description="El código del error.", example= "false"),
     *          @SWG\Property(property="error_description", type="string", description="Detalles del error.")
     *    )
     * )
     *
     * @SWG\Tag(name="BloodChemistry")
     *
     * @return View
     */
    public function index(){

        $chemistries = $this->getDoctrine()->getRepository(BloodChemistry::class)
            ->findAll();

        if (!$chemistries){
            return View::create(["success" => false, "msg" => ''], Response::HTTP_NOT_FOUND);
        }

        return View::create($chemistries, Response::HTTP_OK);
    }


    /**
     * Crear BloodChemistry
     *
     * @Rest\Post("blood_chemistry")
     *
     * @SWG\Parameter(name="body", in="body",
     *    @SWG\Schema(type="object",
     *         @SWG\Property(property="glucose", type="int", description="", example="10"),
     *         @SWG\Property(property="urea", type="integer", description="", example="12"),
     *         @SWG\Property(property="creatinine", type="integer", description="", example="13"),
     *         @SWG\Property(property="cholesterol", type="integer", description="", example="123"),
     *         @SWG\Property(property="triglycerides", type="integer", description="", example="12"),
     *         @SWG\Property(property="glycated_hemoglobin", type="integer", description="", example="65"),
     *    )
     * )
     *
     * @SWG\Response(
     *     response=200,
     *     description="Regresa el objecto creado",
     *     @Model(type=BloodChemistry::class)
     * )
     *
     * @param Request $request
     *
     * @SWG\Tag(name="BloodChemistry")
     *
     * @return View
     * @throws \Exception
     */
    public function create(Request $request){
        $chemistrieBlood = new BloodChemistry();
        $chemistrieBlood->setGlucose($request->get('glucose'));
        $chemistrieBlood->setUrea($request->get('urea'));
        $chemistrieBlood->setCreatinine($request->get('creatinine'));
        $chemistrieBlood->setCholesterol($request->get('cholesterol'));
        $chemistrieBlood->setTriglycerides($request->get('triglycerides'));
        $chemistrieBlood->setGlycatedHemoglobin($request->get('glycated_hemoglobin'));

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($chemistrieBlood);
        $manager->flush();

        Return View::create($chemistrieBlood, Response::HTTP_OK);

    }
}