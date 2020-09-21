<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\DatePickerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

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
            ->add('age', DatePickerType::class)
            ->add('gender', ChoiceType::class, [
                'choices' => ['Male' => 'male', 'Female' => 'female',]
            ])
            ->add('weight', null, ['attr' => ['placeholder' => 'kg']])
            ->add('height', null, ['attr' => ['placeholder' => 'cm']])
            ->add('diastolic_blood_pressure', null, ['attr' => ['placeholder' => 'mmhg']])
            ->add('systolic_blood_pressure', null, ['attr' => ['placeholder' => 'mmhg']])
            ->add('heart_rate', null, ['attr' => ['placeholder' => 'latidos/min']])
            ->add('breathing_frequency', null, ['attr' => ['placeholder' => 'respiraciones/min']])
            ->add('temperature', null, ['attr' => ['placeholder' => 'ºC']])
            ->add('oximetry', null, ['attr' => ['placeholder' => '%']])
            ->add('capillary_glucose', null, ['attr' => ['placeholder' => 'mg/dl']])
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
