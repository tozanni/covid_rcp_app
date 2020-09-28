<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\DataTransformer\ModelsToArrayTransformer;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\AdminType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\BooleanType;
use Sonata\Form\Type\DatePickerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

final class RecordAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('id_canonical')
            ->add('admission_date')
            ->add('status')
            ->add('egress_date')
            ->add('egress_type')
            ->add('rcp_required')
            ->add('treatment')
            ->add('egress_notes')
            ->add('created_at')
            ->add('updated_at')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('id')
            ->add('id_canonical')
            ->add('admission_date')
            ->add('status')
            ->add('egress_date')
            ->add('egress_type')
            ->add('rcp_required')
            ->add('created_at')
            ->add('updated_at')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    //'edit' => [],
                    //'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->tab('General', ['class' => 'col-md-9'])
                ->with('General')
                ->add('admission_date', DatePickerType::class)
                ->add('id_canonical')
                ->add('status')
                ->add('vitalSigns', AdminType::class)
                ->end()
            ->end()
            ->tab('Covid-19 Labs', ['class' => 'col-md-3'])
                ->with('Covid')
                ->add('covid', AdminType::class)
                ->end()
            ->end()
            ->tab("Egress", ['class' => 'col-md-3'])
                ->with('Egreso')
                ->add('egress_type')
                ->add('rcp_required', BooleanType::class)
                ->add('treatment', TextareaType::class)
                ->add('egress_notes', TextareaType::class)
                ->add('egress_date', DatePickerType::class)
                ->end()
            ->end()
            ->tab('Triage', ['class' => 'col-md-9'])
                ->with('Triage')
                ->add('triage', AdminType::class)
                ->end()
            ->end()
            ->tab('Labs')
                ->with('Laboratorios')
                ->add('hematicBiometry', AdminType::class)
                ->add('bloodChemistry', AdminType::class)
                ->add('serumElectrolytes', AdminType::class)
                ->add('liverFunction', AdminType::class)
                ->add('clottingTime', AdminType::class)
                ->add('immunological', AdminType::class)
                ->add('cardiacEnzymes', AdminType::class)
                ->add('arterialBloodGas', AdminType::class)
                ->add('imaging', AdminType::class)
                ->end()
            ->end()
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->tab('General')
                ->with('General', ['class' => 'col-md-9'])
                ->add('admission_date')
                ->add('id_canonical')
                ->add('status')
                ->add('vitalSigns')
                ->end()
                ->with('Egreso', ['class' => 'col-md-3'])
                ->add('egress_type')
                ->add('rcp_required')
                ->add('treatment')
                ->add('egress_notes')
                ->add('egress_date')
                ->end()
            ->end()
            ->tab('Covid-19 Labs', ['class' => 'col-md-3'])
                ->with('Covid')
                ->add('covid')
                ->end()
            ->end()
            ->tab('Triage')
                ->with('Triage')
                ->add('triage', AdminType::class)
                ->end()
            ->end()
            ->tab('Labs')
                ->with('Laboratorios')
                    ->add('hematicBiometry')
                    ->add('bloodChemistry')
                    ->add('serumElectrolytes')
                    ->add('liverFunction')
                    ->add('clottingTime')
                    ->add('immunological')
                    ->add('cardiacEnzymes')
                    ->add('arterialBloodGas')
                    ->add('imaging')
                ->end()
            ->end()
        ;
    }
}
