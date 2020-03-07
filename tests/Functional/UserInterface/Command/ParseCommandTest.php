<?php

declare(strict_types=1);

namespace MFApps\Tests\Functional\UserInterface\Command;

use MFApps\UserInterface\Command\ParseCommand;

final class ParseCommandTest extends CommandTestCase
{
    public function test_command_failed_with_non_existing_tree_file() : void
    {
        $commandTester = $this->executeCommand(
            ParseCommand::NAME,
            [
                'tree_path' => $treePath = \uniqid('tree_path'),
                'list_path' => $listPath = __DIR__ . '/json/list.json',
                'output_path' => $outputPath = \sys_get_temp_dir() . 'output.json',
            ]
        );

        $this->assertSame(1, $commandTester->getStatusCode());
        $this->assertStringContainsString(\sprintf('File "%s" was expected to exist.', $treePath), $commandTester->getDisplay());
    }

    public function test_command_failed_with_non_existing_list_file() : void
    {
        $commandTester = $this->executeCommand(
            ParseCommand::NAME,
            [
                'tree_path' => $treePath = __DIR__ . '/json/tree.json',
                'list_path' => $listPath = \uniqid('list_path'),
                'output_path' => $outputPath = \sys_get_temp_dir() . 'output.json',
            ]
        );

        $this->assertSame(1, $commandTester->getStatusCode());
        $this->assertStringContainsString(\sprintf('File "%s" was expected to exist.', $listPath), $commandTester->getDisplay());
    }

    public function test_file_parsed_and_created() : void
    {
        $commandTester = $this->executeCommand(
            ParseCommand::NAME,
            [
                'tree_path' => $treePath = __DIR__ . '/json/tree.json',
                'list_path' => $listPath = __DIR__ . '/json/list.json',
                'output_path' => $outputPath = \sys_get_temp_dir() . 'output.json',
            ]
        );

        $this->assertSame(0, $commandTester->getStatusCode());
        $this->assertSame(\file_get_contents($outputPath), \file_get_contents(__DIR__ . '/json/output.json'));
    }
}
