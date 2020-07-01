<?php

namespace App\Form;

use App\Entity\Record;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('admission_date', DateTimeType::class, [
                'widget' => 'single_text', 'format' => 'yyyy-MM-dd HH:mm:ss'])
            ->add('id_canonical')
            ->add('status')
            ->add('egress_date')
            ->add('egress_type')
            ->add('rcp_required')
            ->add('treatment')
            ->add('egress_notes')
            ->add('vitalSigns')
            ->add('triage')
            ->add('hematicBiometry')
            ->add('bloodChemistry')
            ->add('serumElectrolytes')
            ->add('medicalNotes')
            ->add('liverFunction')
            ->add('clottingTime')
            ->add('immunological')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Record::class,
        ]);
    }

    public function getName()
    {
        return 'record';
    }
}