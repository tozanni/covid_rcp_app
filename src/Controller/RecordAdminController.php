<?php

declare(strict_types=1);

namespace App\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class RecordAdminController extends CRUDController
{
    public function showInAppAction($id)
    {
        $object = $this->admin->getSubject();

        if (!$object) {
            throw new NotFoundHttpException(sprintf('No se encontró el registro solicitado con el ID: %s', $id));
        }

        return $this->redirect('https://www.rcpcovid19.mx/medical-record/'.$id);
    }
}
