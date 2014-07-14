<?php

namespace Mesd\Security\AuthenticationBundle\FormType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
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
            'data_class' => 'Mesd\Security\AuthenticationBundle\Entity\AuthUser'
            ));
    }

    public function getName()
    {
        return 'mesd_security_securitybundle_registertype';
    }
}
