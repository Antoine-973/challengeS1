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
use App\Repository\UserRepository;

#[AsController]
class BanUserController extends AbstractController
{
    private $em;
    private $emailServices ;
    private $userRepository;
    public function __construct(EntityManagerInterface $entityManager, EmailService $emailService, UserRepository $userRepo) {
        $this->em = $entityManager;
        $this->emailServices = $emailService;
        $this->userRepo = $userRepo;
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function __invoke(Request $request)
    {

        $id = $request->get("id");
        
        $user = $this->userRepo->findOneBy(['id' => $id]);

        $user->setIsBan(true);

        $this->em->persist($user);

        $this->emailServices->sendMail(
            'sales.playz@gmail.com',
            $user->getEmail(),
            'Vous avez été banni du site.',
            '<p>Bonjour,</br>
                Vous recevez ce mail pour vous informer que vous avez été banni de notre site.</br>
                En effet, vous avez cumulé trop de mauvais retours de la part des SPA présentes sur notre site.</br>
                Cordialement,</br>
                SPAdoption</p>'
        );

        return $user;
       
    }
}
