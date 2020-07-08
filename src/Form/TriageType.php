<?php

namespace App\Form;

use App\Entity\Triage;
use Sonata\Doctrine\Types\JsonType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TriageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('days_before_admission')
            ->add('difficulty_breathing')
            ->add('chest_pain')
            ->add('headache')
            ->add('cough')
            ->add('other_symptoms', CollectionType::class, ['entry_type' => TextType::class, 'allow_add' => true])
            ->add('comorbidities', CollectionType::class, ['entry_type' => TextType::class, 'allow_add' => true])
            ->add('smoker')
            ->add('pregnant')
            ->add('record')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Triage::class,
        ]);
    }
}
