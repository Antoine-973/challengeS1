<?php

namespace App\Repository;

use App\Entity\Animal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Animal>
 *
 * @method Animal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Animal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Animal[]    findAll()
 * @method Animal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnimalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Animal::class);
    }

    public function save(Animal $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Animal $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Animal[] Returns an array of Animal objects
     */
    public function findBySexBirthdayBreeds($sex, $birthday, $speciesId, $breedsId): array
    {
        $qb = $this->createQueryBuilder('a');

        if (isset($sex)) {
            $qb->andWhere('a.sex = :sex')
                ->setParameter('sex', $sex);
        }

        if (isset($birthday)) {
            $qb->andWhere('a.birthday >= :birthday')
                ->setParameter('birthday', $birthday);
        }

        if (isset($speciesId)) {
            $qb->andWhere('a.species.id == :speciesId)')
                ->join('a.species', 's')
                ->setParameter('speciesId', $speciesId);
        }

        if (isset($breedsId)) {
            $qb->andWhere('a.breeds.id in (:breedsId)')
                ->join('a.breeds', 'b')
                ->setParameter('breedsId', $breedsId);
        }

        return $qb->getQuery()->getResult();
    }

//    public function findOneBySomeField($value): ?Animal
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
