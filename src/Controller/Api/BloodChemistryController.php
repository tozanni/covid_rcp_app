<?php
/**
 * Created by PhpStorm.
 * User: heriberto
 * Date: 9/05/20
 * Time: 10:47 PM
 */

namespace App\Controller\Api;

use App\Repository\BloodChemistryRepository;
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
     * @Rest\Get("blood_chemistry")
     * @param BloodChemistryRepository $bloodChemistryRepository
     * @return View
     *
     * @SWG\Tag(name="BloodChemistry")
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
     * @Rest\Post("blood_chemistry")
     * @param Request $request
     * @return View
     * @throws \Exception
     *
     * @SWG\Tag(name="BloodChemistry")
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
        $bloodChemistry->setGlucose($request->get('glucose'));
        $bloodChemistry->setUrea($request->get('urea'));
        $bloodChemistry->setCreatinine($request->get('creatinine'));
        $bloodChemistry->setCholesterol($request->get('cholesterol'));
        $bloodChemistry->setTriglycerides($request->get('triglycerides'));
        $bloodChemistry->setGlycatedHemoglobin($request->get('glycated_hemoglobin'));

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($bloodChemistry);
        $manager->flush();

        return View::create($bloodChemistry);
    }
}