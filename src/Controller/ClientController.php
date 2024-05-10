<?php

namespace App\Controller;

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
    #[Route('/client', name: 'app_client')]
    public function addClient(ManagerRegistry $doctrine, Request $request , PdfService $pdf ): Response
    {
       $client = new Client();
        // Get client by id
       /* $client = $doctrine->getRepository(Client::class)->find($id);

        if (!$client) {
            throw $this->createNotFoundException('The client does not exist');
        }*/

        $form = $this->createForm(ClientType::class, $client);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Get the entity manager
            $entityManager = $doctrine->getManager();

            // Persist the client data to the database
            $entityManager->persist($client);
            $entityManager->flush();

            // Add flash message
            $this->addFlash('success', 'Client added successfully!');
            $pdf ->showPdfFile('pdf/index.html.twig');


            return $this->render('client/add-client.html.twig', [
                'form' => $form->createView(),
            ]);
        }
        return $this->render('client/add-client.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}
