<?php

namespace AppBundle\Services;

use Symfony\Component\HttpFoundation\Request;

class Board
{
    protected $tiles;
    protected $winner;

    public function __construct()
    {
        $this->winner = '';
    }

    public function setValue(Request $request)
    {
        for($i = 1; $i <= 3; $i++){
            for($j = 1; $j <= 3; $j++){
                $this->setCell($i, $j, $request->request->get('cell_' . $i . '_' . $j));
            }
        }
    }

    public function setCell(int $row, int $column, $value)
    {
        if(null != $value){
            $this->tiles[$row][$column] = $value;
        }
        else{
            $this->tiles[$row][$column] = '0';
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

    private function checkHorizontal() :bool
    {
        for($i = 1; $i <= 3; $i++){
            $check = true;
            $lastValue = '';
            for($j = 1; $j <= 3; $j++){
                if ($lastValue == '') {
                    $lastValue = $this->tiles[$i][$j];
                }
                else{
                    if($this->tiles[$i][$j] != $lastValue) {
                        $check = false;
                    }
                }
            }

            if (($check == true) && ($lastValue != '0')){
                $this->winner = $lastValue;
                return true;
            }
        }

        return false;
    }

    private function checkVertical() :bool
    {
        for($j = 1; $j <= 3; $j++){
            $check = true;
            $lastValue = '';
            for($i = 1; $i <= 3; $i++){
                if ($lastValue == '') {
                    $lastValue = $this->tiles[$i][$j];
                }
                else{
                    if($this->tiles[$i][$j] != $lastValue) {
                        $check = false;
                    }
                }
            }

            if (($check == true) && ($lastValue != '0')){
                $this->winner = $lastValue;
                return true;
            }
        }

        return false;
    }

    public function isGameFinished() : bool
    {
        if ($this->checkHorizontal()) {
            return true;
        }

        if ($this->checkVertical()) {
            return true;
        }

        return false;
    }

    public function getWinner() : string
    {
        return  $this->winner;
    }
}
