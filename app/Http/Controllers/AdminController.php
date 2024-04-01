<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Semester;
use App\Models\Session;
use App\Models\Group;
use App\Models\User;
use App\Models\AssignSupervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.pages.dashboard');
    }
    public function requestCount(){
        $pendingStudent = User::where('role','student')->where('active', 0)->count();
        $pendingTeacher = User::where('role','teacher')->where('active', 0)->count();
        $totalStudent = User::where('role','student')->where('active', 1)->count();
        $totalTeacher = User::where('role','teacher')->where('active', 1)->count();
        $totalSemester = Semester::count();
        $totalSession = Session::count();
        $totalSection = Section::count();
        return view('admin.pages.dashboard', compact('pendingStudent','pendingTeacher','totalStudent','totalTeacher','totalSemester','totalSession','totalSection'));
    }


  public function pendingStudent(){
    $pendingStudentList = User::where('role','student')->where('active', 0)->get();
    return view('admin.pages.pendingStudent', compact('pendingStudentList'));
  }
  public function deletePendingStudent($pid){
    $deleted = User::where('id', '=', $pid)->delete();
    return redirect('admin-pending-student');
    }
    public function updatePendingStudent($pid){
        User::where('id', '=', $pid)->where('active',0)->update(['active' => 1]);
        return redirect('admin-pending-student');
    }
    public function pendingTeacher(){
        $pendingTeacherList = User::where('role','teacher')->where('active', 0)->get();
        return view('admin.pages.pendingTeacher',compact('pendingTeacherList'));
    }
    public function deletePendingTeacher($pid){
        $deleted = User::where('id', '=', $pid)->delete();
        return redirect('admin-pending-teacher');
    }
    public function updatePendingTeacher($pid){
        User::where('id', '=', $pid)->where('active',0)->update(['active' => 1]);
        return redirect('admin-pending-teacher');
    }
    public function totalStudent(){
        $totalStudentList = User::where('role','student')->where('active', 1)->get();
        return view('admin.pages.totalStudent', compact('totalStudentList'));
    }
    public function totalTeacher(){
        $totalTeacherList = User::where('role','teacher')->where('active', 1)->get();
        return view('admin.pages.totalTeacher', compact('totalTeacherList'));
    }
 //Session
 public function createSession(){
    return view('admin.pages.createSession');
}
    public function storeSession(Request $request){
        $obj = new Session();
        $obj->session_name = $request->session_name;
        if($obj->save()){
            return response()->json([
                'status' => 'success',
                'message' => 'Session created successfully'
            ]);
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'Session creation failed'
            ]);
        }

    }
    public function sessionList(){
        return view('admin.pages.allSession');
    }
    public function sessionListView(){
        $data = Session::all();
        if($data->count() > 0){
            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'No data found'
            ]);
        }
        
    }

    public function sessionEdit($id){
        $data = Session::where('id','=',$id)->first();
        if($data){
            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'No data found'
            ]);
        }
    }

    public function sessionUpdate(Request $request, $id){
        $data = Session::where('id','=',$id)
                        ->update([
                            'session_name' => $request->session_name
                        ]);
        if($data){
            return response()->json([
                    'status' => 'success',
                    'message' => 'Session updated successfully'
            ]);
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'No data found'
            ]);
        }
            
    }
    public function sessionListDelete( $id){
        $data = Session::where('id','=',$id)
                        ->delete();
        if($data){
            return response()->json([
                    'status' => 'success',
                    'message' => 'Session Deleted successfully'
            ]);
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'No data found'
            ]);
        }
            
    }
    //Semester
    public function createSemester(){
        return view('admin.pages.createSemester');
    }

    public function storeSemester(Request $request){
        $obj = new Semester();
        $obj->semester_name = intval($request->semester_name);
        if($obj->save()){
            return response()->json([
                'status' => 'success',
                'message' => 'Semester created successfully'
            ]);
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'Semester creation failed'
            ]);
        }

    }

    public function semesterList(){
        return view('admin.pages.allSemester');
    }

    public function semesterListView(){
        $data = Semester::all();
        if($data->count() > 0){
            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'No data found'
            ]);
        }
        
    }

    public function semesterEdit($id){
        $data = Semester::where('id','=',$id)->first();
        if($data){
            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'No data found'
            ]);
        }
    }

    public function semesterUpdate(Request $request, $id){
        $data = Semester::where('id','=',$id)
                        ->update([
                            'semester_name' => intval($request->semester_name)
                        ]);
        if($data){
            return response()->json([
                    'status' => 'success',
                    'message' => 'Semester updated successfully'
            ]);
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'No data found'
            ]);
        }
            
    }

    public function semesterListDelete( $id){
        $data = Semester::where('id','=',$id)
                        ->delete();
        if($data){
            return response()->json([
                    'status' => 'success',
                    'message' => 'Semester Deleted successfully'
            ]);
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'No data found'
            ]);
        }
            
    }
  
   //section
   public function createSection(){
    return view('admin.pages.createSection');
}

