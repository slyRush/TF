<?php

namespace App\Controller;

use App\Entity\ContactUsEmail;
use App\Form\ContactUsEmail1Type;
use App\Form\ContactUsEmailType;
use App\Repository\ContactUsEmailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contact/us/email")
 */
class ContactUsEmailController extends AbstractController
{
    /**
     * @Route("/", name="contact_us_email_index", methods="GET")
     *
     * @param ContactUsEmailRepository $contactUsEmailRepository
     *
     * @return Response
     */
    public function index(ContactUsEmailRepository $contactUsEmailRepository): Response
    {
        return $this->render(
            'contact_us_email/index.html.twig',
            ['contact_us_emails' => $contactUsEmailRepository->findAll()]
        );
    }

    /**
     * @Route("/new", name="contact_us_email_new", methods="GET|POST")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function new(Request $request): Response
    {
        $contactUsEmail = new ContactUsEmail();
        $form = $this->createForm(
            ContactUsEmailType::class,
            $contactUsEmail,
            ['action' => $this->generateUrl('contact_us_email_new')]
        );
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($contactUsEmail);
                $em->flush();

                return $this->json([
                    'success' => true,
                    'message' => 'Email bien envoyé',
                    'content' => $this->renderView('contact_us_email/new.html.twig', [
                        'contact_us_email' => $contactUsEmail,
                        'form' => $form->createView(),
                    ]),
                ]);
            }

            return $this->json([
                'success' => true,
                'message' => 'Erreur de validation du formulaire',
                'content' => $this->renderView('contact_us_email/new.html.twig', [
                    'contact_us_email' => $contactUsEmail,
                    'form' => $form->createView(),
                ]),
            ]);
        }

        return $this->render('contact_us_email/new.html.twig', [
            'contact_us_email' => $contactUsEmail,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contact_us_email_show", methods="GET")
     *
     * @param ContactUsEmail $contactUsEmail
     *
     * @return Response
     */
    public function show(ContactUsEmail $contactUsEmail): Response
    {
        return $this->render('contact_us_email/show.html.twig', ['contact_us_email' => $contactUsEmail]);
    }

    /**
     * @Route("/{id}/edit", name="contact_us_email_edit", methods="GET|POST")
     *
     * @param Request        $request
     * @param ContactUsEmail $contactUsEmail
     *
     * @return Response
     */
    public function edit(Request $request, ContactUsEmail $contactUsEmail): Response
    {
        $form = $this->createForm(ContactUsEmail1Type::class, $contactUsEmail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contact_us_email_index', ['id' => $contactUsEmail->getId()]);
        }

        return $this->render('contact_us_email/edit.html.twig', [
            'contact_us_email' => $contactUsEmail,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contact_us_email_delete", methods="DELETE")
     *
     * @param Request        $request
     * @param ContactUsEmail $contactUsEmail
     *
     * @return Response
     */
    public function delete(Request $request, ContactUsEmail $contactUsEmail): Response
    {
        if ($this->isCsrfTokenValid('delete' . $contactUsEmail->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($contactUsEmail);
            $em->flush();
        }

        return $this->redirectToRoute('contact_us_email_index');
    }
}
