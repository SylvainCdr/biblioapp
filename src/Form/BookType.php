<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Category;
use App\Entity\Editor;
use App\Entity\Format;
use App\Entity\Language;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class, [
                'label'=>'Titre du livre',
                'attr'=>[
                    'class'=>'form-control'],
            ])
            ->add('year',NumberType::class, [
                'label'=>'Année de sortie',
                'attr'=>[
                    'class'=>'form-control'],
            ])
            ->add('isbn',TextType::class, [
                'label'=>'ISBN',
                'attr'=>[
                    'class'=>'form-control'],
            ])
            ->add('price',MoneyType::class, [
                'label'=>'Prix',
                'attr'=>[
                    'class'=>'form-control'],
            ])
            ->add('pages',NumberType::class, [
                'label'=>'Nombre de pages',
                'attr'=>[
                    'class'=>'form-control'],
            ])
            ->add('description',TextareaType::class, [
                'label'=>'Description',
                'attr'=>[
                    'class'=>'form-control'],
            ])
            ->add('slug',TextType::class, [
                'label'=>'Année du livre',
                'attr'=>[
                    'class'=>'form-control'],
            ])
            ->add('cover',TextType::class, [
                'label'=>'Couverture',
                'attr'=>[
                    'class'=>'form-control'],
            ])
            ->add('isAvailable',CheckboxType::class, [
                'label'=>'Disponibilité',
                'attr'=>[
                    'class'=>'form-check'],
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class, //class de l entité
                'choice_label' => 'name',
                'label' => 'Catégorie du livre',
                'attr' => [
                'class' => 'form-control' //class boostrap
                ],
            ])

            ->add('authors',EntityType::class, [
                'class' => Author::class, //class de l entité
                'choice_label' => 'lastname',
                'multiple'=> true,
                'label' => 'Autheur(s)',
                'attr' => [
                'class' => 'form-control' //class boostrap
                ],
            ])

            ->add('format',EntityType::class, [
                'class' => Format::class, //class de l entité
                'choice_label' => 'name',
                'label' => 'Format',
                'attr' => [
                'class' => 'form-control' //class boostrap
                ],
            ])
            ->add('editor',EntityType::class, [
                'class' => Editor::class, //class de l entité
                'choice_label' => 'name',
                'label' => 'Editeur',
                'attr' => [
                'class' => 'form-control' //class boostrap
                ],
            ])
            ->add('language',EntityType::class, [
                'class' => Language::class, //class de l entité
                'choice_label' => 'name',
                'label' => 'Langue',
                'attr' => [
                'class' => 'form-control' //class boostrap
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
