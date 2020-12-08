<?php

namespace App\Controller\Api;

use App\Entity\Record;
use App\Form\RecordType;
use App\Repository\RecordRepository;
use FOS\RestBundle\Controller\{AbstractFOSRestController, Annotations as Rest};
use FOS\RestBundle\View\View;
use JMS\Serializer\SerializerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Contracts\HttpClient\Exception\{
    ClientExceptionInterface,
    DecodingExceptionInterface,
    RedirectionExceptionInterface,
    ServerExceptionInterface,
    TransportExceptionInterface
};
use Symfony\Component\Security\Core\Security;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Class RecordController
 * @package App\Controller\Api
 * @SWG\Tag(name="Record")
 */
class RecordController extends AbstractFOSRestController
{
    use ProcessFormsTrait;

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Rest\Get("/records")
     * @param RecordRepository $recordRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return View
     *
     * @SWG\Response(response=200, description="Devuelve un listado de expedientes",
     *      @SWG\Schema(type="array", @Model(type=Record::class))
     * )
     */
    public function index(RecordRepository $recordRepository, PaginatorInterface $paginator, Request $request): View
    {
        $user = $this->security->getUser();
        $records = [];

        if ($user->getUsername() == 'anonymous') {
            return $this->respondUnauthorized();
        }

        if ($user->hasRole('ROLE_SUPER_ADMIN')) { //Super Admin: Trae todos los registros
            $records = $recordRepository->findAll();
        } //Administrador del hospital o capturista: puede ver TODOS los registros de SU hospital asignado
        elseif ($user->hasRole('ROLE_HOSPITAL_ADMIN') || $user->hasRole('ROLE_HOSPITAL_CAPTURISTA')) {
            //TODO: Validar que siempre se asigne un solo hospital al usuario en el admin panel
            $hospital = $user->getGroups()[0];

            $records = $recordRepository->findByHospital($hospital);
        }

        return View::create($paginator->paginate($records,
            $request->query->getInt('page', 1),
            30
        ));
    }

    /**
     * @Rest\Post("/records/search")
     * @param RecordRepository $recordRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return View
     */
    public function searchByIdOrCanonicalId(RecordRepository $recordRepository, PaginatorInterface $paginator, Request $request): View
    {
        $user = $this->security->getUser();
        $id = $request->get('q');
        $records = [];

        if ($user->hasRole('ROLE_SUPER_ADMIN')) { //Super Admin: Trae todos los registros
            $records = $recordRepository->findAllById($id);
        } //Administrador del hospital o capturista: puede ver TODOS los registros de SU hospital asignado
        elseif ($user->hasRole('ROLE_HOSPITAL_ADMIN') || $user->hasRole('ROLE_HOSPITAL_CAPTURISTA')) {
            $hospital = $user->getGroups()[0];

            $records = $recordRepository->findByHospitalAndId($hospital, $id);
        }

        return View::create($paginator->paginate($records,
            $request->query->getInt('page', 1), 10));
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
        $user = $this->security->getUser();

        if ($user->getUsername() == 'admin') {
            return View::create($record);
        }

        //TODO: Revisar si el registro es del mismo hospital
        if (!$record->getCreatedBy() || $record->getCreatedBy()->getId() != $user->getId()) {
            return View::create([
                'error' => 401,
                'message' => '¡No tienes permiso para ver este registro!',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return View::create($record);
    }

    /**
     * @Rest\Post("/records")
     * @param Request $request
     * @return View
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
     * @SWG\Response(response=201, description="Crea un nuevo expediente y regresa el detalle", @Model(type=Record::class))
     */
    public function create(Request $request): View
    {
        $record = new Record();
        $form = $this->createForm(RecordType::class, $record);
        $this->processForm($request, $form);

        if (!$form->isValid()) {
            return $this->createValidationErrorResponse($form);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($record);
        $entityManager->flush();

        return View::create($record, Response::HTTP_CREATED);
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
     * @SWG\Response(response=404, description="Record resource not found.",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="code", type="integer", example=404),
     *          @SWG\Property(property="message", type="string", example="Record resource not found.")
     *     )
     * )
     */
    public function edit(Request $request, Record $record): View
    {
        $form = $this->createForm(RecordType::class, $record);
        $this->processForm($request, $form);

        if (!$form->isValid()) {
            return $this->createValidationErrorResponse($form);
        }

        $this->getDoctrine()->getManager()->flush();

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

    /**
     * @Rest\get("/records/{id}/prediction")
     * @param Record $record
     * @param SerializerInterface $serializer
     * @return View
     *
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface|DecodingExceptionInterface
     * @SWG\Parameter(name="id", in="path", type="string", description="ID del expendiente a buscar")
     * @SWG\Response(response=200, description="Resultaddo del modelo de predicción")
     * @SWG\Response(response=404, description="Record resource not found.",
     *     @SWG\Schema(type="object",
     *          @SWG\Property(property="code", type="integer", example=404),
     *          @SWG\Property(property="message", type="string", example="Record resource not found.")
     *     )
     * )
     */
    public function prediction(Record $record, SerializerInterface $serializer): View
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Record::class);
        $serializedJson = $repo->serializeRecord($record, $serializer);

        $predictionResponse = $this->requestToPredictionModel($serializedJson);

        if ($predictionResponse->getStatusCode() !== Response::HTTP_OK) {
            return View::create($predictionResponse->getContent(), $predictionResponse->getStatusCode());
        }

        return View::create($predictionResponse->toArray());
    }

    /**
     * @param $record
     * @return ResponseInterface
     * @throws TransportExceptionInterface
     */
    private function requestToPredictionModel($record)
    {
        $httpClient = HttpClient::create();

        return $httpClient->request('POST',
            'https://6ep2ew4noc.execute-api.us-east-1.amazonaws.com/BaseModel',
            ['body' => $record]
        );
    }

    /**
     * @return \FOS\RestBundle\View\View
     */
    protected function respondUnauthorized(): View
    {
        return View::create([
            'error' => 401,
            'message' => 'Para ver el listado necesitas iniciar sesión',
        ], Response::HTTP_UNAUTHORIZED);
    }
}