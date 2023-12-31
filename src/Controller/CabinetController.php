<?php

namespace App\Controller;

use App\Entity\Cabinet;
use App\Form\CabinetType;
use App\Repository\CabinetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cabinet')]
class CabinetController extends AbstractController
{
    #[Route('/', name: 'app_cabinet_index', methods: ['GET'])]
//    public function index(CabinetRepository $cabinetRepository): Response
//    {
    public function index(CabinetRepository $cabinetRepository, Request $request): Response
    {
        $specialities = [
            'Sports Medicine',
            'Weight Loss Cabinet',
            'Muscle Building Cabinet',
            'Endurance Athlete Cabinet',
            'Bodybuilding Cabinet',
            'General Health Cabinet',
        ];

        $selectedSpeciality = $request->query->get('speciality');
        $cabinetsAll = $cabinetRepository->findAll();

        // Initialize $cabinets as an empty array
        $cabinets = [];

        // Check if a speciality is selected, and fetch cabinets accordingly
        if ($selectedSpeciality) {
            foreach ($cabinetsAll as $cabinet) {
                if ($cabinet->getSpecialite() == $selectedSpeciality) {
                    // Append the cabinet to the $cabinets array
                    $cabinets[] = $cabinet;
                }
            }
        } else {
            // If no speciality is selected, fetch all cabinets
            $cabinets = $cabinetsAll;
        }

        return $this->render('cabinet/index.html.twig', [
            'cabinets' => $cabinets,
            'specialities' => $specialities,
            'selectedSpeciality' => $selectedSpeciality,
        ]);
    }


    #[Route('/new', name: 'app_cabinet_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cabinet = new Cabinet();
        $form = $this->createForm(CabinetType::class, $cabinet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cabinet);
            $entityManager->flush();

            return $this->redirectToRoute('app_cabinet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cabinet/new.html.twig', [
            'cabinet' => $cabinet,
            'form' => $form,
        ]);
    }

    #[Route('/show/{id}', name: 'app_cabinet_show', methods: ['GET'])]
    public function show(Cabinet $cabinet): Response
    {
        return $this->render('cabinet/show.html.twig', [
            'cabinet' => $cabinet,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cabinet_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cabinet $cabinet, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CabinetType::class, $cabinet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cabinet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cabinet/edit.html.twig', [
            'cabinet' => $cabinet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cabinet_delete', methods: ['POST'])]
    public function delete(Request $request, Cabinet $cabinet, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cabinet->getId(), $request->request->get('_token'))) {
            $entityManager->remove($cabinet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cabinet_index', [], Response::HTTP_SEE_OTHER);
    }
}
