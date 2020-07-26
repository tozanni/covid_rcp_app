<?php

namespace App\Controller\Api;

use FOS\RestBundle\Controller\{AbstractFOSRestController, Annotations as Rest};
use App\Entity\Contact;
use App\Form\ContactType;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\{Request, Response};
use Swagger\Annotations as SWG;

/**
 * Class ContactController
 * @package App\Controller\Api
 * @SWG\Tag(name="Contact")
 */
class ContactController extends AbstractFOSRestController
{
    use ProcessFormsTrait;

    /**
     * @Rest\Post("/contacts", name="contact")
     * @param Request $request
     * @return View
     *
     * @SWG\Parameter(name="body", in="body", @SWG\Schema(type="object",
     *  @SWG\Property(property="name", type="string", description="El nombre del contacto", example="Jhon Doe"),
     *  @SWG\Property(property="subject", type="string", description="Título del asunto, viene del dropdown", example="Quiero Colaborar"),
     *  @SWG\Property(property="email", type="string", description="Correo electrónico del contacto", example="jhon@example.com"),
     *  @SWG\Property(property="message", type="text", description="Mensaje del contacto", example="Parrafo con el mensaje de texto a enviar"),
     * ))
     *
     * @SWG\Response(response=201, description="El mensaje ha sido creado y enviado", @Model(type=Contact::class))
     */
    public function create(Request $request): View
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $this->processForm($request, $form);

        if (!$form->isValid()) {
            return $this->createValidationErrorResponse($form);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($contact);
        $entityManager->flush();

        return View::create($contact, Response::HTTP_CREATED);
    }
}
