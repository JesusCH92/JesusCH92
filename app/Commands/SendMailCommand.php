<?php

namespace App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;
use Zend\Diactoros\ServerRequest;

use App\Models\Message;


class SendMailCommand extends Command
{
    protected static $defaultName = 'app:send-mail';
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $pendingMessage = Message::where('send', false)->first();
        
        if ( $pendingMessage ) {

            $transport = (new Swift_SmtpTransport(getenv('SMTP_HOST'), getenv('SMTP_PORT')))
                ->setUsername(getenv('SMTP_USER'))
                ->setPassword(getenv('SMTP_PASSWORD'));

            // Create the Mailer using your created Transport
            $mailer = new Swift_Mailer($transport);

            // Create a message
            $message = (new Swift_Message('Wonderful Subject'))
                ->setFrom(['contact@mail.com' => 'Contact Form'])
                ->setTo(['jcocaharo@hotmail.com' => 'A name'])
                ->setBody('Hi, you have a new message. Name: ' . $pendingMessage->name 
                    . ' Email: ' . $pendingMessage->email . ' Message: ' . $pendingMessage->message);

            // Send the message
            $result = $mailer->send($message);

            $pendingMessage->send = true;
            $pendingMessage->save();
        }



        return 0;
    }
}