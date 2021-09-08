<?php

namespace App\Http\Controllers;

use App\Jobs\ExampleJob;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Queue\Queue;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class JobController extends Controller
{

    const MODEL = "App\Models\Job";

    use RestActions;

    /**
     * Store a new Job
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->request->add([
                'reference' => Str::uuid()->toString(),
                'status' => Job::$status['scheduled']
            ]
        );
        $job = $this->add($request);
        $this->dispatch(new ExampleJob($request->all()));
        return $this->respond('done', $job);
    }

    /**
     * Display the specified resource.
     *
     * @param $reference
     * @return Response
     */
    public function show($reference)
    {
        return $this->get($reference);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $reference
     * @return Response
     */
    public function update(Request $request, $reference)
    {
        return $this->put($request,$reference);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $reference
     * @return \Illuminate\Http\JsonResponse
     */
    public function remove($reference)
    {
        return $this->destroy($reference);
    }
}
