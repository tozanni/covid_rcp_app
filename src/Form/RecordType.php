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
            ->add('vitalSigns', VitalSignsType::class, ['required' => false])
            ->add('triage', TriageType::class, ['required' => false])
            ->add('hematicBiometry', HematicBiometryType::class, ['required' => false])
            ->add('bloodChemistry', BloodChemistryType::class, ['required' => false])
            ->add('serumElectrolytes', SerumElectrolytesType::class, ['required' => false])
            ->add('medicalNotes', MedicalNotesType::class, ['required' => false])
            ->add('liverFunction', LiverFunctionType::class, ['required' => false])
            ->add('clottingTime', ClottingTimeType::class, ['required' => false])
            ->add('immunological', ImmunologicalType::class, ['required' => false])
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