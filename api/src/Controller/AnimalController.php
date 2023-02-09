<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use App\Repository\BreedRepository;
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
        private readonly BreedRepository $breedRepository,
        private readonly LikeRepository   $likeRepository,
        private TokenStorageInterface $tokenStorage,
    ) {
    }

    public function __invoke(Request $request)
    {
        try {
            $params = $request->query->all();
            // params contains species, age, sexe, breed
            // find animals depending on params

            if (isset($params['breeds']) && isset($params['age']) && isset($params['sex'])) {
                $breedsId = $params['breeds'];
                $age = $params['age'];
                $sex = $params['sex'];
                $animals = $this->animalRepository->findBySexAgeBreeds([$sex, $age, $breedsId]);
            }
            else {
                $animals = $this->animalRepository->findAll();
            }
            $user = $this->tokenStorage->getToken()->getUser();
            $likes = $this->likeRepository->findBy(['user' => $user]);

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
