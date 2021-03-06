<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class CreateAdminUserCommand
 * @package App\Command
 */
class CreateAdminUserCommand extends Command
{
    protected static $defaultName = 'app:create-admin';

    private $entitymanager;

    private $encoder;

    /**
     * CreateAdminUserCommand constructor.
     * @param EntityManagerInterface $entityManager
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     */
    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->entitymanager = $entityManager;
        $this->encoder = $userPasswordEncoder;
        parent::__construct();
    }

    /**
     * Create arguments command to enter
     */
    protected function configure():void
    {
        $this
            ->setDescription('Creates a new user admin.')
            ->addArgument('userEmail', InputArgument::REQUIRED, 'The user email address')
            ->addArgument('userPassword', InputArgument::REQUIRED, 'The user password');
    }

    /**
     * Set a new Admin user in BDD
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $userAdmin = new User();

        $userAdmin->setEmail($input->getArgument('userEmail'));
        $userAdmin->setPassword($this->encoder->encodePassword($userAdmin, $input->getArgument('userPassword')));
        $userAdmin->setRoles(['ROLE_ADMIN']);

        $this->entitymanager->persist($userAdmin);
        $this->entitymanager->flush();

        $output->writeln('User email: ' . $input->getArgument('userEmail'));
        $output->writeln('user password: ' . $input->getArgument('userPassword'));
    }
}