<?php

declare(strict_types=1);

namespace MFApps\Command;

use MFApps\Application\Categories\Categories;
use MFApps\Application\CombinedTrees\CombinedTrees;
use MFApps\Application\Json;
use MFApps\Application\Trees\Trees;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class ParseCommand extends Command
{
    public const NAME = 'parse';

    protected static $defaultName = self::NAME;

    protected function configure() : void
    {
        $this
            ->setDescription('Parse json tree in files.')
            ->addArgument('tree_path', InputArgument::OPTIONAL, 'Json source tree file path.')
            ->addArgument('list_path', InputArgument::OPTIONAL, 'Json data file path.')
            ->addArgument('output_path', InputArgument::OPTIONAL, 'Output combined file path.');
    }

    protected function execute(InputInterface $input, OutputInterface $output) : int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Parse json tree in provided files.');
        $treePath = $input->getArgument('tree_path') ?? __DIR__ . '/../../resources/tree.json';
        $listPath = $input->getArgument('list_path') ?? __DIR__ . '/../../resources/list.json';
        $outputPath = $input->getArgument('output_path') ?? __DIR__ . '/../../resources/combined.json';

        try {
            $categories = Categories::fromJson(Json::fromPath($listPath));
            $trees = Trees::fromJson(Json::fromPath($treePath));

            $combinedTrees = CombinedTrees::create($trees, $categories);

            \file_put_contents(
                $outputPath,
                Json::fromArray($combinedTrees->toArray())
            );
        } catch (\Throwable $exception) {
            $io->text(\sprintf('Error: %s', $exception->getMessage()));
            $io->error('Files not parsed.');

            return 1;
        }

        $io->success('Files parsed.');

        return 0;
    }
}
