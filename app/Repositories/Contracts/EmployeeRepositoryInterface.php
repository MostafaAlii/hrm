<?php

namespace App\Repositories\Contracts;

interface EmployeeRepositoryInterface extends BaseRepositoryInterface {
    public function show($id, $view, $title);
}