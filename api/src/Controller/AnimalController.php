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
            $breedsId = $request->query->get('breeds');
            $speciesId = $request->query->get('species');
            $age = $request->query->get('age');
            $sex = $request->query->get('sex');

            // transform age to a date to compare to animal's birthdate
            if (isset($breedsId) || isset($age) || isset($sex) || isset($speciesId)) {
                if (isset($age)) {
                    $now = new \DateTime();
                    $birthday = $now->sub(new \DateInterval('P' . $age . 'Y'));
                } else {
                    $birthday = null;
                }
                if (isset($breedsId)) {
                    $breedsId = explode(',', $breedsId);
                }
                $animals = $this->animalRepository->findBySexBirthdayBreeds($sex, $birthday, $speciesId, $breedsId);
            } else {
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
