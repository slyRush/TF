<?php

namespace App\Controller\Admin;

use App\Entity\Campaign;
use App\Form\CampaignType;
use App\Manager\CampaignManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FrontController.
 *
 * @Route("/admin")
 */
class LoginController extends AbstractController
{
    /**
     * @Route("/", name="admin_index", methods="GET")
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->render(
            'admin/login.html.twig'
        );
    }
}
