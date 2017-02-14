<?php

namespace AppBundle\Services;

use Symfony\Component\HttpFoundation\Request;

class Board
{
    protected $matrix;

    public function __construct()
    {

    }

    public function setValue(Request $request)
    {
        for($i = 1; $i <= 3; $i++){
            for($j = 1; $j <= 3; $j++){
                if($request->request->get('cell_' . $i . '_' . $j) != null){
                    $this->matrix[$i][$j] = $request->request->get('cell_' . $i . '_' . $j);
                }
                else{
                    $this->matrix[$i][$j] = '0';
                }
            }
        }
    }

    public function getArrayResult() : array
    {
        return $this->matrix;
    }
}
