<?php

namespace AppBundle\Services;

use Symfony\Component\HttpFoundation\Request;

class Board
{
    protected $tiles;
    protected $winner;

    public function __construct()
    {

    }

    public function setValue(Request $request)
    {
        for($i = 1; $i <= 3; $i++){
            for($j = 1; $j <= 3; $j++){
                if($request->request->get('cell_' . $i . '_' . $j) != null){
                    $this->tiles[$i][$j] = $request->request->get('cell_' . $i . '_' . $j);
                }
                else{
                    $this->tiles[$i][$j] = '0';
                }
            }
        }
    }

    public function getArrayResult() : array
    {
        return $this->tiles;
    }

    public function moveCpu()
    {
        $iRand = rand(1, 3);
        $jRand = rand(1, 3);
        if ($this->tiles[$iRand][$jRand] == '0') {
            $this->tiles[$iRand][$jRand] = '2';
        }
        else{
            $this->moveCpu();
        }
    }

    public function getStausGameEnd()
    {
        for($i = 1; $i <= 3; $i++){
            for($j = 1; $j <= 3; $j++){
                if($this->tiles[$i][$j] == '0'){
                    return true;
                }
            }
        }

        return false;
    }
}
