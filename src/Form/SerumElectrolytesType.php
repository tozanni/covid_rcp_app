<?php

namespace App\Form;

use App\Entity\SerumElectrolytes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SerumElectrolytesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sodium', null, ["required" => false])
            ->add('potassium', null, ["required" => false])
            ->add('record')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SerumElectrolytes::class,
        ]);
    }
}
