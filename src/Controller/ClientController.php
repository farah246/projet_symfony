<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Client;
use App\Form\ClientType;
use App\Service\PdfService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    #[Route('/client/{id}', name: 'app-client/{id}')]
    public function addClient(Request $request, PdfService $pdf, Reservation $reservation): Response
    {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Get the entity manager
            $entityManager = $this->doctrine->getManager();

            // Persist the client data to the database
            $entityManager->persist($client);
            $entityManager->flush();

            // Redirect to PDF generation with client ID
            return $this->redirectToRoute('generate-pdf', ['id' => $client->getId(), 'id2' => $reservation->getId()]);

        }

        return $this->render('client/add-client.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
