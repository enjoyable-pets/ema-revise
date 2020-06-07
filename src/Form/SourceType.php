<?php

namespace App\Form;

use App\Entity\Source;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SourceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content')
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Exercise' => 'exercise',
                    'Exercise answer' => 'answer',
                    'Textbook' => 'textbook',
                    'Other' => 'other',
                ]
            ])
            ->add('url')
            ->add('addedAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Source::class,
            'csrf_protection' => false,
        ]);
    }
}
