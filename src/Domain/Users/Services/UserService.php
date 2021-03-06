<?php

namespace Domain\Users\Services;

use Domain\Users\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;

class UserService
{
    public function __construct(
        private UserRepository $userRepository
    ){
    }

    public function store(array $input): Model
    {
        return $this->userRepository->store($input);
    }
}
