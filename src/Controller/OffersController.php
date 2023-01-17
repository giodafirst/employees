<?php

namespace App\Controller;
//phpinfo();
use App\Form\OfferType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TitleRepository;

class OffersController extends AbstractController
{
    #[Route('/offers', name: 'app_offers', methods: ['GET'])]
    public function index(TitleRepository $titleRepository): Response
    {
        return $this->render('offers/index.html.twig', [
            'titles' => $titleRepository->findAll(),
        ]);
    }

    /*#[Route('/offers/form', name: 'app_offers_form', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $offers = new OffersController();
        // ...

        $form = $this->createForm(OfferType::class, $offers);

        return $this->render('offers/index.html.twig', [
            'form' => $form,
        ]);
    }*/
    #[Route('/offers/form', name: 'app_offers_form', methods: ['GET', 'POST'])]
    public function form(): Response
    {
        $form = $this->createForm(OfferType::class);
        return $this->render('offers/_form.html.twig', [
            'form' => $form,
        ]);
    }
    
    /*public function new()
    {
        // creates a task object and initializes some data for this example
        $offers = new OffersController();

        $form = $this->createForm(OfferType::class, $offers);

        // ...
    }*/
}
