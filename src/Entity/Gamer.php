<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gamer
 *
 * @ORM\Table(name="gamers")
 * @ORM\Entity(repositoryClass="App\Repository\GamerRepository")
 */
class Gamer extends AbstractEntityImage {

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
     * @ORM\Column(name="account", type="string", length=100, nullable=false)
     */
    private $account;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="bio", type="text", nullable=false)
     */
    private $bio;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=4, nullable=false)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="server", type="string", length=10, nullable=false)
     */
    private $server;

    /**
     * @var string
     *
     * @ORM\Column(name="twitch", type="string", length=255, nullable=true)
     */
    private $twitch;

    /**
     * @var string
     *
     * @ORM\Column(name="youtube", type="string", length=255, nullable=true)
     */
    private $youtube;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", nullable=false)
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity="Game", inversedBy="gamers",cascade={"persist"})
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id")
     */
    private $game;

    function getId() {
        return $this->id;
    }

    function getAccount() {
        return $this->account;
    }

    function getName() {
        return $this->name;
    }

    function getBio() {
        return $this->bio;
    }

    function getCountry() {
        return $this->country;
    }

    function getServer() {
        return $this->server;
    }

    function getTwitch() {
        return $this->twitch;
    }

    function getYoutube() {
        return $this->youtube;
    }

    function getGame() {
        return $this->game;
    }
    
    function getPosition() {
        return $this->position;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setAccount($account) {
        $this->account = $account;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setBio($bio) {
        $this->bio = $bio;
    }

    function setCountry($country) {
        $this->country = $country;
    }

    function setServer($server) {
        $this->server = $server;
    }

    function setTwitch($twitch) {
        $this->twitch = $twitch;
    }

    function setYoutube($youtube) {
        $this->youtube = $youtube;
    }

    function setGame($game) {
        $this->game = $game;
    }
    
    function setPosition($position) {
        $this->position = $position;
    }
    
    /**
     * Get External Flag Url
     * @param type $size 16|24|32|48|64 Default 32
     * @return string
     */
    function getFlagUrl($size = 32) {
        $country = $this->getCountry();
        $urlFlag = '';
        if(!empty($country)) {
            $urlFlag = 'https://www.countryflags.io/' . strtolower($country). '/flat/' . $size . '.png';
        }
        return $urlFlag;
    }

    /**
     * To Array Entity
     * @return type
     */
    function toArray() {
        $gamerArray = [
            'id' => $this->getId(),
            'account' => $this->getAccount(),
            'name' => $this->getName(),
            'bio' => $this->getBio(),
            'country' => $this->getCountry(),
            'flag' => $this->getFlagUrl(),
            'server' => $this->getServer(),
            'position' => $this->getPosition(),
            'twitch' => $this->getTwitch(),
            'youtube' => $this->getYoutube()
        ];
        return $gamerArray;
    }

}
