<?php

namespace App\Form;

use App\Entity\LiverFunction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LiverFunctionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('aspartate_aminotransferase', TextType::class, ["required" => false])
            ->add('alanine_transaminase', TextType::class, ["required" => false])
            ->add('blood_urea_nitrogen', TextType::class, ["required" => false])
            ->add('record')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LiverFunction::class,
        ]);
    }
}
