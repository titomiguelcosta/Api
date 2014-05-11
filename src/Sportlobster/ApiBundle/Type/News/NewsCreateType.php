<?php

namespace Sportlobster\ApiBundle\Type\News;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsCreateType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array('description' => 'The title of the news'))
            ->add('content', 'textarea', array('description' => 'The content of the news'))
            ->add('photo', 'file', array('description' => 'A photo associated with the news'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sportlobster\ApiBundle\Request\News\NewsCreateRequest',
            'csrf_protection' => false,
            'method' => 'POST'
        ));
    }

    public function getName()
    {
        return '';
    }

}
