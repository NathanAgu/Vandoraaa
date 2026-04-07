<?php

namespace App\Form;

use App\Entity\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('rating', ChoiceType::class, [
                'label' => 'Note',
                'choices' => [
                    '⭐ (1 étoile)' => 1,
                    '⭐⭐ (2 étoiles)' => 2,
                    '⭐⭐⭐ (3 étoiles)' => 3,
                    '⭐⭐⭐⭐ (4 étoiles)' => 4,
                    '⭐⭐⭐⭐⭐ (5 étoiles)' => 5,
                ],
                'placeholder' => 'Choisir une note'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Votre avis',
                'attr' => [
                    'placeholder' => 'Décrivez votre expérience avec ce vendeur...',
                    'rows' => 5
                ],
                'required' => false
            ])
            ->add('submit', SubmitType::class, [
                'label' => '✓ Envoyer mon avis',
                'attr' => ['class' => 'btn-submit']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}
