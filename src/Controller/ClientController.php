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
    public function addClient(ManagerRegistry $doctrine, Request $request ,PdfController $pdfController, PdfService $pdf ): Response
    {
        $client = new Client();
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

           /* $html = $this->renderView('pdf/client_pdf_template.html.twig', [
                'client' => $client,
            ]);
            return $pdfService->generatePdf($html);
}

            // Redirect to the client list page
           // return $this->redirectToRoute('app_client');
           //pdfing
            
        #[Route('/pdf', name:'personne.pdf')]
        {

        }*/

        return $this->render('client/add-client.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
}
