<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class RegisterCustomController extends AbstractController
{

    public function __construct() {}

    public function __invoke(User $user): User
    {
        // Envoie le mail zeubi

        return $user ;

    }

}
