<?php

namespace App\Controller;

use App\Service\PdfService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PdfController extends AbstractController
{
    #[Route('/pdf', name: 'app_pdf')]
    public function index(): Response
    {
        return $this->render('pdf/index.html.twig', [
            'controller_name' => 'PdfController',
        ]);
    }
    /**
     * @Route("/generate-pdf", name="generate_pdf")
     */
    public function generatePdf(PdfService $pdfService): Response
    {
        //  HTML content
        $html = $this->render('pdf/index.html.twig', [
            'controller_name' => 'PdfController',
        ]);

        // Generate PDF
        $pdfContent = $pdfService->generatePdf($html);

        // Output PDF to the browser
        return new Response($pdfContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="Facture.pdf"',
        ]);
    }
}
