<?php

namespace App\Form;

use App\Entity\Covid;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CovidType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pcr', TextType::class, ['required' => false])
            ->add('ldh', TextType::class, ['required' => false])
            ->add('il_6', TextType::class, ['required' => false])
            ->add('ferritin', TextType::class, ['required' => false])
            ->add('troponin', TextType::class, ['required' => false])
            ->add('igm', TextType::class, ['required' => false])
            ->add('igg', TextType::class, ['required' => false])
            ->add('record')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Covid::class,
        ]);
    }
}
