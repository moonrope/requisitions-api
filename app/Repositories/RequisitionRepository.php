<?php

namespace App\Repositories;

use App\Models\Requisition;
use JetBrains\PhpStorm\Pure;

class RequisitionRepository extends BaseRepository
{
    #[Pure] public function __construct(Requisition $model)
    {
        parent::__construct($model);
    }
}
