<?php

namespace App\Controller;

use App\Constant\DocumentType;
use App\Entity\Candidate;
use App\Form\CandidateType;
use App\Manager\CandidateManager;
use App\Manager\CVManager;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CandidateController.
 *
 * @Route("/candidate")
 */
class CandidateController extends AbstractController
{
    /**
     * @Route("/", name="candidate_index", methods="GET")
     *
     * @param CandidateManager $candidateManager
     *
     * @return Response
     */
    public function index(CandidateManager $candidateManager): Response
    {
        return $this->render(
            'candidate/index.html.twig',
            ['candidates' => $candidateManager->getRepository()->findAll()]
        );
    }

    /**
     * @Route("/new", name="candidate_new", methods="GET|POST")
     *
     * @param Request          $request
     * @param FileUploader     $fileUploader
     * @param CandidateManager $candidateManager
     * @param CVManager        $CVManager
     *
     * @return Response
     *
     * @throws \Exception
     */
    public function new(
        Request $request,
        FileUploader $fileUploader,
        CandidateManager $candidateManager,
        CVManager $CVManager
    ): Response {
        $candidate = new Candidate();
        $form = $this->createForm(CandidateType::class, $candidate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->processUpload($form, $fileUploader, $candidate, $CVManager);
            $candidateManager->register($candidate);

            return $this->redirectToRoute('candidate_index');
        }

        return $this->render('candidate/new.html.twig', [
            'candidate' => $candidate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="candidate_show", methods="GET")
     *
     * @param Candidate $candidate
     *
     * @return Response
     */
    public function show(Candidate $candidate): Response
    {
        return $this->render('candidate/show.html.twig', ['candidate' => $candidate]);
    }

    /**
     * @Route("/{id}/edit", name="candidate_edit", methods="GET|POST")
     *
     * @param Request          $request
     * @param Candidate        $candidate
     * @param CandidateManager $candidateManager
     * @param FileUploader     $fileUploader
     * @param CVManager        $CVManager
     *
     * @return Response
     *
     * @throws \Exception
     */
    public function edit(
        Request $request,
        Candidate $candidate,
        CandidateManager $candidateManager,
        FileUploader $fileUploader,
        CVManager $CVManager
    ): Response {
        $avatar = $candidate->getAvatar();
        $form = $this->createForm(CandidateType::class, $candidate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->processUpload($form, $fileUploader, $candidate, $CVManager, $avatar);
            $candidateManager->getDoctrine()->flush();

            return $this->redirectToRoute('candidate_index', ['id' => $candidate->getId()]);
        }

        return $this->render('candidate/edit.html.twig', [
            'candidate' => $candidate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="candidate_delete", methods="DELETE")
     *
     * @param Request   $request
     * @param Candidate $candidate
     *
     * @return Response
     */
    public function delete(Request $request, Candidate $candidate): Response
    {
        if ($this->isCsrfTokenValid('delete' . $candidate->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($candidate);
            $em->flush();
        }

        return $this->redirectToRoute('candidate_index');
    }

    /**
     * @param FormInterface $form
     * @param FileUploader  $fileUploader
     * @param Candidate     $candidate
     * @param CVManager     $CVManager
     * @param string|null   $avatar
     *
     * @throws \Exception
     */
    private function processUpload(
        FormInterface $form,
        FileUploader $fileUploader,
        Candidate $candidate,
        CVManager $CVManager,
        string $avatar = null
    ): void {
        /** @var UploadedFile|null $avatarFile */
        $avatarFile = $form['avatar']->getData();
        if ($avatarFile instanceof UploadedFile) {
            $avatarFileName = $fileUploader->upload(
                $avatarFile,
                DocumentType::AVATAR_PREFIX,
                DocumentType::AVATAR_FOLDER
            );
            $candidate->setAvatar($avatarFileName);
        } else {
            $candidate->setAvatar($avatar);
        }

        /** @var UploadedFile|null $cvFile */
        $cvFile = $form['cv']->getData();
        if ($cvFile instanceof UploadedFile) {
            $cvFileName = $fileUploader->upload(
                $cvFile,
                DocumentType::CV_PREFIX,
                DocumentType::CV_FOLDER
            );
            $cv = $CVManager->create($cvFileName);
            $candidate->addCv($cv);
        }
    }
}
