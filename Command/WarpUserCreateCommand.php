<?php

namespace snakemkua\Warp12Bundle\Command;

use snakemkua\Warp12Bundle\Entity\Admin;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Core\Encoder\PlaintextPasswordEncoder;

class WarpUserCreateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('warp:user:create')
            ->setDescription('Create admin-user account')
            ->addArgument('realname', InputArgument::REQUIRED, 'User real name')
            ->addArgument('email', InputArgument::REQUIRED, 'User email')
            ->addArgument('password', InputArgument::REQUIRED, 'Password')
            ->addOption('inactive', null, InputOption::VALUE_NONE, 'Create deactivated user')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $admin = new Admin();
        $admin->setName($input->getArgument('realname'));
        $admin->setEmail($input->getArgument('email'));
        $admin->setActive(true);
        $encoder = $this->getContainer()->get('security.encoder_factory')->getEncoder($admin);
        $admin->setPassword($encoder->encodePassword($input->getArgument('password'), $admin->getSalt()));
        $admin->setCreated(new \DateTime());
        $admin->setUpdated(new \DateTime());

        if ($input->getOption('inactive')) {
            $admin->setActive(false);
        }

        $em = $this->getContainer()->get('doctrine')->getManager();
        $em->persist($admin);
        $em->flush();

        //$output->writeln('Command result.');
    }

}
