<?php

namespace Src\App\Controllers\Auth;

use App\Controllers\Controller;
use Domain\Users\Services\UserService;
use Faker\Generator as Faker;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Src\App\Requests\Auth\SignInRequest;
use Src\App\Requests\Auth\SignUpRequest;
use function response;

class AuthController extends Controller
{
    public function __construct(
        private UserService $userService,
        private Auth $auth,
        private Faker $faker
    ){
    }

    public function signIn(SignInRequest $request): JsonResponse
    {
        if(!$this->auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return response()->json('Unauthorised.',401);
        }

        $authUser = $this->auth::user();
        $success['token'] = $authUser->createToken($this->faker->word())->plainTextToken;
        $success['name'] = $authUser->name ?? null;

        return response()->json([$success,'message' => 'User signed in']);
    }

    public function signUp(SignUpRequest $request): JsonResponse
    {
        $user = $this->userService->store($request->all());
        $success['token'] =  $user->createToken($this->faker->word())->plainTextToken;
        $success['name'] =  $user->name;

        return response()->json([$success,'message'=>'User created successfully.']);
    }
}
