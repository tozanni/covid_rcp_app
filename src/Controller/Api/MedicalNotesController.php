<?php

namespace App\Controller\Api;

use App\Entity\MedicalNotes;
use App\Form\MedicalNotesType;
use App\Repository\MedicalNotesRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class MedicalNotesController
 * @package App\Controller\Api
 * @SWG\Tag(name="MedicalNotes")
 */
class MedicalNotesController extends AbstractFOSRestController
{
    use ProcessFormsTrait;

    /**
     * @Rest\Get("/medical_notes")
     * @param MedicalNotesRepository $medicalNotesRepository
     * @return View
     *
     * @SWG\Response(response=200, description="Regresa un listado",
     *     @SWG\Schema(type="array", @Model(type=MedicalNotes::class))
     * )
     */
    public function index(MedicalNotesRepository $medicalNotesRepository): View
    {
        return View::create($medicalNotesRepository->findAll());
    }


    /**
     * @Rest\Get("/medical_notes/{id}")
     * @param MedicalNotes $medicalNotes
     * @return View
     *
     * @SWG\Parameter(name="id", in="path", type="string", description="ID de las notas médicas a buscar")
     * @SWG\Response(response=200, description="Regresa los detalles de Notas Médicas", @Model(type=Record::class))
     * @SWG\Response(response=404, description="La nota médica no fue encontrada",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="code", type="string", example="Código del error"),
     *          @SWG\Property(property="message", type="string", example="La nota médica no fue encontrada")
     *     )
     * )
     */
    public function show(MedicalNotes $medicalNotes): View
    {
        return View::create($medicalNotes);
    }

    /**
     * @Rest\Post("/medical_notes")
     * @param Request $request
     * @return View
     *
     * @SWG\Parameter(name="body", in="body",
     *    @SWG\Schema(type="object",
     *         @SWG\Property(property="notes", type="text", description="", example="Notas médicas"),
     *         @SWG\Property(property="prescription_drugs", type="text", description="", example="Medicinas prescritas"),
     *    )
     * )
     *
     * @SWG\Response(response=200, description="Regresa el objecto creado", @Model(type=MedicalNotes::class))
     */
    public function create(Request $request): View
    {
        $medicalNotes = new MedicalNotes();
        $form = $this->createForm(MedicalNotesType::class, $medicalNotes);
        $this->processForm($request, $form);

        if (!$form->isValid()) {
            return $this->createValidationErrorResponse($form);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($medicalNotes);
        $entityManager->flush();

        return View::create($medicalNotes, Response::HTTP_CREATED);
    }

    /**
     * @Rest\Put("/medical_notes/{id}")
     * @param Request $request
     * @param MedicalNotes $medicalNotes
     * @return View
     *
     * @SWG\Parameter(name="id", in="path", type="string", description="ID de las notas médicas a editar")
     * @SWG\Parameter(name="body", in="body",
     *    @SWG\Schema(type="object",
     *         @SWG\Property(property="notes", type="text", description="", example="Notas médicas"),
     *         @SWG\Property(property="prescription_drugs", type="text", description="", example="Medicinas prescritas"),
     *    )
     * )
     * @SWG\Response(response=200, description="Regresa el objecto actualizado", @Model(type=MedicalNotes::class))
     * @SWG\Response(response=404, description="La nota médica no fue encontrada",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="code", type="string", example="Código del error"),
     *          @SWG\Property(property="message", type="string", example="La nota médica no fue encontrada")
     *     )
     * )
     */
    public function edit(Request $request, MedicalNotes $medicalNotes): View
    {
        $form = $this->createForm(MedicalNotesType::class, $medicalNotes);
        $this->processForm($request, $form);

        if (!$form->isValid()) {
            return $this->createValidationErrorResponse($form);
        }

        $this->getDoctrine()->getManager()->flush();

        return View::create($medicalNotes);
    }

    /**
     * @Rest\Delete("/medical_notes/{id}")
     * @param MedicalNotes $medicalNote
     * @return View
     *
     * @SWG\Parameter(name="id", in="path", type="string", description="ID de las notas médicas a eliminar")
     * @SWG\Response(response=200, description="Regresa el objecto actualizado", @Model(type=MedicalNotes::class))
     * @SWG\Response(response=404, description="La nota médica no fue encontrada",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="code", type="string", example="Código del error"),
     *          @SWG\Property(property="message", type="string", example="La nota médica no fue encontrada")
     *     )
     * )
     */
    public function delete(MedicalNotes $medicalNote): View
    {
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($medicalNote);
        $manager->flush();

        return View::create(['code' => 200, 'message' => '¡Registro eliminado correctamente!']);
    }
}
