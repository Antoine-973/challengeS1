<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use App\Repository\LikeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

#[AsController]
class AnimalController extends AbstractController
{

    public function __construct(
        private readonly AnimalRepository $animalRepository,
        private readonly LikeRepository   $likeRepository,
        private TokenStorageInterface $tokenStorage,
    ) {
    }

    public function __invoke(Request $request)
    {
        try {
            $user = $this->tokenStorage->getToken()->getUser();
            $likes = $this->likeRepository->findBy(['user' => $user]);
            $animals = $this->animalRepository->findAll();

            $notLikedAnimals = [];

            foreach ($animals as $animal) {
                $isLiked = false;
                foreach ($likes as $like) {
                    if ($like->getAnimal() === $animal) {
                        $isLiked = true;
                    }
                }
                if (!$isLiked) {
                    $notLikedAnimals[] = $animal;
                }
            }

            return $notLikedAnimals;
        } catch (\Exception $e) {
            var_dump($e) ;
        }

    }

}
