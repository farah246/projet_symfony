<?php

namespace App\DataFixtures;

use App\Entity\Room;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RoomFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Sample data for rooms
        $roomData = [
            [
                'number' => 101,
                'type' => 'Single',
                'price' => 80.00,
                'description' => 'Comfortable single room with a view.',
                'picture' => 'assetsHome/imd/room-details.jpg', // Change to the filename of your picture
                'status' => true,
            ],

            [
                'number' => 781,
                'type' => 'Single',
                'price' => 180.00,
                'description' => 'Comfortable single room with a view.',
                'picture' => 'assetsHome/imd/room-5.jpg', // Change to the filename of your picture
                'status' => true,
            ],

            [
                'number' => 201,
                'type' => 'Double',
                'price' => 120.00,
                'description' => 'Spacious double room with a balcony.',
                'picture' => 'assetsHome/imd/room-b4.jpg', // Change to the filename of your picture
                'status' => true,
            ],

            [
                'number' => 52,
                'type' => 'Double',
                'price' => 220.00,
                'description' => 'Spacious double room with a balcony.',
                'picture' => 'assetsHome/imd/room-6.jpg', // Change to the filename of your picture
                'status' => true,
            ],

            [
                'number' => 152,
                'type' => 'single',
                'price' => 220.00,
                'description' => 'Spacious double room with a balcony.',
                'picture' => 'assetsHome/imd/room-b4.jpg', // Change to the filename of your picture
                'status' => true,
            ],

        ];

        // Loop through the room data and create Room entities
        foreach ($roomData as $data) {
            $room = new Room();
            $room->setNumber($data['number']);
            $room->setType($data['type']);
            $room->setPrice($data['price']);
            $room->setDescription($data['description']);
            $room->setPicture($data['picture']); // Set the picture filename
            $room->setStatus($data['status']);

            // Persist the room entity
            $manager->persist($room);
        }

        // Flush all the persisted room entities to the database
        $manager->flush();
    }
}
