<?php

namespace App\Form;

use App\Entity\BloodChemistry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BloodChemistryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('glucose', null, ["required" => false])
            ->add('urea', null, ["required" => false])
            ->add('creatinine', null, ["required" => false])
            ->add('cholesterol', null, ["required" => false])
            ->add('triglycerides', null, ["required" => false])
            ->add('glycated_hemoglobin', TextType::class, ["required" => false])
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
