<?php

namespace App\DataFixtures;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ServiceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Sample data for services
        $serviceData = [
            [
                'name' => 'Catering Service',
                'description' => 'Enjoy a complete catering service to enhance your stay. Our talented chefs prepare delicious and diverse dishes, catering to all tastes and dietary needs. Experience exceptional culinary delights without leaving the comfort of your room or our dining areas.',
                'price' => 30.00,
            ],
            [
                'name' => 'Babysitting',
                'description' => 'Our professional babysitting service allows parents to relax and enjoy their free time knowing their children are in good hands. Experienced caregivers provide attentive care, ensuring a worry-free stay for parents.',
                'price' => 15.00,
            ],
            [
                'name' => 'Bar & Drink',
                'description' => 'Unwind and indulge in a refined selection of beverages at our stylish bar. From craft cocktails to exquisite wines, our bar offers a friendly and relaxing atmosphere for socializing or simply enjoying a moment of relaxation after a busy day.',
                'price' => 20.0,
            ],
            [
                            'name' => 'Laundry',
                            'description' => 'Simplify your stay with our professional laundry service.',
                            'price' => 40.0,
            ],
            [
                                        'name' => 'Hire Driver',
                                        'description' => 'Explore the city and its surroundings conveniently with our private driver service.',
                                        'price' => 50.0,
                        ],
        ];

        foreach ($serviceData as $data) {
            $service = new Service();
            $service->setName($data['name']);
            $service->setDescription($data['description']);
            $service->setPrice($data['price']);

            // Persist the service entity
            $manager->persist($service);
        }

        // Flush all the persisted service entities to the database
        $manager->flush();
    }
}
