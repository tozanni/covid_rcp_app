<?php

namespace App\Form;

use App\Entity\HematicBiometry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HematicBiometryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('hematocrit')
            ->add('hemoglobin')
            ->add('leukocytes')
            ->add('platelets')
            ->add('record')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => HematicBiometry::class,
        ]);
    }
}
