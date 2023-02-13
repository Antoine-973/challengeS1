<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserResetPasswordController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface $em,
        private UserRepository $repository,
        private UserPasswordHasherInterface $hasher
    ) {}

    public function __invoke(Request $request) {
        try {
          $id = $request->get('id');
          $user = $this->repository->findOneBy(['id'=>$id]) ;
          if($user) {
              $data = $request->toArray() ;
              $hashedPassword = $this->hasher->hashPassword(
                  $user,
                  $data['plainPassword']
              ) ;
              $user->setPassword($hashedPassword) ;
              $this->em->persist($user);
              $this->em->flush();
              return $user ;
          }



        } catch (\Exception $e) {
            var_dump($e);
        }
    }

}
