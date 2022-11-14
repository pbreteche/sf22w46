<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('body')
            ->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
                $article = $event->getData();
                $form = $event->getForm();

                if ($article instanceof Article && !$article->getId()) {
                    $form
                        ->add('publishedAt', DateType::class, [
                            'widget' => 'single_text',
                            'input' => 'datetime_immutable',
                            'attr' => [
                                'class' => 'publication',
                            ],
                            'priority' => 10,
                            'required' => false,
                        ])
                    ;
                }
            })
        ;

        if ($options['with_comment']) {
            $builder->add('comment', CommentType::class, [
                'mapped' => false,
                'multiline' => true,
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
            'with_comment' => false,
        ]);

        $resolver
            ->setAllowedTypes('with_comment', 'bool')
        ;
    }
}
