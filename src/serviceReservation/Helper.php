<?php

namespace App\serviceReservation;

class Helper
{
        Public function priceCalculator($price, $nb_nights,)
        {
            return $price * $nb_nights;
        }
}