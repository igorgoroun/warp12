<?php

namespace snakemkua\Warp12Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class PageContentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('body', TextareaType::class, [
                'label' => 'Page content',
                'attr' => ['class' => 'materialize-textarea']
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Save',
                'attr' => ['class' => 'btn waves-effect waves-light']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'snakemkua\Warp12Bundle\Entity\Page'
        ));
    }

    public function getName()
    {
        return 'snakemkua_warp12bundle_pagecontent';
    }
}
