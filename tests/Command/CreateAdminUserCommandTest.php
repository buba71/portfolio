<?php

namespace App\Tests\Api\Command;

use App\Command\CreateAdminUserCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class CreateAdminUserCommandTest extends kernelTestCase
{
    public function testExecute()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('app:create-admin');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command'       => $command->getName(),
            'userEmail'     => 'davdelima71@gmail.com',
            'userPassword'  => '123456'
        ]);

        $output = $commandTester->getDisplay();

        static::assertContains('User email: davdelima71@gmail.com', $output);
        static::assertContains('user password: 123456', $output);
    }
}