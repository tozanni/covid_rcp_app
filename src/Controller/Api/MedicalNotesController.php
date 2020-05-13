<?php

namespace App\Controller\Api;

use App\Entity\MedicalNotes;
use App\Repository\MedicalNotesRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class MedicalNotesController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/medical_notes")
     * @param MedicalNotesRepository $medicalNotesRepository
     * @return View
     *
     * @SWG\Tag(name="MedicalNotes")
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
     * @SWG\Tag(name="MedicalNotes")
     * @SWG\Parameter(name="id", in="path", type="integer", description="ID de las notas médicas a buscar")
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
     * @param ValidatorInterface $validator
     * @param Request $request
     * @return View
     *
     * @SWG\Tag(name="MedicalNotes")
     * @SWG\Parameter(name="body", in="body",
     *    @SWG\Schema(type="object",
     *         @SWG\Property(property="notes", type="text", description="", example="Notas médicas"),
     *         @SWG\Property(property="prescription_drugs", type="text", description="", example="Medicinas prescritas"),
     *    )
     * )
     *
     * @SWG\Response(response=200, description="Regresa el objecto creado", @Model(type=MedicalNotes::class))
     */
    public function create(Request $request, ValidatorInterface $validator): View
    {
        $medicalNote = new MedicalNotes();
        $medicalNote->setNotes($request->get('notes'));
        $medicalNote->setPrescriptionDrugs($request->get('prescription_drugs'));

        //TODO: Revisar el caso cuando el usuario no manda un parámetro, formar un response 400
        $errors = $validator->validate($medicalNote);
        if (count($errors) > 0) {
            return View::create($errors, Response::HTTP_BAD_REQUEST);
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($medicalNote);
        $manager->flush();

        return View::create($medicalNote);
    }

    /**
     * @Rest\Put("/medical_notes/{id}")
     * @param Request $request
     * @param $id
     * @return View
     *
     * @SWG\Tag(name="MedicalNotes")
     * @SWG\Parameter(name="id", in="path", type="integer", description="ID de las notas médicas a editar")
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
    public function edit(Request $request, $id): View
    {
        $manager = $this->getDoctrine()->getManager();
        $medicalNote = $manager->getRepository(MedicalNotes::class)->find($id);

        if(!$medicalNote){
            return View::create(
                ["code" => 404, "message" => "¡Registro no encontrado!"],
                Response::HTTP_NOT_FOUND
            );
        }

        $medicalNote->setNotes($request->get('notes'));
        $medicalNote->setPrescriptionDrugs($request->get('prescription_drugs'));
        $manager->flush();

        return View::create($medicalNote);
    }

    /**
     * @Rest\Delete("/medical_notes/{id}")
     * @param MedicalNotes $medicalNote
     * @return View
     *
     * @SWG\Tag(name="MedicalNotes")
     * @SWG\Parameter(name="id", in="path", type="integer", description="ID de las notas médicas a eliminar")
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
