<?php

namespace App\Controller\BackOffice;

use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/article")
 */
class AuthoringController extends AbstractController
{
    /**
     * @Route("/new", methods={"GET", "POST"})
     */
    public function new(Request $request): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);

        return $this->renderForm('back_office/authoring/new.html.twig', [
            'create_form' => $form,
        ]);
    }
}
