<?php

namespace Domain\Items\Repository;

use Domain\Items\Models\Item;
use JetBrains\PhpStorm\Pure;
use Src\App\Repositories\BaseRepository;


class ItemRepository extends BaseRepository
{
    #[Pure] public function __construct(Item $model)
    {
        parent::__construct($model);
    }
}
