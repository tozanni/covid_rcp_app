<?php

namespace App\Form;

use App\Entity\Record;
use Sonata\Form\Type\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('admission_date', DateTimeType::class)
            ->add('id_canonical', TextType::class)
            ->add('status', TextType::class)
            ->add('egress_date', DateTimeType::class)
            ->add('egress_type', TextType::class)
            ->add('rcp_required', BooleanType::class)
            ->add('treatment', TextareaType::class)
            ->add('egress_notes', TextareaType::class)
            ->add('vitalSigns', VitalSignsType::class)
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