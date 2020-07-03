<?php
/**
 * Created by PhpStorm.
 * User: heriberto
 * Date: 9/05/20
 * Time: 10:47 PM
 */

namespace App\Controller\Api;

use App\Form\HematicBiometryType;
use App\Repository\HematicBiometryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Entity\HematicBiometry;

/**
 * Class HematicBiometryController
 * @package App\Controller\Api
 * @SWG\Tag(name="HematicBiometry")
 */
class HematicBiometryController extends AbstractFOSRestController
{
    use ProcessFormsTrait;

    /**
     * @Rest\Get("hematic_biometry")
     * @param HematicBiometryRepository $hematicBiometryRepository
     * @return View
     *
     * @SWG\Response(response=200, description="Regresa un listado",
     *     @SWG\Schema(type="array", @Model(type=HematicBiometry::class))
     * )
     *
     * @SWG\Response(response=404, description="HTTP_NOT_FOUND - La dirección con el Id solicitado no se encuentra.",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="success", type="string", description="El código del error.", example= "false"),
     *          @SWG\Property(property="error_description", type="string", description="Detalles del error.")
     *    )
     * )
     */
    public function index(HematicBiometryRepository $hematicBiometryRepository): View
    {
        return View::create($hematicBiometryRepository->findAll(), Response::HTTP_OK);
    }

    
    /**
     * @Rest\Get("/hematic_biometry/{id}")
     * @param HematicBiometry $hematicBiometry
     * @return View
     *
     * @SWG\Parameter(name="id", in="path", type="string", description="Hematic biometry resource Id")
     * @SWG\Response(response=200, description="Returns recorded Hematic biometry.", @Model(type=HematicBiometry::class))
     * @SWG\Response(response=404, description="Hematic biometry not found.",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="code", type="string", example="Error code."),
     *          @SWG\Property(property="message", type="string", example="Hematic biometry not found.")
     *     )
     * )
     */
    public function show(HematicBiometry $hematicBiometry): View
    {
        return View::create($hematicBiometry);
    }

    /**
     * @Rest\Post("hematic_biometry")
     * @param Request $request
     * @return View
     * @throws \Exception
     *
     * @SWG\Parameter(name="body", in="body",
     *    @SWG\Schema(type="object",
     *         @SWG\Property(property="hematocrit", type="integer", description="", example="10"),
     *         @SWG\Property(property="hemoglobin", type="integer", description="", example="12"),
     *         @SWG\Property(property="leukocytes", type="integer", description="", example="13"),
     *         @SWG\Property(property="platelets", type="integer", description="", example="123")
     *    )
     * )
     *
     * @SWG\Response(response=200, description="Regresa el objecto creado", @Model(type=HematicBiometry::class))
     */
    public function create(Request $request): View
    {
        $hematicBiometry = new HematicBiometry();
        $form = $this->createForm(HematicBiometryType::class, $hematicBiometry);
        $this->processForm($request, $form);

        if (!$form->isValid()) {
            return $this->createValidationErrorResponse($form);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($hematicBiometry);
        $entityManager->flush();

        return View::create($hematicBiometry, Response::HTTP_CREATED);
    }

    /**
     * @Rest\Put("/hematic_biometry/{id}")
     * @param Request $request
     * @param HematicBiometry $hematicBiometry
     * @return View
     *
     * @SWG\Parameter(name="id", in="path", type="string", description="Hematic biometry ID")
     * @SWG\Parameter(name="body", in="body",
     *    @SWG\Schema(type="object",
     *         @SWG\Property(property="hematocrit", type="integer", description="", example="10"),
     *         @SWG\Property(property="hemoglobin", type="integer", description="", example="12"),
     *         @SWG\Property(property="leukocytes", type="integer", description="", example="13"),
     *         @SWG\Property(property="platelets", type="integer", description="", example="123")
     *    )
     * )
     * @SWG\Response(response=200, description="Regresa el objecto actualizado", @Model(type=HematicBiometry::class))
     * @SWG\Response(response=404, description="Hematic biometry resource not found.",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="code", type="string", example="Código del error"),
     *          @SWG\Property(property="message", type="string", example="Hematic biometry resource not found.")
     *     )
     * )
     */
    public function edit(Request $request, HematicBiometry $hematicBiometry): View
    {
        $form = $this->createForm(HematicBiometryType::class, $hematicBiometry);
        $this->processForm($request, $form);

        if (!$form->isValid()) {
            return $this->createValidationErrorResponse($form);
        }

        $this->getDoctrine()->getManager()->flush();

        return View::create($hematicBiometry);
    }

    /**
     * @Rest\Delete("/hematic_biometry/{id}")
     * @param HematicBiometry $hematicBiometry
     * @return View
     *
     * @SWG\Parameter(name="id", in="path", type="string", description="Hematic Biometry Id to delete")
     * @SWG\Response(response=200, description="Returns deleted Entity", @Model(type=HematicBiometry::class))
     * @SWG\Response(response=404, description="Hematic Biometry deleted",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="code", type="string", example="Código del error"),
     *          @SWG\Property(property="message", type="string", example="Hematic Biometry deleted")
     *     )
     * )
     */
    public function delete(HematicBiometry $hematicBiometry): View
    {
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($hematicBiometry);
        $manager->flush();

        return View::create(['code' => 200, 'message' => '¡Registro eliminado correctamente!']);
    }
}