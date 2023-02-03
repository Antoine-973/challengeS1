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

        // var_dump($likeList);
        // 1 on récupère la liste de tous les utilisateurs ayant un like validé
        // 2 pour chaque user on récupère l'animal liké

        return $likeList;

        // Pour chaque user récupérer l'animal et vérifier que le spa id de l'animal correspond à l'id spa du user connecté
        // Si oui --> on affiche l'utilisateur
        // Si non --> on affiche pas l'utilisateur
    }
}
