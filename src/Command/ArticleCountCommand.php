<?php

namespace App\Command;

use App\Repository\ArticleRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ArticleCountCommand extends Command
{
    protected static $defaultName = 'app:article:count';
    protected static $defaultDescription = 'Display number of articles in database storage.';

    /** @var ArticleRepository */
    private $repository;

    public function __construct(ArticleRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption(
                'published-at',
                'p',
                InputOption::VALUE_OPTIONAL,
                'Count article published at this date, default is today',
                false
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $publishedAtOption = $input->getOption('published-at');

        if (false === $publishedAtOption) {
            $count = $this->repository->count([]);
            $io->success(sprintf('You have %d article(s) in database.', $count));

            return Command::SUCCESS;
        }

        if (is_null($publishedAtOption)) {
            $publishedAtOption = 'today';
        }

        try {
            $publishedAt = new \DateTimeImmutable($publishedAtOption);
        } catch (\Throwable $e) {
            $io->error('L\'option published-at ne contient pas un format de date valide : '.$publishedAtOption);
            return Command::INVALID;
        }

        $count = $this->repository->countPublishedAt($publishedAt);
        $io->success(sprintf('You have %d article(s) in database published at %s.', $count, $publishedAt->format('Y-m-d')));

        return Command::SUCCESS;
    }
}
