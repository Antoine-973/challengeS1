<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailService
{

    private $mailer ;
    public function __construct(MailerInterface $mailer) {
        $this->mailer = $mailer ;
    }
    public function sendMail(
        String $from ,
        String $to ,
        String $topic ,
        String $message ,
    ): void
    {

        $email = (new Email())
            ->from($from)
            ->to($to)
            ->subject($topic)
            ->text('test')
            ->html($message) ;

        $this->mailer->send($email);

    }

}
