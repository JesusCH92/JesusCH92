<?php

namespace App\Commands;

use App\Models\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class CreateUserCommand extends Command
{
    protected static $defaultName = 'app:create-user';
    protected function configure()
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'The email of the user.')
            ->addArgument('password', InputArgument::OPTIONAL, 'Your password')
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'User Creator',
            '============',
            '',
        ]);
        $user = new User();
        $user->email = $input->getArgument('email');

        if ( $input->getArgument('password') ) {
            $user->password = password_hash($input->getArgument('password'), PASSWORD_DEFAULT);
        } else {
            $user->password = password_hash('admin', PASSWORD_DEFAULT);
        }

        $user->save();
        $output->writeln('Done.');

        return 0;
    }
}
