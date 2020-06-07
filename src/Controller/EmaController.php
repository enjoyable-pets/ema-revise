<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
