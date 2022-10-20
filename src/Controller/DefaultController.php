<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", methods={"GET", "POST"})
     */
    public function index(Request $request): Response
    {
        $form = $this->createFormBuilder()
            ->add('title', TextType::class, [
                'required' => true,
            ])
            ->add('body', TextareaType::class)
            ->add('publishedAt', DateType::class)
            ->getForm()
        ;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            return $this->render('default/post_index.html.twig', [
                'data' => $data,
            ]);
        }

        return $this->render('default/index.html.twig', [
            'message' => 'Bonjour <script>console.log(\'coucou\');</script>',
            'demo_form' => $form->createView(),
        ]);
    }
}
