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
            ->add('status', null, ['required' => false])
            ->add('egress_date')
            ->add('egress_type')
            ->add('rcp_required')
            ->add('treatment')
            ->add('egress_notes')
            ->add('vital_signs', VitalSignsType::class, ['required' => false])
            ->add('triage', TriageType::class, ['required' => false])
            ->add('covid', CovidType::class, ['required' => false])
            ->add('hematic_biometry', HematicBiometryType::class, ['required' => false])
            ->add('blood_chemistry', BloodChemistryType::class, ['required' => false])
            ->add('serum_electrolytes', SerumElectrolytesType::class, ['required' => false])
            ->add('medical_notes', MedicalNotesType::class, ['required' => false])
            ->add('liver_function', LiverFunctionType::class, ['required' => false])
            ->add('clotting_time', ClottingTimeType::class, ['required' => false])
            ->add('immunological', ImmunologicalType::class, ['required' => false])
            ->add('imaging', ImagingType::class, ['required' => false])
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