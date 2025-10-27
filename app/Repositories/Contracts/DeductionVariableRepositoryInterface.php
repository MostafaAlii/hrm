<?php

namespace App\Repositories\Contracts;

interface DeductionVariableRepositoryInterface extends BaseRepositoryInterface
{
    public function getFixedVariables();
    public function getMonthlyVariables();
    public function getTaxableVariables();
}
