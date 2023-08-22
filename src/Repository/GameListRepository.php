<?php

namespace App\Repository;

use App\Entity\GameList;
use App\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GameList>
 *
 * @method GameList|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameList|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameList[]    findAll()
 * @method GameList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameListRepository extends ServiceEntityRepository
{
    
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameList::class);
    }

    public function save(GameList $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(GameList $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    
    public function getPlayerGameListOfType(Users $player, string $type): array
    {
        $qb = $this->createQueryBuilder('gl')
            ->innerJoin('gl.user', 'u')
            ->innerJoin('gl.type', 't')
            ->innerJoin('gl.games', 'g')
            ->setParameter('playerId', $player->getId())
            ->setParameter('type', $type)
            ->andWhere('u.id = :playerId')
            ->andWhere('t.type = :type');
        $query = $qb->getQuery();
        return $query->getResult();
    }
//    /**
//     * @return GameList[] Returns an array of GameList objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GameList
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
