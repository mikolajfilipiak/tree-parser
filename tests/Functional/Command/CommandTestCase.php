<?php

declare(strict_types=1);

namespace MFApps\Tests\Functional\Command;

use MFApps\Command\ParseCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

abstract class CommandTestCase extends TestCase
{
    /**
     * @param string $commandName
     * @param array<mixed> $input
     * @return CommandTester
     */
    protected function executeCommand(string $commandName, array $input = []) : CommandTester
    {
        $application = new Application();
        $application->add(new ParseCommand());
        $command = $application->find($commandName);

        $commandTester = new CommandTester($command);
        $commandTester->execute($input);

        return $commandTester;
    }
}
