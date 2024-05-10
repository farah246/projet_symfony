<?php

namespace App\Controller\Admin;

use App\Entity\Admin;
use App\Form\Admin\AdminType;
use App\Repository\AdminRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/admin/admins')]
class AdminsController extends AbstractController
{
    #[Route('/', name: 'app_admins_index', methods: ['GET'])]
    public function index(AdminRepository $adminRepository): Response
    {
        return $this->render('admin/admins/index.html.twig', [
            'admins' => $adminRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admins_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $admin = new Admin();
        $form = $this->createForm(AdminType::class, $admin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $admin->setPassword($form->get('password')->getData());

            $entityManager->persist($admin);
            $entityManager->flush();

            return $this->redirectToRoute('app_admins_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/admins/new.html.twig', [
            'admin' => $admin,
            'form' => $form->createView(),
        ]);
    }
    #[Route('/{id}', name: 'app_admins_show', methods: ['GET'])]
    public function show(Admin $admin): Response
    {
        return $this->render('admin/admins/show.html.twig', [
            'admin' => $admin,
        ]);
    }


    #[Route('/{id}/edit', name: 'app_admins_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Admin $admin, EntityManagerInterface $entityManager, UserPasswordHasherInterface $adminPasswordHasher): Response
    {
        $form = $this->createForm(AdminType::class, $admin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $admin->setPassword($form->get('password')->getData());

            $entityManager->flush();

            return $this->redirectToRoute('app_admins_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/admins/edit.html.twig', [
            'admin' => $admin,
            'form' => $form->createView(),
        ]);
    }
    #[Route('/{id}', name: 'app_admins_delete', methods: ['POST'])]
    public function delete(Request $request, Admin $admin, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$admin->getId(), $request->request->get('_token'))) {
            $entityManager->remove($admin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admins_index', [], Response::HTTP_SEE_OTHER);
    }
}
