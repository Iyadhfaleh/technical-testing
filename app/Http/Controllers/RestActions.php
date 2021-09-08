<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

trait RestActions
{

    protected $statusCodes = [
        'done' => 200,
        'created' => 201,
        'removed' => 204,
        'not_valid' => 400,
        'not_found' => 404,
        'conflict' => 409,
        'permissions' => 401
    ];

    public function all(): JsonResponse
    {
        $m = self::MODEL;
        return $this->respond('done', $m::all());
    }

    public function get($reference): JsonResponse
    {
        $m = self::MODEL;
        $model = $m::find($reference);
        if (is_null($model)) {
            return $this->respond('not_found');
        }
        return $this->respond('done', $model);
    }

    public function add(Request $request): Job
    {
        $m = self::MODEL;
        $this->validate($request, $m::$rules);
        return $m::create($request->all());
    }

    public function put(Request $request, $reference): JsonResponse
    {
        $m = self::MODEL;
        $this->validate($request, $m::$rules);
        $model = $m::find($reference);
        if (is_null($model)) {
            return $this->respond('not_found');
        }
        $model->update($request->all());
        return $this->respond('done', $model);
    }

    public function destroy($reference): JsonResponse
    {
        $m = self::MODEL;
        $model = $m::find($reference);
        if (is_null($model)) {
            return $this->respond('not_found');

        }
        $model->update(['status'=>$model::$status['removed']]);
        return $this->respond('removed');
    }

    public function respond($status, $data = []): JsonResponse
    {
        return response()->json($data, $this->statusCodes[$status]);
    }

}
