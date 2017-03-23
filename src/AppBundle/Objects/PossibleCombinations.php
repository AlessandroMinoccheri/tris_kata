<?php

namespace AppBundle\Objects;

class PossibleCombinations
{
    private $combinations;

    public function __construct($position)
    {
        $this->combinations = [];

        $possibleCombinations = [
            [
                [0, 1, 2],
                [0, 3, 6],
                [0, 4, 8]
            ],
            [
                [0, 1, 2],
                [1, 4, 7]
            ],
            [
                [0, 1, 2],
                [2, 5, 8],
                [2, 4, 6]
            ]
        ];

        switch ($position) {
            case '3':   array_push($this->combinations, [3, 4, 5] );
                        array_push($this->combinations, [0, 3, 6] );
                        break;
            case '4':   array_push($this->combinations, [3, 4, 5] );
                        array_push($this->combinations, [1, 4, 7] );
                        array_push($this->combinations, [0, 4, 8] );
                        array_push($this->combinations, [2, 4, 6] );
                        break;
            case '5':   array_push($this->combinations, [3, 4, 5] );
                        array_push($this->combinations, [2, 5, 8] );
                        break;
            case '6':   array_push($this->combinations, [6, 7, 8] );
                        array_push($this->combinations, [0, 3, 8] );
                        array_push($this->combinations, [2, 4, 6] );
                        break;
            case '7':   array_push($this->combinations, [6, 7, 8] );
                        array_push($this->combinations, [1, 4, 7] );
                        break;
            case '8':   array_push($this->combinations, [6, 7, 8] );
                        array_push($this->combinations, [2, 5, 8] );
                        array_push($this->combinations, [0, 4, 8] );
                        break;
            default:    $this->combinations = $possibleCombinations[$position];
                        break;
        }
    }

    public static function fromPosition(
        $position
    ) : PossibleCombinations {
        return new self($position);
    }

    public function getCombinations()
    {
        return $this->combinations;
    }
}
