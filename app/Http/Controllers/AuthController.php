<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\SignInRequest;
use App\Http\Requests\Auth\SignUpRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Faker\Generator as Faker;

class AuthController extends Controller
{
    public function __construct(
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
        $success['name'] = $authUser->name;

        return response()->json([$success,'message' => 'User signed in']);
    }

    public function signUp(SignUpRequest $request): JsonResponse
    {
        $user = User::create($request->all());
        $success['token'] =  $user->createToken($this->faker->word())->plainTextToken;
        $success['name'] =  $user->name;

        return response()->json([$success,'message'=>'User created successfully.']);
    }
}
