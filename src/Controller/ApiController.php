<?php

namespace App\Controller;

use App\Entity\Gamer;
use App\Entity\Game;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;

class ApiController extends AbstractController {

    /**
     * @Route("/api/gamers/{game}", defaults={"game"="all"}, name="api_gamers_game")
     * @return JsonReponse
     */
    public function gamers($game) {
        $gamerRepository = $this->getDoctrine()->getRepository(Gamer::class);
        $response = '';
        $cache = $this->getCache('gamers' . $game);
        if (!empty($cache)) {
            $response = new JsonResponse($cache);
        } else {
            if (empty($game) || $game == 'all') {
                // Get All Gamers
                $allGamers = $gamerRepository->getAllGamers();
            } else {
                // Get All Gamers of Game params
                $allGamers = $gamerRepository->getGamers($game);
            }
            $this->setCache('gamers' . $game, $allGamers);
            $response = new JsonResponse($allGamers);
        }
        return $response;
    }

    /**
     * @Route("/api/games", name="api_games")
     * @return JsonReponse
     */
    public function games() {
        $response = '';
        $cache = $this->getCache('games');
        if (!empty($cache)) {
            $response = new JsonResponse($cache);
        } else {
            $gameRepository = $this->getDoctrine()->getRepository(Game::class);
            $allGames = $gameRepository->getAllGames();
            $this->setCache('games', $allGames);
            $response = new JsonResponse($allGames);
        }
        return $response;
    }

    /**
     * Get cache of JsonResponse 
     * @param type $type
     * @return type
     */
    public function getCache($type) {
        $fileSystem = new Filesystem();
        $filePath = sys_get_temp_dir() . '/topgamersapi/cache/' . $type . '.json';
        $cache = '';
        if ($fileSystem->exists($filePath)) {
            $cache = json_decode(file_get_contents($fileSystem->readlink($filePath, true)));
        }
        return $cache;
    }

    /**
     * Set cache of JsonResponse
     * @param type $type
     * @param type $data
     */
    public function setCache($type, $data) {
        $fileSystem = new Filesystem();
        $filePath = sys_get_temp_dir() . '/topgamersapi/cache/' . $type . '.json';
        $fileSystem->dumpFile($filePath, json_encode($data));
    }

}
