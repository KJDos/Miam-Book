<?php

namespace App\Form;

use App\Entity\Recipe;

use App\Form\ApplicationType;
use Presta\ImageBundle\Form\Type\ImageType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RecipeType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                TextType::class,
                $this->getConfiguration("Nom", "Donnez un nom à votre recette...")
            )
            ->add(
                'ingredients',
                CollectionType::class,
                [
                    'entry_type' => IngredientType::class,
                    'allow_add' => true,
                    'allow_delete' => true
                ]
            )
            ->add(
                'part',
                IntegerType::class,
                $this->getConfiguration("Portion", "Combien de portions représente cette recette ?")
            )
            ->add(
                'category',
                ChoiceType::class,
                [
                    'label' => 'Categorie',
                    'choices' =>
                    [
                        'Entrée' => 'Entrée',
                        'Plat' => 'Plat',
                        'Dessert' => 'Dessert'
                    ]
                ]
            )
            ->add(
                'steps',
                CollectionType::class,
                [
                    'entry_type' => StepType::class,
                    'allow_add' => true,
                    'allow_delete' => true
                ]
            )
            ->add('imageFile', ImageType::class, [
                'required' => true,
                'preview_width' => 540,
                'preview_height' => 245,
                'max_width' => 1000,
                'max_height' => 457,
                'enable_remote' => false,
                'upload_mimetype' => 'image/jpeg',
                'upload_quality' => 1,
                'cropper_options' => [
                    'autoCropArea' => 1.0,
                    'autoCrop' => true,
                    'viewMode' => 1,
                    'guides' => false,
                    'minCropBoxWidth' => 1000,
                    'minCropBoxHeight' => 457

                    
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