public function storeSection(Request $request){
    $obj = new Section();
    $obj->session_name = ($request->session_name);
    $obj->section_name = ($request->section_name);
    if($obj->save()){
        return response()->json([
            'status' => 'success',
            'message' => 'Section created successfully'
        ]);
    }
    else{
        return response()->json([
            'status' => 'error',
            'message' => 'Section creation failed'
        ]);
    }
}

public function sectionList(){
    return view('admin.pages.allSection');
}

public function sectionListView(){
     $data = DB::table('sections')
                ->join('sessions','sections.session_name','=','sessions.id')
                ->select('sections.*','sessions.session_name as session_name')
                ->get();
    if($data->count() > 0){
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
    else{
        return response()->json([
            'status' => 'error',
            'message' => 'No data found'
        ]);
    }
    
}

public function sectionEdit($id){
    $data = Section::where('id','=',$id)->first();
    if($data){
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
    else{
        return response()->json([
            'status' => 'error',
            'message' => 'No data found'
        ]);
    }
}

public function sectionUpdate(Request $request, $id){
    $data = Section::where('id','=',$id)
                    ->update([
                        'session_name' => $request->session_name,
                        'section_name' => $request->section_name
                    ]);
    if($data){
        return response()->json([
                'status' => 'success',
                'message' => 'Section updated successfully'
        ]);
    }
    else{
        return response()->json([
            'status' => 'error',
            'message' => 'No data found'
        ]);
    }
        
}

public function sectionListDelete($id){
    $data = Section::where('id','=',$id)
                    ->delete();
    if($data){
        return response()->json([
                'status' => 'success',
                'message' => 'Section Deleted successfully'
        ]);
    }
    else{
        return response()->json([
            'status' => 'error',
            'message' => 'No data found'
        ]);
    }
        
}
public function assignSupervisor(){
    return view('admin.pages.assignSupervisor');
}
public function allGroupList(){
    // $data = Group::all();
    $data = DB::table('groups')
    ->join('users','groups.student_id','=','users.id')
    ->select('groups.*','users.student_id as student_id','users.name as student_name')
    ->get();
    if($data->count() > 0){
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
    else{
        return response()->json([
            'status' => 'error',
            'message' => 'No data found'
        ]);
    }
    
    }
    public function supervisorList(){
        $data = User::where('role','teacher')->get();
        if($data->count() > 0){
            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'No data found'
            ]);
        }
    }
    public function storeSupervisor(Request $req){
        $owner_id = $req-> owner_id;
        $supervisor_id = $req-> supervisor_id;
        $obj = new AssignSupervisor();
        $obj->owner_id = $owner_id;
        $obj->supervisor_id = $supervisor_id;
        if($obj->save()){
            return response()->json([
                'status' => 'success',
                'message' => 'Section created successfully'
            ]);
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'Section creation failed'
            ]);
        }
    }
}
