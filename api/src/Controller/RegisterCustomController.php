<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\EmailService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Repository\UserRepository;

#[AsController]
class RegisterCustomController extends AbstractController {

    private $em ;
    private $emailServices ;
    private$userRepository ;

    public function __construct (EntityManagerInterface $entityManager, EmailService $emailService, UserRepository $userRepository) {
        $this->em = $entityManager ;
        $this->emailServices = $emailService ;
        $this->userRepository = $userRepository ;
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function __invoke(User $user): User
    {

        if($this->userRepository->findOneBy(['email' => $user->getEmail()])) {
            return $user;
        }

        $token = $this->generateToken() ;

        $user->setConfirmAccount($token) ;
        $this->em->persist($user);

        $this->emailServices->sendMail(
            'sales.playz@gmail.com',
            $user->getEmail(),
            'Confirmation de compte',
            '<p>Tu viens de créer un compte sur SPAdoption click sur ce lien pour vérifier tom compte : </p>
                <a href="http://localhost:3000/confirmAccount?token='.$token.'">
                confirmer le compte</a>'
        );
        return $user ;

    }

    private function generateToken() {
        $letters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $token = '' ;
        for ($i = 0 ; $i < 50; $i++) {
            $token .= $letters[rand(0,strlen($letters) -1 )] ;
        }
        return $token ;
    }

}
