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
        $board = $this->get('app.board');
        $board->setValue($request);
        $result = $board->getArrayResult();

        var_dump($result);

        return $this->render('default/index.html.twig', [
            'board' => $result,
        ]);
    }
}
