<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     */
    public function index(): Response
    {
        $form = $this->createFormBuilder()
            ->add('title', TextType::class)
            ->add('body', TextareaType::class)
            ->add('publishedAt', DateType::class)
            ->getForm()
        ;

        return $this->render('default/index.html.twig', [
            'message' => 'Bonjour <script>console.log(\'coucou\');</script>',
            'demo_form' => $form->createView(),
        ]);
    }
}
