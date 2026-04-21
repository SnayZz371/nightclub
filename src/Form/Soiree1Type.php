<?php

namespace App\Form;

use App\Entity\Artist;
use App\Entity\Soiree;
use App\Entity\Theme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Soiree1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('dateSoiree', null, [
                'widget' => 'single_text',
            ])
            ->add('dateCreation', null, [
                'widget' => 'single_text',
            ])
            ->add('statut')
            ->add('soiree_artist', EntityType::class, [
        'class' => Artist::class,
        'choice_label' => 'nom',
        'multiple' => true,
        'required' => false,
        ])
        ->add('themeSoiree', EntityType::class, [
        'class' => Theme::class,
        'choice_label' => 'nom',
        'multiple' => false,
        'required' => false,
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Soiree::class,
        ]);
    }
}
