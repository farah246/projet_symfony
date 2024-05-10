<?php

namespace App\serviceReservation;
use App\Entity\Room;
use App\Entity\Service;

class Helper
{
    public function calculateTotalPrice(int $nbNights, array $rooms, array $services): float
    {
        $totalPrice = 0;

        foreach ($rooms as $room) {
            /** @var Room $room */
            $totalPrice += $room->getPrice() * $nbNights;
        }

        foreach ($services as $service) {
            /** @var Service $service */
            $totalPrice += $service->getPrice();
        }

        return $totalPrice;
    }
}