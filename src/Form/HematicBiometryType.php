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
            ->add('hematocrit', null, ["required" => false])
            ->add('hemoglobin', null, ["required" => false])
            ->add('leukocytes', null, ["required" => false])
            ->add('lymphocytes', null, ["required" => false])
            ->add('platelets', null, ["required" => false])
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
