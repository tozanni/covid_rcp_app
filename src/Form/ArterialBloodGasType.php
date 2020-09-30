<?php

namespace App\Form;

use App\Entity\ArterialBloodGas;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArterialBloodGasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ph', null, ["required" => false])
            ->add('o2', null, ["required" => false])
            ->add('hco3', null, ["required" => false])
            ->add('be', null, ["required" => false])
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
