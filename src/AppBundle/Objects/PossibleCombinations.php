<?php

namespace AppBundle\Objects;

class PossibleCombinations
{
    private $combinations;

    private function __construct($position)
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
            ],[
                [3, 4, 5],
                [0, 3, 6]
            ],
            [
                [3, 4, 5],
                [1, 4, 7],
                [0, 4, 8],
                [2, 4, 6]
            ],
            [
                [3, 4, 5],
                [2, 5, 8]
            ],
            [
                [6, 7, 8],
                [0, 3, 8],
                [2, 4, 6]
            ],
            [
                [6, 7, 8],
                [1, 4, 7]
            ],
            [
                [6, 7, 8],
                [2, 5, 8],
                [0, 4, 8]
            ]
        ];

        $this->combinations = $possibleCombinations[$position];
    }

    public static function fromPosition(
        $position
    ) : PossibleCombinations {
        return new self($position);
    }

    public function getCombinations() : array
    {
        return $this->combinations;
    }
}
