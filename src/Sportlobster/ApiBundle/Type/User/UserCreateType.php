<?php

namespace Sportlobster\ApiBundle\Type\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserCreateType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sportlobster\ApiBundle\Request\User\UserCreateRequest',
            'csrf_protection' => false,
            'method' => 'POST'
        ));
    }

    public function getName()
    {
        return '';
    }

}
