<?php

namespace App\Controller\Admin;

use App\Form\ActionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActionController extends AbstractController
{
    #[Route(name: 'admin_actions')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(ActionType::class, []);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'All repositories successfully checked.');

            # @TODO Install the svn extension to get file list of repository.
            # @WAIT https://github.com/oerdnj/deb.sury.org/issues/1743
            # @WAIT https://github.com/drud/ddev/issues/3726
        }

        return $this->renderForm('action/index.html.twig', [
            'form' => $form,
        ]);
    }
}
