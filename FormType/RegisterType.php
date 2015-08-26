<?php

namespace Mesd\Security\AuthenticationBundle\FormType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegisterType extends AbstractType
{
    private $class;

    public function __construct($class)
    {
        $this->class = $class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('email'
            , null
            , array(
                'label_attr' => array(
                    'class' => 'textlabel_left_align_right'
                    )
                )
            )

        ->add('rawPassword'
            , 'repeated'
            , array(
                'type' => 'password',
                'first_options' => array(
                    'label' => 'Password'
                    ),
                'second_options' => array(
                    'label' => 'Confirmation'
                    ),
                'options' => array(
                    'label_attr' => array(
                        'class' => 'textlabel_left_align_right'
                        )
                    )
                )
            )

        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class
            ));
    }

    public function getName()
    {
        return 'mesd_security_securitybundle_registertype';
    }
}
