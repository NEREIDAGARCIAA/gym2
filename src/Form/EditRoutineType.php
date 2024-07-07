<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditRoutineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, [
            'label' => 'Nombre de la rutina',
            'attr'  => [
                'placeholder' => '',
                'class' => 'form-control',
                'required' => true
            ]
        ] )
        ->add('focus', TextType::class, [
            'label' => 'Enfoque',
            'attr'  => [
                'placeholder' => '',
                'class' => 'form-control',
                'required' => true
            ]
        ] )
        ->add('exercises', TextType::class, [
            'label' => 'Ejercicios',
            'attr'  => [
                'placeholder' => '',
                'class' => 'form-control',
                'required' => true
            ]
        ] )
        ->add('reps', TextType::class, [
            'label' => 'Reps',
            'attr'  => [
                'placeholder' => '',
                'class' => 'form-control',
                'required' => true
            ]
        ] )
        ->add('series', TextType::class, [
            'label' => 'Series',
            'attr'  => [
                'placeholder' => '',
                'class' => 'form-control',
                'required' => true
            ]
        ] )
        ->add('submit', SubmitType::class, [
            'label' => 'Guardar',
            'attr'  => [
                'class' => 'btn btn-success',
            ]
        ] )
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
