<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Like;
use App\Service\EmailService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

#[AsController]
class LikeUserCustomController extends AbstractController
{
    private $em;
    private $emailServices;
    public function __construct(EntityManagerInterface $entityManager, EmailService $emailService)
    {
        $this->em = $entityManager;
        $this->emailServices = $emailService;
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function __invoke(Like $like): Like
}