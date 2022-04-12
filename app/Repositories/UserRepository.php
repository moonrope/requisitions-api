<?php

namespace App\Repositories;

use App\Models\User;
use JetBrains\PhpStorm\Pure;

class UserRepository extends BaseRepository
{
    #[Pure] public function __construct(User $model)
    {
        parent::__construct($model);
    }

}
