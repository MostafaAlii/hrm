<?php

namespace App\Repositories\Contracts;

interface EntitlementVariableRepositoryInterface extends BaseRepositoryInterface
{
    public function getFixedVariables();
    public function getMonthlyVariables();
    public function getTaxableVariables();
}