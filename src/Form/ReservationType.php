<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Facture;
use App\Entity\Reservation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('arrival_date', null, [
                'widget' => 'single_text'
            ])
            ->add('departure_date', null, [
                'widget' => 'single_text'
            ])
            ->add('nb_nights')
            //->add('total_price')
            //->add('status')
            /*->add('client', EntityType::class, [
                'class' => Client::class,
'choice_label' => 'id',
            ])
            ->add('facture', EntityType::class, [
                'class' => Facture::class,
'choice_label' => 'id',
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
