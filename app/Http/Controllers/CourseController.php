<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class CourseController extends Controller
{
    public function create(){
        return view('course.create');
    }

    public function store(Request $req){
        // dd($req);
        $course_n=$req->course_name;
        $course_c=$req->course_code;
        $course_t=$req->course_type;
        $course_j=$req->join_date;
        
        //Query Builder Syntax
        DB::table('courses')->insert([
            'course_name' => $course_n,  //here course name is the database table name where data insert
            'course_type' => $course_t,
            'course_code' => $course_c,
            'join_date'  =>$course_j
            
        ]);
    }

    public function all(){
        $courses = DB::table('courses')->get();
        return view('course.all',compact('courses'));
        
    }

    public function edit($id){
        $course = DB::table('courses')
                       ->where('id','=',$id)
                       ->first();
        return view('course.edit',compact('course'));
    }

    public function update(Request $req,$id){
        $course_n=$req->course_name;
        $course_c=$req->course_code;
        $course_t=$req->course_type;

        $course = DB::table('courses')
              ->where('id', $id)
              ->update([
                'course_name' => $course_n, 
            'course_type' => $course_t,
            'course_code' => $course_c
            ]);
            return redirect()->to('courses');
    }

    public function delete($id){
        $deleted = DB::table('courses')->where('id', '=', $id)->delete();
        return redirect()->to('courses');
    }
}
