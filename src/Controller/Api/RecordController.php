<?php

namespace App\Controller\Api;

use App\Form\RecordType;
use App\Repository\RecordRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use App\Entity\Record;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RecordController
 * @package App\Controller\Api
 * @SWG\Tag(name="Record")
 */
class RecordController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/records")
     * @param RecordRepository $recordRepository
     * @return View
     *
     * @SWG\Response(response=200, description="Devuelve un listado de expedientes",
     *      @SWG\Schema(type="array", @Model(type=Record::class))
     * )
     */
    public function index(RecordRepository $recordRepository): View
    {
        return View::create($recordRepository->findAll());
    }

    /**
     * @Rest\Get("/records/{id}")
     * @param Record $record
     * @return View
     *
     * @SWG\Parameter(name="id", in="path", type="string", description="ID del expendiente a buscar")
     * @SWG\Response(response=200, description="Regresa los detalles de un Expediente", @Model(type=Record::class))
     * @SWG\Response(response=404, description="El expediente no fue encontrado",
     *     @SWG\Schema(type="object", @SWG\Property(property="message", type="string", example="El expediente no fue encontrado"))
     * )
     */
    public function show(Record $record): View
    {
        //TODO: Revisar la sección de excepciones de FOSRestBundle
        //ver: https://symfony.com/doc/master/bundles/FOSRestBundle/4-exception-controller-support.html
        return View::create($record);
    }

    /**
     * @Rest\Post("/records")
     * @param Request $request
     * @return View
     *
     * id	integer
     * admission_date	string($date-time)
     * id_canonical	string
     * status	string
     * egress_date	string($date-time)
     * egress_type	string
     * rcp_required	boolean
     * treatment	string
     * egress_notes	string
     * vital_signs	VitalSigns{...}
     * triage	Triage{...}
     * hematic_biometry	HematicBiometry{...}
     * blood_chemistry	BloodChemistry{...}
     * serum_electrolytes	SerumElectrolytes{...}
     * medical_notes	MedicalNotes{...}
     * liver_function	LiverFunction{...}
     * created_at	string($date-time)
     * updated_at	string($date-time)
     * clotting_time	ClottingTime{...}
     * immunological	Immunological{...}
     *
     * @SWG\Parameter(name="body", in="body",
     *    @SWG\Schema(type="object",
     *         @SWG\Property(property="admission_date", type="datetime", description="", example="10"),
     *         @SWG\Property(property="id_canonical", type="string", description="", example="12"),
     *         @SWG\Property(property="status", type="string", description="", example="13"),
     *         @SWG\Property(property="vital_signs", type="object", description="", example="123"),
     *         @SWG\Property(property="triage", type="object", description="", example="12"),
     *         @SWG\Property(property="hematic_biometry", type="integer", description="", example="65"),
     *    )
     * )
     * @SWG\Response(response=200, description="Crea un nuevo expediente y regresa el detalle", @Model(type=Record::class))
     */
    public function create(Request $request): View
    {
        $body = $request->getContent();
        $data = json_decode($body, true);

        $record = new Record();
        $form = $this->createForm(RecordType::class, $record);
        $form->submit($data);
        /**
         * TODO: Procesar el formulario correctamente para aprovechar la validación automática
         *
        $entityManager = $this->getDoctrine()->getManager();
        $record->setAdmissionDate(\DateTime::createFromFormat('Y-m-d', $data['admission_date']));
        $entityManager->persist($record);
        $entityManager->flush();
        */

        //Manda a procesar el modelo de predicción con el objeto recién creado
        $httpClient = HttpClient::create();
        $response = $httpClient->request('POST',
            'https://6ep2ew4noc.execute-api.us-east-1.amazonaws.com/BaseModel', [
                'body' => $body
            ]);

        return View::create($response->getContent(), Response::HTTP_CREATED);
    }

    /**
     * @Rest\Post("/prediction-model-test")
     * @param Request $request
     * @return View
     *
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * @SWG\Parameter(name="body", in="body",
     *    @SWG\Schema(type="object",
     *         @SWG\Property(property="admission_date", type="datetime", description="", example="10"),
     *         @SWG\Property(property="id_canonical", type="string", description="", example="12"),
     *         @SWG\Property(property="status", type="string", description="", example="13"),
     *         @SWG\Property(property="vital_signs", type="object", description="", example="123"),
     *         @SWG\Property(property="triage", type="object", description="", example="12"),
     *         @SWG\Property(property="hematic_biometry", type="integer", description="", example="65"),
     *    )
     * )
     * @SWG\Response(response=200, description="Crea un nuevo expediente y regresa el detalle", @Model(type=Record::class))
     */
    public function predictionModelTest(Request $request): View
    {
        $body = $request->getContent();

        //Manda a procesar el modelo de predicción con el objeto recién creado
        $httpClient = HttpClient::create();
        $response = $httpClient->request('POST',
            'https://6ep2ew4noc.execute-api.us-east-1.amazonaws.com/BaseModel', [
                'body' => $body
            ]);

        return View::create($response->getContent(), Response::HTTP_CREATED);
    }

    /**
     * @Rest\Put("/records/{id}")
     * @param Request $request
     * @param Record $record
     * @return View
     *
     * @SWG\Parameter(name="id", in="path", type="string", description="ID del expendiente a buscar")
     * @SWG\Parameter(name="body", in="body",
     *    @SWG\Schema(type="object",
     *         @SWG\Property(property="admission_date", type="datetime", description="", example="10"),
     *         @SWG\Property(property="id_canonical", type="string", description="", example="12")
     *    )
     * )
     * @SWG\Response(response=200, description="Actualiza los datos de un expediente", @Model(type=Record::class))
     */
    public function edit(Request $request, Record $record): View
    {
        $form = $this->createForm(RecordType::class, $record);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
        }

        return View::create($record);
    }

    /**
     * @Rest\Delete("/records/{id}")
     * @param Record $record
     * @return View
     *
     * @SWG\Parameter(name="id", in="path", type="string", description="ID del expendiente a buscar")
     * @SWG\Response(response=200, description="Hace un borrado 'suave' de un expediente", @Model(type=Record::class))
     */
    public function delete(Record $record): View
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($record);
        $entityManager->flush();

        return View::create(["message" => "El expediente se eliminó correctamente"]);
    }
}
