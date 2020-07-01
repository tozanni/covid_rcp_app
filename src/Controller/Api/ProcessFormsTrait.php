<?php

namespace App\Controller\Api;

use App\Application\ApiProblem;
use FOS\RestBundle\View\View;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

trait ProcessFormsTrait
{
    private function processForm(Request $request, FormInterface $form)
    {
        $body = $request->getContent();
        $data = json_decode($body, true);

        $clearMissing = $request->getMethod() != 'PATCH';
        $form->submit($data, $clearMissing);
    }

    private function getFormErrors(FormInterface $form)
    {
        $errors = [];
        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }

        foreach ($form->all() as $childForm) {
            if ($childForm instanceof FormInterface) {
                if ($childErrors = $this->getFormErrors($childForm)) {
                    $errors[$childForm->getName()] = $childErrors;
                }
            }
        }

        return $errors;
    }

    private function createValidationErrorResponse(FormInterface $form)
    {
        $errors = $this->getFormErrors($form);

       $apiProblem = new ApiProblem(
           Response::HTTP_BAD_REQUEST,
           'validation_error',
           'Hubo un problema de validación'
       );
       $apiProblem->set('errors', $errors);

        return View::create($apiProblem->toArray(), Response::HTTP_BAD_REQUEST,
            ['Content-Type' => 'application/problem+json']
        );
    }
}