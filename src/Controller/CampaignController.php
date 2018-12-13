<?php

namespace App\Controller;

use App\Entity\Campaign;
use App\Form\CampaignType;
use App\Manager\CampaignManager;
use App\Repository\CampaignRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/campaign")
 */
class CampaignController extends AbstractController
{
    /**
     * @Route("/", name="campaign_index", methods="GET")
     * @param CampaignManager $campaignManager
     * @return Response
     */
    public function index(CampaignManager $campaignManager): Response
    {
        return $this->render(
            'campaign/index.html.twig',
            ['campaigns' => $campaignManager->getRepository()->findAll()]
        );
    }

    /**
     * @Route("/new", name="campaign_new", methods="GET|POST")
     * @param Request $request
     * @param CampaignManager $campaignManager
     * @return Response
     */
    public function new(Request $request, CampaignManager $campaignManager): Response
    {
        $campaign = new Campaign();
        $form = $this->createForm(CampaignType::class, $campaign);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $campaignManager->register($campaign);

            return $this->redirectToRoute('campaign_index');
        }

        return $this->render('campaign/new.html.twig', [
            'campaign' => $campaign,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="campaign_show", methods="GET")
     * @param Campaign $campaign
     * @return Response
     */
    public function show(Campaign $campaign): Response
    {
        return $this->render('campaign/show.html.twig', ['campaign' => $campaign]);
    }

    /**
     * @Route("/{id}/edit", name="campaign_edit", methods="GET|POST")
     * @param Request $request
     * @param Campaign $campaign
     * @param CampaignManager $campaignManager
     * @return Response
     */
    public function edit(Request $request, Campaign $campaign, CampaignManager $campaignManager): Response
    {
        $form = $this->createForm(CampaignType::class, $campaign);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $campaignManager->getDoctrine()->flush();

            return $this->redirectToRoute('campaign_index', ['id' => $campaign->getId()]);
        }

        return $this->render('campaign/edit.html.twig', [
            'campaign' => $campaign,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="campaign_delete", methods="DELETE")
     * @param Request $request
     * @param Campaign $campaign
     * @return Response
     */
    public function delete(Request $request, Campaign $campaign): Response
    {
        if ($this->isCsrfTokenValid('delete'.$campaign->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($campaign);
            $em->flush();
        }

        return $this->redirectToRoute('campaign_index');
    }
}
