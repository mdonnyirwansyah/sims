<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();

        if($user->role->name === 'Administrator') {
            $classRooms = ClassRoom::all()->count();
            $teachers = Teacher::all()->count();
            $students = Student::all()->count();
            $subjects = Subjects::all()->count();

            $data = [
                'classRooms' => $classRooms,
                'teachers' => $teachers,
                'students' => $students,
                'subjects' => $subjects
            ];
            
            return view('main.beranda.administrator.index', compact('data'));
        }

        return view('main.beranda.mix.index');
    }
}
