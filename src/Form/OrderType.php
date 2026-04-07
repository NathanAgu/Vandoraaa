<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('price', MoneyType::class, [
                'label' => 'Prix proposé (€)',
                'currency' => 'EUR',
                'attr' => ['placeholder' => '0,00']
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Message au vendeur (optionnel)',
                'required' => false,
                'attr' => ['placeholder' => 'Proposez un prix, posez des questions...']
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'Statut initial',
                'choices' => [
                    'En attente' => 'pending',
                    'Confirmée' => 'confirmed',
                    'Expédiée' => 'shipped',
                    'Livrée' => 'delivered',
                    'Annulée' => 'cancelled',
                ],
                'data' => 'pending'
            ])
            ->add('submit', SubmitType::class, [
                'label' => '✓ Faire une proposition',
                'attr' => ['class' => 'btn-submit']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
