<?php

namespace Domain\Requisitions\Repository;

use Domain\Requisitions\Models\Requisition;
use JetBrains\PhpStorm\Pure;
use Src\App\Repositories\BaseRepository;

class RequisitionRepository extends BaseRepository
{
    #[Pure] public function __construct(Requisition $model)
    {
        parent::__construct($model);
    }
}
