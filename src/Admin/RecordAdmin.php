<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
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
            ->add('admission_date')
            ->add('id_canonical')
            ->add('status')
            ->add('egress_date')
            ->add('egress_type')
            ->add('rcp_required')
            ->add('treatment')
            ->add('egress_notes')
            ->add('created_at')
            ->add('updated_at')
            ->add('id')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('admission_date')
            ->add('id_canonical')
            ->add('status')
            ->add('egress_date')
            ->add('egress_type')
            ->add('rcp_required')
            ->add('treatment')
            ->add('egress_notes')
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
            ->with('General', ['class' => 'col-md-9'])
                ->add('admission_date', DatePickerType::class)
                ->add('id_canonical')
                ->add('status')
                ->add('vitalSigns', AdminType::class)
            ->end()
            ->with('Covid-19 Labs', ['class' => 'col-md-3'])
                ->add('covid', AdminType::class)
            ->end()
            ->with("Egress", ['class' => 'col-md-3'])
                ->add('egress_type')
                ->add('rcp_required', BooleanType::class)
                ->add('treatment', TextareaType::class)
                ->add('egress_notes', TextareaType::class)
                ->add('egress_date', DatePickerType::class)
            ->end()
            ->with('Triage', ['class' => 'col-md-9'])
                ->add('triage', AdminType::class)
            ->end()
            ->with('Labs')
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
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('admission_date')
            ->add('id_canonical')
            ->add('status')
            ->add('egress_date')
            ->add('egress_type')
            ->add('rcp_required')
            ->add('treatment')
            ->add('egress_notes')
            ->add('created_at')
            ->add('updated_at')
            ->add('id')
            ;
    }
}
