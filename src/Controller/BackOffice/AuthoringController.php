<?php

namespace App\Controller\BackOffice;

use App\Entity\Article;
use App\Form\ArticleType;
use Doctrine\ORM\EntityManagerInterface;
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
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article, [
            'with_comment' => true,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($article);
            if ($form->has('comment')) {
                dump($form->get('comment')->getData());
            }

            $manager->persist($article);
            $manager->flush();
        }

        return $this->renderForm('back_office/authoring/new.html.twig', [
            'create_form' => $form,
        ]);
    }
}
