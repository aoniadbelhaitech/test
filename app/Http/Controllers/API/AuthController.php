<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Traits\JsonResponse;

class AuthController extends Controller
{
    use JsonResponse;

    private $model;

    public function __construct()
    {
        $this->model = new UserRepository(new User());
    }
    /**
     * @OA\Post(
     *      path="/api/register",
     *      operationId="register",
     *      tags={"Authentication"},
     *      summary="create new user",
     *      description="screate new user",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="username",
     *                     type="string"
     *                 ),
     *                @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                @OA\Property(
     *                     property="password_confirmation",
     *                     type="string"
     *                 ),
     *                 example={"name":"tester","username":"test period","email":"email@email.com","password":"123456","password_confirmation":"123456"}
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  @OA\Response(
     *      response=500,
     *      description="Server error"
     *   )
     *  )
     */
    public function register(CreateUserRequest $request)
    {
        try {
            $request->validated();
            $data = $request->all();

            $res = $this->model->create($data);
            return $this->createdResponse($res);
        } catch (\Exception $e) {
            return $this->errorResponse(500, $e->getMessage());
        }
    }
    /**
     * @OA\Post(
     * path="/api/login",
     * summary="Sign in",
     * description="Login by email, password",
     * operationId="login",
     * tags={"Authentication"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", format="email", example="email@email.com"),
     *       @OA\Property(property="password", type="string", format="password", example="123456"),
     *    ),
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
     *        )
     *     )
     * )
     */
    public function login(LoginRequest $request)
    {
        try {
            $request->validated();
            $loginData = $request->all();
            if (!auth()->attempt($loginData)) {
                return $this->errorResponse(400, ['message' => 'Invalid Credentials']);
            }
            $accessToken = auth()->user()->createToken('authToken')->accessToken;
            return $this->getResponse(['user' => auth()->user(), 'access_token' => $accessToken]);
        } catch (\Exception $e) {
            return $this->errorResponse(500, $e->getMessage());
        }
    }

}
