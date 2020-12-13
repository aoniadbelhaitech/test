<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;

use App\Models\Teacher;

use App\Repositories\TeacherRepository;
use App\Traits\JsonResponse;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    use JsonResponse;

    private $model;

    public function __construct()
    {
        $this->model = new TeacherRepository(new Teacher());
    }

    /**
     * @OA\Get(
     *      path="/api/teachers",
     *      operationId="index",
     *      tags={"Teacher"},
     * security={
     *  {"passport": {}},
     *   },
     *      summary="get all teachers",
     *      description="get all teachers",
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
     *      path="/api/teachers/{teacherId}",
     *      operationId="show",
     *      tags={"Teacher"},
     *
     * security={{"passport": {}}},
     *      summary="get teacher by id",
     *      description="get teacher by id",
     * @OA\Parameter(
     *    description="filter by id",
     *    in="path",
     *    name="teacherId",
     *    required=true,
     *    example="1",
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
     *      path="/api/teachers",
     *      operationId="store",
     *      tags={"Teacher"},
     *
     * security={{"passport": {}}},
     *      summary="save new teachers",
     *      description="save new teachers",
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
     *                 example={"name":"teacher name 1","username":"teacher_aausername","email":"test_techer@brainpo.com","password":"dasdasdaeeaaaas11daaasdd"}
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
    public function store(CreateTeacherRequest $request)
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
     *      path="/api/teachers/{teacherId}",
     *      operationId="update",
     *      tags={"Teacher"},
     *
     * security={{"passport": {}}},
     *      summary="update teacher  by id ",
     *      description="pdate teacher by id ",
     * @OA\Parameter(
     *    description="teacher by id",
     *    in="path",
     *    name="teacherId",
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
     *                 example={"name":"name 1"}
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
    public function update(UpdateTeacherRequest $request, $id)
    {
        try {
            $request->validated();
            $this->model->update($request->all(), $id);
            return $this->updatedResponse($this->model->show($id));
        } catch (\Exception $e) {
            return $this->errorResponse(500, $e->getMessage());
        }
    }
    /**
     * @OA\delete(
     *      path="/api/teachers/{teacherId}",
     *      operationId="delete",
     *      tags={"Teacher"},
     *
     * security={{"passport": {}}},
     *      summary="delete teacher by id",
     *      description="delete teacher by id",
     * @OA\Parameter(
     *    description="filter by id",
     *    in="path",
     *    name="teacherId",
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
    /**
     * @OA\Get(
     *      path="/api/teachers/{teacherId}/students",
     *      operationId="getStudents",
     *      tags={"Teacher"},
     *
     * security={{"passport": {}}},
     *      summary="get students by teacher id",
     *      description="get students by teacher id",
     * @OA\Parameter(
     *    description="filter by id",
     *    in="path",
     *    name="teacherId",
     *    required=true,
     *    example="1",
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
    public function getStudents($id)
    {
        try {
            return $this->getResponse($this->model->getAllStudents($id));
        } catch (\Exception $e) {
            return $this->errorResponse(500, $e->getMessage());
        }

    }
}
