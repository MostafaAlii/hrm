<?php

namespace App\Repositories\Eloquents;
use App\Models\BenefitVariable;
use App\Repositories\Contracts\BenefitVariableRepositoryInterface;
class BenefitVariableRepository extends BaseRepository implements BenefitVariableRepositoryInterface {
    public function __construct(BenefitVariable $model) {
        parent::__construct($model);
    }
}
