<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class TriageAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('days_before_admission')
            ->add('difficulty_breathing')
            ->add('chest_pain')
            ->add('headache')
            ->add('cough')
            ->add('other_symptoms')
            ->add('comorbidities')
            ->add('smoker')
            ->add('pregnant')
            ->add('created_at')
            ->add('updated_at')
            ->add('id')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('days_before_admission')
            ->add('difficulty_breathing')
            ->add('chest_pain')
            ->add('headache')
            ->add('cough')
            ->add('other_symptoms')
            ->add('comorbidities')
            ->add('smoker')
            ->add('pregnant')
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
            ->add('days_before_admission')
            ->add('difficulty_breathing')
            ->add('chest_pain')
            ->add('headache')
            ->add('cough')
            ->add('other_symptoms')
            ->add('comorbidities')
            ->add('smoker')
            ->add('pregnant')
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('days_before_admission')
            ->add('difficulty_breathing')
            ->add('chest_pain')
            ->add('headache')
            ->add('cough')
            ->add('other_symptoms')
            ->add('comorbidities')
            ->add('smoker')
            ->add('pregnant')
            ->add('created_at')
            ->add('updated_at')
            ->add('id')
            ;
    }
}
