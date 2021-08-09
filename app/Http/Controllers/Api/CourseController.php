<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    // COURSE ENROLLMENT API - POST
    public function courseEnrollment(Request $request)
    {
        // Validation
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'total_videos' => 'required',
        ]);

        // Create Course Object
        $course = new Course();
        $course->user_id = Auth::user()->id;
        $course->title = $request->title;
        $course->description = $request->description;
        $course->total_videos = $request->total_videos;

        $course->save();

        // send Response
        return response()->json([
            'status' => 1,
            'message' => 'Courses Enrollment Successfully'
        ], 200);
    }

    // COURSE TOTALCOURSES API - GET
    public function totalcourses()
    {
    }

    // DELETE COURSE API - GET
    public function deleteCourse($id)
    {
    }
}
