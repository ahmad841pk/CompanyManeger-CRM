<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\UserContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\SignInRequest;
use App\Http\Resources\UserTransformer;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;


class AuthenticationController extends Controller
{
    public function __construct(
        private readonly UserContract $objUserService,
    ) {}
    public function signIn(SignInRequest $objRequest): JsonResponse
    {
        $objUser = $this->objUserService->findByEmail($objRequest->email);

        if (is_null($objUser)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        if ($this->objUserService->checkUserPassword($objUser, $objRequest->password) === false) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $strToken =  $objUser->createToken("accessToken")->plainTextToken;

        return apiResponse()->meta("token", $strToken)->success(new UserTransformer($objUser));
    }

    public function Logout(): JsonResponse
    {
        return apiResponse()->logout()->success("You Have Successfully Logged Out.");
    }
}
