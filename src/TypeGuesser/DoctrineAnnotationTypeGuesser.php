<?php

namespace App\TypeGuesser;

use App\Form\SpaceDelimitedType;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\ClassMetadata;
use Symfony\Bridge\Doctrine\Form\DoctrineOrmTypeGuesser;
use Symfony\Component\Form\FormTypeGuesserInterface;
use Symfony\Component\Form\Guess\Guess;
use Symfony\Component\Form\Guess\TypeGuess;

class DoctrineAnnotationTypeGuesser extends DoctrineOrmTypeGuesser implements FormTypeGuesserInterface
{
    public function guessType(string $class, string $property): ?TypeGuess
    {
        /** @TODO implements my own getMetadata to prevent extending all DoctrineOrmGuesser */
        $ret = $this->getMetadata($class);
        /** @var $metadata ClassMetadata */
        [$metadata, $name] = $ret;


        if (Types::SIMPLE_ARRAY === $metadata->getTypeOfField($property)) {
            return new TypeGuess(SpaceDelimitedType::class, [], Guess::VERY_HIGH_CONFIDENCE);
        }

        return null;
    }
}