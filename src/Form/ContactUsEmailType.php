<?php

namespace App\Form;

use App\Entity\ContactUsEmail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactUsEmailType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'fullName',
                TextType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'Entrez votre nom complet *',
                        'required' => true,
                    ],
                ]
            )
            ->add(
                'email',
                EmailType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'Entrez votre email *',
                        'required' => true,
                    ],
                ]
            )
            ->add(
                'telNumber',
                TextType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'Entrez votre numéro de téléphone',
                        'required' => false,
                    ],
                ]
            )
            ->add(
                'message',
                TextareaType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'rows' => '8',
                        'placeholder' => 'Entrez votre message *',
                        'required' => true,
                    ],
                ]
            )
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContactUsEmail::class,
        ]);
    }
}
