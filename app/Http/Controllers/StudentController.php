<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use Illuminate\Support\Facades\DB;
class StudentController extends Controller
{
    public function studentHome(Request $request){
        $username = $request->session()->get('username');
        return view('student.pages.home',compact('username'));
    }
    public function createGroup(){
        return view('student.pages.createGroup');
    }
    public function registerGroup(Request $req){
        $student_id = $req->session()->get('userid');
        $member_id = $req->member_id;
        $member_name = $req->member_name;
        $obj = new Group();
        $obj-> student_id = $student_id;  
        $obj->  member_name= json_encode($member_name);
        $obj->  member_id= json_encode($member_id);
        if($obj->save()){
            return response()->json([
                'status' => 'success',
                'message' => 'Group created successfully'
            ]);
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'Group creation failed'
            ]);
        }

    }
    public function viewGroup(){
        return view('student.pages.viewGroup');
    }
    public function groupList(Request $request){
        $student_id = $request->session()->get('userid');
        $data = DB::table('groups')
                    ->where('groups.student_id','=',$student_id)
                    ->join('users','groups.student_id','=','users.id')
                    ->select('groups.*','users.student_id as student_id','users.name as student_name')
                    ->get();
        if($data && $data->count()>0 ){
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
    public function deleteGroup($id){
        $data = Group::where('id','=',$id)
        ->delete();
if($data){
return response()->json([
    'status' => 'success',
    'message' => 'Group Deleted successfully'
]);
}
else{
return response()->json([
'status' => 'error',
'message' => 'No data found'
]);
}
    }
    public function assignedProject(){
        return view('student.pages.assignedProject');
    }
    public function getSupervisor(Request $request){
        $student_id = $request->session()->get('userid');
        $data = DB::table('assign_supervisors')
        ->where('assign_projects.onwer_id','=',$student_id)
        ->join('users','assign_supervisors.supervisor_id','=','users.id')
        // ->join('groups','assign_supervisors.owner_id','=','groups.id')
        ->select('assign_supervisors.*','users.*')
                ->get();
        if($data && $data->count()>0 ){
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
    public function showAssignedProject(){
        $student_id = $request->session()->get('userid');
        $data = DB::table('assign_projects')
                    ->where('assign_projects.supervisor_id','=',$teacher_id)
                    ->join('users','assign_supervisors.supervisor_id','=','users.id')
                    // ->join('groups','assign_supervisors.owner_id','=','groups.id')
                    ->select('assign_supervisors.*','users.teacher_id as teacher_id','users.name as teacher_name','groups.member_name as member_name','groups.member_id as member_id')
                    ->get();
        if($data && $data->count()>0 ){
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
}
