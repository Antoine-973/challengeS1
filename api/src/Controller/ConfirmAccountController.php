<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class ConfirmAccountController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserRepository $userRepository
    ) {}
    #[NoReturn] public function __invoke(Request $request): ?User
    {
        $data = json_decode($request->getContent(), JSON_PRETTY_PRINT) ;
        if(!is_null($data['confirmAccount'])) {

            $user = $this->userRepository->findOneBy(['confirmAccount' => $data['confirmAccount']]);

            if ($user) {
                $user->setConfirmAccount('');
                $user->setIsVerified(true);
                $this->entityManager->persist($user);
            }

            return $user ;
        }

        return null ;
    }

}
