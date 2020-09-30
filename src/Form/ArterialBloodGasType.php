<?php

namespace App\Form;

use App\Entity\ArterialBloodGas;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArterialBloodGasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ph', TextType::class, ["required" => false])
            ->add('o2', TextType::class, ["required" => false])
            ->add('co2', TextType::class, ["required" => false])
            ->add('hco3', TextType::class, ["required" => false])
            ->add('be', TextType::class, ["required" => false])
            ->add('record')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ArterialBloodGas::class,
        ]);
    }
}
