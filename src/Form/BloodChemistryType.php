<?php

namespace App\Form;

use App\Entity\BloodChemistry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BloodChemistryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('glucose')
            ->add('urea')
            ->add('creatinine')
            ->add('cholesterol')
            ->add('triglycerides')
            ->add('glycated_hemoglobin')
            ->add('record')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BloodChemistry::class,
        ]);
    }
}
