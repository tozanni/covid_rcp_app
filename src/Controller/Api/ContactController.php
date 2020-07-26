<?php

namespace App\Controller\Api;

use FOS\RestBundle\Controller\{AbstractFOSRestController, Annotations as Rest};
use App\Entity\Contact;
use App\Form\ContactType;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\{Request, Response};

class ContactController extends AbstractFOSRestController
{
    use ProcessFormsTrait;

    /**
     * @Rest\Post("/contacts", name="contact")
     * @param Request $request
     * @return View
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
