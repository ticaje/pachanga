<?php

namespace Pachanga\UsuarioBundle\Form\Frontend;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Registering a common user
 */
class UsuarioRegistroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('email', 'email',  array('label' => 'Correo electrónico', 'attr' => array(
                'placeholder' => 'usuario@servidor'
            )))
            ->add('password', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'Las dos contraseñas deben coincidir',
                'options' => array('label' => 'Contraseña'),
                'required' => false
            ))
            ->add('permite_email', 'checkbox', array('required' => false))
            ->add('ciudad', 'entity', array(
                'class' => 'Pachanga\\CodificadoresBundle\\Entity\\Ciudad',
                'empty_value' => 'Selecciona una ciudad',
                'query_builder' => function(EntityRepository $repositorio) {
                    return $repositorio->createQueryBuilder('c')
                        ->orderBy('c.nombre', 'ASC');
                },
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pachanga\UsuarioBundle\Entity\Usuario',
            'validation_groups' => array('default', 'registro')
        ));
    }

    public function getName()
    {
        return 'frontend_usuario';
    }
}
