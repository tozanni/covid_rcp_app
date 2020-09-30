<?php

namespace App\Form;

use App\Entity\CardiacEnzymes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CardiacEnzymesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cpk', null, ['required' => false])
            ->add('miogoblin', null, ['required' => false])
            ->add('record')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CardiacEnzymes::class,
        ]);
    }
}
