<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class VitalSignsAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('age')
            ->add('gender')
            ->add('weight')
            ->add('height')
            ->add('diastolic_blood_pressure')
            ->add('systolic_blood_pressure')
            ->add('heart_rate')
            ->add('breathing_frequency')
            ->add('temperature')
            ->add('oximetry')
            ->add('capillary_glucose')
            ->add('created_at')
            ->add('updated_at')
            ->add('id')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('age')
            ->add('gender')
            ->add('weight')
            ->add('height')
            ->add('diastolic_blood_pressure')
            ->add('systolic_blood_pressure')
            ->add('heart_rate')
            ->add('breathing_frequency')
            ->add('temperature')
            ->add('oximetry')
            ->add('capillary_glucose')
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
            ->add('age')
            ->add('gender')
            ->add('weight')
            ->add('height')
            ->add('diastolic_blood_pressure')
            ->add('systolic_blood_pressure')
            ->add('heart_rate')
            ->add('breathing_frequency')
            ->add('temperature')
            ->add('oximetry')
            ->add('capillary_glucose')
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('age')
            ->add('gender')
            ->add('weight')
            ->add('height')
            ->add('diastolic_blood_pressure')
            ->add('systolic_blood_pressure')
            ->add('heart_rate')
            ->add('breathing_frequency')
            ->add('temperature')
            ->add('oximetry')
            ->add('capillary_glucose')
            ->add('created_at')
            ->add('updated_at')
            ->add('id')
            ;
    }
}
