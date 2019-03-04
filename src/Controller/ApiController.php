<?php

namespace App\Controller;

use App\Entity\Gamer;
use App\Entity\Game;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController {

    /**
     * @Route("/api/gamers/{game}", defaults={"game"="all"}, name="api_gamers_game")
     * @return JsonReponse
     */
    public function gamers($game) {
        $gamerRepository = $this->getDoctrine()->getRepository(Gamer::class);
        if (empty($game) || $game == 'all') {
            // Get All Gamers
            $allGamers = $gamerRepository->getAllGamers();
        } else {
            // Get All Gamers of Game params
            $allGamers = $gamerRepository->getGamers($game);
        }
        $response = new JsonResponse($allGamers);
        return $response;
    }

    /**
     * @Route("/api/games", name="api_games")
     * @return JsonReponse
     */
    public function games() {
        $gameRepository = $this->getDoctrine()->getRepository(Game::class);
        $allGames = $gameRepository->getAllGames();
        $response = new JsonResponse($allGames);
        return $response;
    }

}
