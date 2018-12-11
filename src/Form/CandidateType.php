<?php

namespace App\Form;

use App\Entity\Candidate;
use App\Entity\Level;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CandidateType
 * @package App\Form
 */
class CandidateType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('note')
            ->add('job_title')
            ->add('job_description')
            ->add('in_post', CheckboxType::class, [
                'required' => false
            ])
            ->add('avatar', FileType::class, [
                'required' => false,
                'data_class' => null
            ])
            ->add('level', EntityType::class, [
                'class' => Level::class,
                'choice_label' => 'title'
            ])
            ->add('cv', FileType::class, [
                'required' => false,
                'data_class' => null
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Candidate::class,
        ]);
    }
}
