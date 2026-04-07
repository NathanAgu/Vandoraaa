<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de l\'article',
                'attr' => ['placeholder' => 'Ex: Nike Air Max 90']
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => ['placeholder' => 'Décrivez l\'état, les défauts...', 'rows' => 5]
            ])
            ->add('brand', TextType::class, [
                'label' => 'Marque',
                'attr' => ['placeholder' => 'Ex: Nike, Adidas, Zara...'],
                'required' => false
            ])
            ->add('state', ChoiceType::class, [
                'label' => 'État',
                'choices' => [
                    'Comme neuf' => 'Comme neuf',
                    'Bon état' => 'Bon état',
                    'État correct' => 'État correct',
                    'Usé' => 'Usé',
                ],
                'placeholder' => 'Choisir l\'état'
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix (€)',
                'currency' => 'EUR',
                'attr' => ['placeholder' => '0,00']
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'Statut',
                'choices' => [
                    'En vente' => 1,
                    'Vendu' => 0,
                ]
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'label' => 'Catégorie',
                'placeholder' => 'Sélectionner une catégorie',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
