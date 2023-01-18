<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AnimalFixtures extends Fixture
{
    const USER_ADMIN = 'ADMIN';
    const USER_USER = 'USER';
    const USER_MEMBER_SPA = 'USER_MEMBER_SPA';

    /** @var UserPasswordHasherInterface $userPasswordHasher */
    private UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher){
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {

        $admin = (new User())
            ->setEmail('admin@spa.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setIsVerified(true)
            ->setLastname('SPA')
            ->setFirstname('Admin')
            ->setDescription('Hi ! I am the CEO of spa')
        ;
        $admin->setPassword($this->userPasswordHasher->hashPassword($admin, 'test'));
        $manager->persist($admin);
        $this->setReference(self::USER_ADMIN, $admin);

        $user = (new User())
            ->setEmail('user@user.com')
            ->setRoles(['ROLE_USER'])
            ->setIsVerified(true)
            ->setLastname('Doe')
            ->setFirstname('John')
            ->setDescription('Hi ! I am a user of spadoption !')
        ;
        $user->setPassword($this->userPasswordHasher->hashPassword($user, 'test'));
        $manager->persist($user);
        $this->setReference(self::USER_USER, $user);

        $spaMember = (new User())
            ->setEmail('user@spa.com')
            ->setRoles(['ROLE_USER'])
            ->setIsVerified(true)
            ->setLastname('Doe')
            ->setFirstname('John')
            ->setDescription('Hi ! I am a member of the spa !')
        ;
        $spaMember->setPassword($this->userPasswordHasher->hashPassword($spaMember, 'test'));
        $manager->persist($spaMember);
        $this->setReference(self::USER_MEMBER_SPA, $spaMember);

        $manager->flush();
    }
}
