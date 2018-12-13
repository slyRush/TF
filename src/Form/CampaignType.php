<?php

namespace App\Form;

use App\Entity\Campaign;
use App\Entity\Customer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CampaignType
 * @package App\Form
 */
class CampaignType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('moneyIn')
            ->add('moneyOut')
            ->add('customer', EntityType::class, [
                'class' => Customer::class,
                'choice_label' => 'companyName'
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Campaign::class,
        ]);
    }
}
