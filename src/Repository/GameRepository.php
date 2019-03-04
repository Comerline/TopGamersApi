<?php

namespace App\Repository;

use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class GameRepository extends ServiceEntityRepository {

    /**
     * 
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, Game::class);
    }

    /**
     * Get All Games
     * @return array
     */
    public function getAllGames() {
        $allGamers = [];
        $games = $this->findAll();
        if (!empty($games)) {
            foreach ($games as $game) {
                $allGamers[$game->getAbbreviation()]['id'] = $game->getId();
                $allGamers[$game->getAbbreviation()]['abbreviation'] = $game->getAbbreviation();
                $allGamers[$game->getAbbreviation()]['name'] = $game->getName();
                foreach ($game->getGamers() as $gamer) {
                    $allGamers[$game->getAbbreviation()]['gamers'][] = $gamer->toArray();
                }
            }
            $allGamers = ['games' => $allGamers];
        }
        return $allGamers;
    }

}
