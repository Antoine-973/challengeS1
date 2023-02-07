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

  public function __construct(EntityManagerInterface $entityManager, EmailService $emailService, LikeRepository $likeRepository) {
    $this->em = $entityManager ;
    $this->emailServices = $emailService;
    $this->likeRepository = $likeRepository;
  }

  /**
   * @throws TransportExceptionInterface
   */
  public function __invoke(Request $request)
  {
    // $data = $request;
    // var_dump($data->get('id'));
    $data = $request;
    var_dump($data);
    // return $request;
    // $user = $this->$userRepository->findOneBy(['email' => "wirev33383@bymercy.com"]);
    // $like = $this->$likeRepository->findOneBy(['id' => $data['id']]);
    $this->emailServices->sendMail(
      'sales.playz@gmail.com',
      'dediyo3367@bymercy.com',
      'Demande d\'adoption acceptée',
      '<p>Votre demande d\'adoption a été accepté. Prenez rendez-vous pour rencontrer votre futur animal</p>'
    );

    return $data;

    // return $data;
    // return $data->getUserId();
    // $like = $this->$likeRepository->findOneBy(['id' => $data['id']]);
    // return $user;
  }
}