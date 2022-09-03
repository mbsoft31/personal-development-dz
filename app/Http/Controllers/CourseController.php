<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse|Response
     */
    public function index()
    {
        $course = Course::all();
        return response()->json($course);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCourseRequest $request
     * @return Response
     */
    public function store(StoreCourseRequest $request)
    {
        try {
            $validated = $request->validate($request->rules());
        }catch (Exception $e) {
            return \response()->send($e->getTraceAsString());
        }
        $course = Course::factory()->create($validated);
        return response()->json($course);
    }

    /**
     * Display the specified resource.
     *
     * @param Course $course
     * @return JsonResponse|Response
     */
    public function show(Course $course)
    {
        return response()->json($course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCourseRequest $request
     * @param Course $course
     * @return JsonResponse|Response
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        try {
            $validated = $request->validate($request->rules());
        }catch (Exception $e) {
            return \response()->send($e->getTraceAsString());
        }
        $course->update($validated);
        $course->refresh();
        return response()->json($course);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Course $course
     * @return Application|ResponseFactory|Response
     */
    public function destroy(Course $course)
    {
        $deleted = $course->delete();
        return $deleted ?
            response()->json(["message" => "deleted"]):
            response('', 500);
    }
}
