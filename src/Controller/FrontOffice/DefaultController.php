<?php

namespace App\Controller\FrontOffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

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

            return $this->render('front_office/default/post_index.html.twig', [
                'data' => $data,
            ]);
        }

        return $this->render('front_office/default/index.html.twig', [
            'message' => 'Bonjour <script>console.log(\'coucou\');</script>',
            'demo_form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/ux/chart")
     */
    public function chartjs(ChartBuilderInterface $chartBuilder): Response
    {
        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);

        $chart->setData([
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            'backgroundColor' => 'rgb(255, 99, 132)',
            'borderColor' => 'rgb(255, 99, 132)',
            'datasets' => [
                [
                    'label' => 'Cookies eaten 🍪',
                    'data' => [2, 10, 5, 18, 20, 30, 45],
                    'backgroundColor' => 'red',
                    'borderColor' => 'darkred',
                    'cubicInterpolationMode' => 'monotone',
                ],
                [
                    'label' => 'Km walked 🏃‍♀️',
                    'data' => [10, 15, 4, 3, 25, 41, 25],
                    'backgroundColor' => 'blue',
                    'borderColor' => 'darkblue'
                ],
            ],
        ]);

        return $this->render('front_office/default/chartjs.html.twig', [
            'chart' => $chart,
        ]);
    }
}
