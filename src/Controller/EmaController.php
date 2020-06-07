<?php

namespace App\Controller;

use App\Entity\Source;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmaController extends AbstractController
{
    /**
     * @Route("/ema", name="ema")
     */
    public function index()
    {
        return $this->render('html-templates/textbook/v_04-03_b6b9e7b0-7529-11ea-9681-005056a42f32.html');
    }

    /**
     * @Route("/preview/{id}", name="source_preview", methods={"GET"})
     */
    public function preview(Source $source): Response
    {
        return $this->render(sprintf('generated/%s.html.twig', $source->getId()));
    }
}
