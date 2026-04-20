<?php

namespace App\Form;

use App\Entity\Soiree;
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Soiree::class,
        ]);
    }
}
