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
use App\Entity\Like;
use App\Repository\LikeRepository;

#[AsController]
class ReviewController extends AbstractController
{
    private $em;
    private $likeRepository;
    public function __construct(EntityManagerInterface $entityManager, LikeRepository $likerepo) {
        $this->em = $entityManager;
        $this->likerepo = $likerepo;
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function __invoke()
    {
        $likeList = $this->likerepo->findBy(['isValidate' => true]);

        return $likeList;
    }
}
