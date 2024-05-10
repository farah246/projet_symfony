<?php

// src/Form/ReservationType.php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Facture;
use App\Entity\Reservation;
use App\Entity\Service;
use App\Entity\Room;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
            ->add('nb_nights', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Add number of nights'
                ]
            ])
            ->add('rooms', EntityType::class, [
                'class' => Room::class,
                'choice_label' => 'type',
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('services', EntityType::class, [
                'class' => Service::class,
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('editer', SubmitType::class, [
                'label' => 'Réserver',
                'attr' => ['class' => 'btn btn-primary'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
