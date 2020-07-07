<?php

namespace App\Form;

use App\Entity\VitalSigns;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VitalSignsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('age', DateTimeType::class, [
                'widget' => 'single_text', 'format' => 'yyyy-MM-dd HH:mm:ss'])
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
            ->add('record')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => VitalSigns::class,
        ]);
    }
}
