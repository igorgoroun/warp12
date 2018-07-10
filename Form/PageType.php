<?php

namespace snakemkua\Warp12Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\Loader\CallbackChoiceLoader;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class PageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Название'
            ])
            ->add('title', TextType::class, [
                'label' => 'SEO заголовок (Title)'
            ])
            ->add('metadescription', TextType::class, [
                'label' => 'Meta description'
            ])
            ->add('metakeywords', TextType::class, [
                'label' => 'Meta keywords'
            ])
            ->add('published', CheckboxType::class, [
                'label' => 'Показывать страницу',
                'attr' => ['class' => ''],
                'required' => false
            ])
            ->add('module', ChoiceType::class, [
                'required' => false,
                'label' => 'Точка входа модуля',
                'choice_loader' => new CallbackChoiceLoader(function () use ($options) {
                    $selectors = [];
                    //dump($options['modules_list']);
                    foreach ($options['modules_list'] as $uin => $rec) {
                        if ((array_key_exists('menuvisible', $rec) and $rec['menuvisible']) and $uin != 'warp_page') {
                            $selectors[$rec['showname']] = $uin;
                        }
                    }
                    //dump($selectors);
                    return $selectors;
                })
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Сохранить',
                'attr' => ['class' => 'btn waves-effect waves-light']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'snakemkua\Warp12Bundle\Entity\Page'
        ));
        $resolver->setRequired('modules_list');
    }

    public function getName()
    {
        return 'snakemkua_warp12bundle_page';
    }
}
