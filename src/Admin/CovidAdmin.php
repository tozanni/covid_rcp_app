<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Covid;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class CovidAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('pcr')
            ->add('ldh')
            ->add('il_6')
            ->add('ferritin')
            ->add('troponin')
            ->add('igm')
            ->add('igg')
            ->add('id')
            ->add('created_at')
            ->add('updated_at')
        ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('pcr')
            ->add('ldh')
            ->add('il_6')
            ->add('ferritin')
            ->add('troponin')
            ->add('igm')
            ->add('igg')
            ->add('id')
            ->add('created_at')
            ->add('updated_at')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->add('pcr')
            ->add('ldh')
            ->add('il_6')
            ->add('ferritin')
            ->add('troponin')
            ->add('igm')
            ->add('igg');
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('pcr')
            ->add('ldh')
            ->add('il_6')
            ->add('ferritin')
            ->add('troponin')
            ->add('igm')
            ->add('igg');
    }
}
