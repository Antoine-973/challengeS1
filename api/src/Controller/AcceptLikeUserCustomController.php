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
class AcceptLikeUserCustomController extends AbstractController
{

  private $em ;
  private $emailServices ;
  private $likeRepository ;

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
    $data = $request->get('id');
    $like = $this->likeRepository->findOneBy(['id' => $data]);
    $like->setIsPending(false);
    $like->setIsValidate(true);
    $this->emailServices->sendMail(
      'sales.playz@gmail.com',
      $like->getUserId()->getEmail(),
      'Demande d\'adoption acceptée',
      '<p>Bonjour '.$like->getUserId()->getFirstName().' '.$like->getUserId()->getLastName().',<br/><br/>
      C\'est avec joie que nous vous annonçons que votre demande d\'adoption a été accepté. Prenez rendez-vous pour rencontrer votre futur animal :)</p><br/><br/>
      <p>L\'équipe SPAdoption</p>'
    );

    return $like;
  }
}