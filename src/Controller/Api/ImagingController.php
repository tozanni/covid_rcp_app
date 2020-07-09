<?php

namespace App\Controller\Api;

use App\Entity\Imaging;
use App\Repository\ImagingRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;


/**
 * Class ImagingController
 * @package App\Controller\Api
 * @SWG\Tag(name="Imaging")
 *
 */
class ImagingController extends AbstractFOSRestController
{
    use ProcessFormsTrait;

    /**
     * @Rest\Get("/imagin")
     * @param ImagingRepository $imagingRepository
     * @return View
     *
     * @SWG\Response(response=200, description="Regresa un listado",
     *     @SWG\Schema(type="array", @Model(type=Imaging::class))
     * )
     *
     * @SWG\Response(response=404, description="HTTP_NOT_FOUND - La dirección con el Id solicitado no se encuentra.",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="chest_x_ray", type="boolean", description="Si tiene radiografía toraxica", example=true),
     *          @SWG\Property(property="result", type="string", description="Codigo del resultado segun estudio")
     *    )
     * )
     */
    public function index(ImagingRepository $imagingRepository): View
    {
        return View::create($imagingRepository->findAll());
    }
}
