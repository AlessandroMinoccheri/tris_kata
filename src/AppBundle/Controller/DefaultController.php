<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Services\Board;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/game", name="game")
     */
    public function gameAction(Request $request)
    {
        if (!$request->request->get('level')) {
            return $this->redirectToRoute('homepage');
        }
        
        $board = $this->get('app.board');
        $board->setValue($request);
        $gameFinished = $board->isGameFinished();

        if (($request->isMethod('POST')) && ($gameFinished != true) && (!$request->request->get('startGame'))) {
            $board->moveCpu();
        }

        $winner = $board->getWinner();
        $result = $board->getArrayResult();

        var_dump($result);

        return $this->render('default/game.html.twig', [
            'board' => $result,
            'gameFinished' => $gameFinished,
            'winner' => $winner,
            'level' => $request->request->get('level'),
        ]);
    }
}
