<?php

namespace AppBundle\Services;

use Symfony\Component\HttpFoundation\Request;

class Board
{
    protected $tiles;
    protected $winner;

    public function setValue(Request $request)
    {
        for($i = 1; $i <= 3; $i++){
            for($j = 1; $j <= 3; $j++){
                if(null != $request->request->get('cell_' . $i . '_' . $j)){
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

    public function getIfIsFinishGame() : bool
    {
        //check horizontal
        for($i = 1; $i <= 3; $i++){
            $check = true;
            $lastValue = '';
            for($j = 1; $j <= 3; $j++){
                if ($lastValue == '') {
                    $lastValue = $this->tiles[$i][$j];
                }
                else{
                    if($this->tiles[$i][$j] != $lastValue) {
                        $check =false;
                    }
                }
            }

            if ($check == true) {
                return true;
            }
        }

        return false;
    }
}
