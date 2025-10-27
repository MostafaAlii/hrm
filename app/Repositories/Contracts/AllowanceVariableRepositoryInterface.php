<?php

namespace App\Repositories\Contracts;

interface AllowanceVariableRepositoryInterface extends BaseRepositoryInterface
{
    public function getTaxableVariables();
    public function getHealthInsuranceVariables();
    public function getActiveVariables();
}
