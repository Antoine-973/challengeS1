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
    public function findBySexBirthdayBreeds($sex, $birthday, $species, $breeds): array
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

        if (isset($species)) {
            $qb->join('a.species', 's')
                ->andWhere('s.id = :species')
                ->setParameter('species', $species);

            if (isset($breeds)) {
                $qb->innerJoin('a.breeds', 'b')
                    ->andWhere('b.id IN (:breeds)')
                    ->setParameter('breeds', $breeds);
                var_dump($qb->getQuery()->getSQL());
            }
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
