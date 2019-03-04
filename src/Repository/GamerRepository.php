<?php

namespace App\Repository;

use App\Entity\Gamer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class GamerRepository extends ServiceEntityRepository {

    /**
     * 
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, Gamer::class);
    }

    /**
     * Get All Gamers group by Game and order by Position
     * @return type
     */
    public function getAllGamers() {
        $queryGamers = $this->createQueryBuilder('g')
                ->addOrderBy('g.game', 'ASC')
                ->addOrderBy('g.position', 'ASC')
                ->getQuery();
        $allGamers = [];
        $gamers = $queryGamers->execute();
        if (!empty($gamers)) {
            foreach ($gamers as $gamer) {
                $allGamers[$gamer->getGame()->getAbbreviation()]['id'] = $gamer->getGame()->getId();
                $allGamers[$gamer->getGame()->getAbbreviation()]['abbreviation'] = $gamer->getGame()->getAbbreviation();
                $allGamers[$gamer->getGame()->getAbbreviation()]['name'] = $gamer->getGame()->getName();
                $allGamers[$gamer->getGame()->getAbbreviation()]['gamers'][] = $gamer->toArray();
            }
            $allGamers = ['games' => $allGamers];
        }
        return $allGamers;
    }

    /**
     * Get Gamers of Game order by Position
     * @param type $game
     * @return type
     */
    public function getGamers($game) {
        $queryGamers = $this->createQueryBuilder('g')
                ->join('g.game', 'ga')
                ->andWhere('ga.abbreviation = :game')
                ->addOrderBy('g.position', 'ASC')
                ->setParameter('game', $game)
                ->getQuery();
        $allGamers = [];
        $gamers = $queryGamers->execute();
        if (!empty($gamers)) {
            foreach ($gamers as $gamer) {
                $allGamers[] = $gamer->toArray();
            }
            $allGamers = ['gamers' => $allGamers];
        }
        return $allGamers;
    }

}
