<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 *
 * @ORM\Table(name="games")
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 */
class Game extends AbstractEntityImage {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="abbreviation", type="string", length=10, nullable=false)
     */
    private $abbreviation;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Gamer", mappedBy="game")
     */
    private $gamers;

    function getId() {
        return $this->id;
    }

    function getAbbreviation() {
        return $this->abbreviation;
    }

    function getName() {
        return $this->name;
    }

    function getGamers() {
        return $this->gamers;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setAbbreviation($abbreviation) {
        $this->abbreviation = $abbreviation;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setGamers($gamers) {
        $this->gamers = $gamers;
    }

}
