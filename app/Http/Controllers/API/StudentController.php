<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use App\Repositories\StudentRepository;
use App\Traits\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    use JsonResponse;

    private $model;

    public function __construct()
    {
        $this->model = new StudentRepository(new Student());
    }

    /**
     * @OA\Get(
     *      path="/api/students",
     *      operationId="index",
     *      tags={"Student"},
     * security={
     *  {"passport": {}},
     *   },
     *      summary="get all students",
     *      description="get all students",
     *
     *      @OA\Response(
     *          response=200,
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
    public function index()
    {
        return $this->getResponse($this->model->all());
    }

    /**
     * @OA\Get(
     *      path="/api/students/{studentId}",
     *      operationId="show",
     *      tags={"Student"},
     *
     * security={{"passport": {}}},
     *      summary="get student by id",
     *      description="get student by id",
     * @OA\Parameter(
     *    description="filter by tags",
     *    in="path",
     *    name="studentId",
     *    required=true,
     *    example="1, 2",
     *    @OA\Schema(
     *       type="string"
     *    )
     * ),
     *      @OA\Response(
     *          response=200,
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
    public function show($id)
    {
        try {
            return $this->getResponse($this->model->show($id));
        } catch (\Exception $e) {
            return $this->errorResponse(500, $e->getMessage());
        }
    }

    /**
     * @OA\Post(
     *      path="/api/students",
     *      operationId="store",
     *      tags={"Student"},
     *
     * security={{"passport": {}}},
     *      summary="save new students",
     *      description="save new student",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="username",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="name",
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
     *                     property="grade",
     *                     type="string"
     *                 ),
     *                 example={"name":"name 1","username":"aausername","email":"test@brainpo.com","password":"dasdasdaeeaaaas11daaasdd","grade":5}
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
    public function store(CreateStudentRequest $request)
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
     * @OA\Put(
     *      path="/api/students/{studentId}",
     *      operationId="update",
     *      tags={"Student"},
     *
     * security={{"passport": {}}},
     *      summary="update student by id ",
     *      description="pdate student by id ",
     * @OA\Parameter(
     *    description="student by id",
     *    in="path",
     *    name="studentId",
     *    required=true,
     *    example="1",
     *    @OA\Schema(
     *       type="string"
     *    )
     * ),
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                @OA\Property(
     *                     property="grade",
     *                     type="string"
     *                 ),
     *                 example={"name":"name 1","grade":5}
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
    public function update(UpdateStudentRequest $request, $id)
    {
        try {
            $request->validated();
            $res = $this->model->update($request->all(), $id);
            return $this->updatedResponse($request->all());
        } catch (\Exception $e) {
            return $this->errorResponse(500, $e->getMessage());
        }
    }

    /**
     * @OA\delete(
     *      path="/api/students/{studentId}",
     *      operationId="delete",
     *      tags={"Student"},
     *
     * security={{"passport": {}}},
     *      summary="delete student by id",
     *      description="delete student by id",
     * @OA\Parameter(
     *    description="filter by tags",
     *    in="path",
     *    name="studentId",
     *    required=true,
     *    example="1",
     *    @OA\Schema(
     *       type="string"
     *    )
     * ),
     *      @OA\Response(
     *          response=204,
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
    public function delete(Request $request, $id)
    {
        try {
            $res = $this->model->delete($id);
            return (!$res) ? $this->errorResponse(400, "bad Request") : $this->deletedResponse();
        } catch (\Exception $e) {
            return $this->errorResponse(500, $e->getMessage());
        }

    }
}
