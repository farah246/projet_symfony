<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use App\serviceReservation\Helper;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(ManagerRegistry $doctrine, Request $request, Helper $reservationHelper): Response
    {
        $entityManager = $doctrine->getManager();
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $totalPrice = $reservationHelper->calculateTotalPrice(
                $reservation->getNbNights(),
                $reservation->getRooms()->toArray(),
                $reservation->getServices()->toArray(),

            );

            $reservation->setTotalPrice($totalPrice);

            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('app-client/{id}', ['id' => $reservation->getId()]);

        }

        return $this->render('home/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
