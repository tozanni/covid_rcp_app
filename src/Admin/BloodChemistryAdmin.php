<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class BloodChemistryAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('glucose')
            ->add('urea')
            ->add('creatinine')
            ->add('cholesterol')
            ->add('triglycerides')
            ->add('glycated_hemoglobin')
            ->add('created_at')
            ->add('updated_at')
            ->add('id')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('glucose')
            ->add('urea')
            ->add('creatinine')
            ->add('cholesterol')
            ->add('triglycerides')
            ->add('glycated_hemoglobin')
            ->add('created_at')
            ->add('updated_at')
            ->add('id')
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
            ->add('glucose')
            ->add('urea')
            ->add('creatinine')
            ->add('cholesterol')
            ->add('triglycerides')
            ->add('glycated_hemoglobin')
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('glucose')
            ->add('urea')
            ->add('creatinine')
            ->add('cholesterol')
            ->add('triglycerides')
            ->add('glycated_hemoglobin')
            ->add('created_at')
            ->add('updated_at')
            ->add('id')
            ;
    }
}
