<?php

namespace App\Controller;

use App\Entity\Client;
use App\Service\PdfService;
use App\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PdfController extends AbstractController
{
    #[Route('/generate-pdf/{id}/{id2}', name: 'generate-pdf')]
    public function generatePdf(PdfService $pdfService, Client $client, Reservation $reservation): Response
    {
        // HTML content
        $html = $this->renderView('pdf/client_pdf_template.html.twig', [
            'client' => $client,
            'reservation' => $reservation
        ]);

        // Generate PDF
        $pdfContent = $pdfService->generatePdf($html);

        // Output PDF to the browser
        return new Response($pdfContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="Client_Information.pdf"',
        ]);
    }
}
