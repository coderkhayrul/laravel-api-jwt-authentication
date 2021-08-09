<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
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

    // COURSE TOTAL COURSES API - GET
    public function totalcourses()
    {
        $user_id = Auth::user()->id;

        $courses = User::find($user_id)->courses;

        return response()->json([
            'status' => 1,
            'message' => 'Total Courses Enroll',
            'data' => $courses
        ]);
    }

    // DELETE COURSE API - GET
    public function deleteCourse($id)
    {
        // user id
        // courses id
        $user_id = Auth::user()->id;

        if (Course::where([
            'id' => $id,
            'user_id' => $user_id
        ])->exists()) {
            $course = Course::find($id);
            $course->delete();

            return response()->json([
                'status' => 1,
                'message' => 'Course deleted successfully',
            ], 200);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Course Not Found'
            ], 404);
        }
    }
}
