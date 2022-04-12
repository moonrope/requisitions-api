<?php

namespace App\Repositories;

use App\Models\Item;
use JetBrains\PhpStorm\Pure;


class ItemRepository extends BaseRepository
{
    #[Pure] public function __construct(Item $model)
    {
        parent::__construct($model);
    }

}
