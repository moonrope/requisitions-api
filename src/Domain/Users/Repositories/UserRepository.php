<?php

namespace Domain\Users\Repositories;

use Domain\Users\Models\User;
use JetBrains\PhpStorm\Pure;
use Src\App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    #[Pure] public function __construct(User $model)
    {
        parent::__construct($model);
    }

}
