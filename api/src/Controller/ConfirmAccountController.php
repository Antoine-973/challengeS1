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

    public function __invoke(Request $request)
    {
        try {

            $data = $request->toArray() ;
            $user = $this->userRepository->findOneBy(['confirmAccount' => $data['confirmAccount']]) ;
            if(!is_null($user)) {

                $user->setIsVerified(true);
                $user->setConfirmAccount('');
                $this->entityManager->persist($user);
                return $user ;
            }


        } catch (\Exception $e) {
            var_dump($e) ;
        }

    }

}
