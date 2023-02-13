<?php

namespace App\Controller;

use App\Entity\ResetPassword;
use App\Service\EmailService;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Error;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use App\Repository\UserRepository;

#[AsController]
class ResetPasswordController extends AbstractController {

    private $em ;
    private $emailServices ;
    private$userRepository ;

    public function __construct (EntityManagerInterface $entityManager, EmailService $emailService, UserRepository $userRepository) {
        $this->em = $entityManager ;
        $this->emailServices = $emailService ;
        $this->userRepository = $userRepository ;
    }

    public function __invoke(Request $request)
    {
        try {
            $data = $request->toArray() ;
            $email = $data['users']['email'] ;
            $user = $this->userRepository->findOneBy(['email'=>$email]) ;
            if($user) {
                $token = $this->generateToken() ;
                $date = new DateTime() ;
                $date->modify("+1 day") ;
                $reset = new ResetPassword() ;
                $reset->setToken($token) ;
                $reset->setUsers($user) ;
                $reset->setExpireAt($date) ;
                $this->emailServices->sendMail(
                    'sales.playz@gmail.com',
                    $user->getEmail(),
                    'Changement de mot de passe',
                    '<p>Tu viens de demander de changer ton mot de passe </p>
                <a href="http://localhost:3000/reset-password/'.$token.'">click ici</a>'
                );
                $this->em->persist($reset);
                $this->em->flush();
                return $reset ;

            }  else throw new Error('User not found') ;
        } catch (\Exception $e) {
            var_dump($e);
        }
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
