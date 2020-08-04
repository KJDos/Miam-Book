<?php

namespace App\Form;

use App\Entity\Ingredient;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class IngredientType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity')
            ->add(
                'unit',
                ChoiceType::class,
                [
                    'label' => 'unité',
                    'required'   => false,
                    'choices' =>
                    [
                        '(vide)' => '',
                        'g' => 'g',
                        'mL' => 'mL',
                        'cL' => 'cL',
                        'L' => 'L',
                        'pincée' => 'pincée',
                        'sachet' => 'sachet',
                        'cuillère à soupe' => 'cuillère à soupe',
                        'cueillère à café' => 'cueillère à café'
                    ]
                ]
            )
            ->add('name')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ingredient::class,
        ]);
    }
}
