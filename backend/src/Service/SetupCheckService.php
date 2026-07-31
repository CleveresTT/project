<?php

namespace App\Service;

class SetupCheckService {
    private int $testValue = 123;

    public function getTestValueMultipliedByParameter(int $multiplier = 1) : int
    {
        return $this->testValue * $multiplier;
    }
}
