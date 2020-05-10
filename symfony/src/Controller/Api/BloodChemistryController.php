<?php
/**
 * Created by PhpStorm.
 * User: heriberto
 * Date: 9/05/20
 * Time: 10:47 PM
 */

namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Entity\BloodChemistry;


class BloodChemistryController extends AbstractFOSRestController
{
    /**
     * Muestra un listado de objeto .....
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
     * @SWG\Tag(name="BloodChemistry")
     *
     * @return View
     */

    public function indexAction(){

        $chemistries = $this->getDoctrine()->getRepository(BloodChemistry::class)
            ->findAll();

        $view = $this->view($chemistries, Response::HTTP_OK);
        return $this->handleView($view);

        //return View::create($chemistries, Response::HTTP_OK);
    }
}