<?php

namespace App\Controller;

use App\Entity\Campaign;
use App\Form\CampaignType;
use App\Manager\CampaignManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FrontController.
 */
class FrontController extends AbstractController
{
    /**
     * @Route("/", name="front_index", methods="GET")
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->render(
            'front/index.html.twig'
        );
    }
}
