<?php

namespace App\Controller;

use App\Constant\DocumentType;
use App\Entity\Customer;
use App\Form\CustomerType;
use App\Manager\CustomerManager;
use App\Repository\CustomerRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CustomerController
 * @package App\Controller
 *
 * @Route("/customer")
 */
class CustomerController extends AbstractController
{
    /**
     * @Route("/", name="customer_index", methods="GET")
     * @param CustomerManager $customerManager
     * @return Response
     */
    public function index(CustomerManager $customerManager): Response
    {
        return $this->render(
            'customer/index.html.twig',
            ['customers' => $customerManager->getRepository()->findAll()]
        );
    }

    /**
     * @Route("/new", name="customer_new", methods="GET|POST")
     * @param Request $request
     * @param FileUploader $fileUploader
     * @param CustomerManager $customerManager
     * @return Response
     */
    public function new(
        Request $request,
        FileUploader $fileUploader,
        CustomerManager $customerManager
    ): Response {
        $customer = new Customer();
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile|null $logoFile */
            $logoFile = $form['company_logo']->getData();
            if ($logoFile instanceof UploadedFile) {
                $logoFileName = $fileUploader->upload(
                    $logoFile,
                    DocumentType::CUSTOMER_LOGO_PREFIX,
                    DocumentType::CUSTOMER_LOGO_FOLDER
                );
                $customer->setCompanyLogo($logoFileName);
            }

            $customerManager->register($customer);

            return $this->redirectToRoute('customer_index');
        }

        return $this->render('customer/new.html.twig', [
            'customer' => $customer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="customer_show", methods="GET")
     * @param Customer $customer
     * @return Response
     */
    public function show(Customer $customer): Response
    {
        return $this->render('customer/show.html.twig', ['customer' => $customer]);
    }

    /**
     * @Route("/{id}/edit", name="customer_edit", methods="GET|POST")
     * @param Request $request
     * @param Customer $customer
     * @return Response
     */
    public function edit(Request $request, Customer $customer): Response
    {
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('customer_index', ['id' => $customer->getId()]);
        }

        return $this->render('customer/edit.html.twig', [
            'customer' => $customer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="customer_delete", methods="DELETE")
     * @param Request $request
     * @param Customer $customer
     * @return Response
     */
    public function delete(Request $request, Customer $customer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$customer->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($customer);
            $em->flush();
        }

        return $this->redirectToRoute('customer_index');
    }
}
