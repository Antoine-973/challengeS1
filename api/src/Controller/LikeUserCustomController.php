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
use App\Repository\LikeRepository;
use App\Repository\UserRepository;

#[AsController]
class LikeUserCustomController extends AbstractController
{
  private $em;
  private $emailServices;
  public function __construct(EntityManagerInterface $entityManager, EmailService $emailService, LikeRepository $likeRepository, UserRepository $userRepository)
  {
    $this->em = $entityManager;
    $this->emailServices = $emailService;
    $this->likeRepository = $likeRepository;
    $this->userRepository = $userRepository;
  }

  /**
   * @throws TransportExceptionInterface
   */
  public function __invoke(Request $request): Like
  {

    $data = $request->toArray();
    dd($data);
    $user = $this->$userRepository->findOneBy(['email' => $data->getUserId()->getEmail()]);
    $this->emailServices->sendMail(
        'sales.playz@gmail.com',
        $data->getUserId()->getEmail(),
        'Demande d\'adoption acceptée',
        '<p>Votre demande d\'adoption a été accepté. Prenez rendez-vous pour rencontrer votre futur animal</p>'
    );
    // $like = $this->$likeRepository->findOneBy(['id' => $data['id']]);
    // return $user;
  }
}