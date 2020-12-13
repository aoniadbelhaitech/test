<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePeriodRequest;
use App\Http\Requests\UpdatePeriodRequest;
use App\Models\Period;
use App\Repositories\PeriodRepository;
use App\Traits\JsonResponse;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    //
    use JsonResponse;

    private $model;

    public function __construct()
    {
        $this->model = new PeriodRepository(new Period());
    }
    /**
     * @OA\Get(
     *      path="/api/periods",
     *      operationId="index",
     *      tags={"Period"},
     * security={
     *  {"passport": {}},
     *   },
     *      summary="get all periods",
     *      description="get all periods",
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
     *      path="/api/periods/{periodId}",
     *      operationId="show",
     *      tags={"Period"},
     *
     * security={{"passport": {}}},
     *      summary="get period by id",
     *      description="get period by id",
     * @OA\Parameter(
     *    description="filter by tags",
     *    in="path",
     *    name="periodId",
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
     *      path="/api/periods",
     *      operationId="store",
     *      tags={"Period"},
     *
     * security={{"passport": {}}},
     *      summary="save new period",
     *      description="save new period",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="student_id",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                @OA\Property(
     *                     property="teacher_id",
     *                     type="string"
     *                 ),
     *                 example={"student_id":1,"name":"test period","teacher_id":1}
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
    public function store(CreatePeriodRequest $request)
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
     *      path="/api/periods/{periodId}",
     *      operationId="update",
     *      tags={"Period"},
     *
     * security={{"passport": {}}},
     *      summary="update period by id ",
     *      description="pdate period by id ",
     * @OA\Parameter(
     *    description="period by id",
     *    in="path",
     *    name="periodId",
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
     *                     property="student_id",
     *                     type="string"
     *                 ),
     *                @OA\Property(
     *                     property="teacher_id",
     *                     type="string"
     *                 ),
     *                @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 example={"student_id":1,"name":"test period","teacher_id":1}
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
    public function update(UpdatePeriodRequest $request, $id)
    {
        try {
            $request->validated();
            $res = $this->model->update($request->all(),$id);
            return $this->updatedResponse($res);
        } catch (\Exception $e) {
            return $this->errorResponse(500, $e->getMessage());
        }
    }
    /**
     * @OA\delete(
     *      path="/api/periods/{periodId}",
     *      operationId="delete",
     *      tags={"Period"},
     *
     * security={{"passport": {}}},
     *      summary="delete period by id",
     *      description="delete period by id",
     * @OA\Parameter(
     *    description="filter by id",
     *    in="path",
     *    name="periodId",
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
