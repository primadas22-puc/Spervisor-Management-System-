<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function home(){
        return view('auth.home');
    }
    
    public function studentLogin(){
        return view('auth.studentLogin');
    }
    public function teacherLogin(){
        return view('auth.teacherLogin');
    }
    public function adminLogin(){
        return view('auth.adminLogin');
    }
    public function teacherRegister(){
        return view('auth.teacherRegister');
    }
    public function studentRegister(){
        return view('auth.studentRegister');
    }
    public function registerStoreTeacher(Request $req){
        $obj = new User();
        $obj->name = $req->name;
        $obj -> teacher_id= intval($req->teacher_id);
        $obj->email = $req->email;
        $obj->role= $req->role;
        $obj->password = md5($req->password);
        if($obj->save()){
            return response()->json([
               'status'=> 'success',
               'message' => 'account created'
            ]);
        }

    }
    public function registerStoreStudent(Request $req){
        $obj = new User();
        $obj->name = $req->name;
        $obj -> student_id= intval($req->student_id);
        $obj->email = $req->email;
        $obj->role= $req->role;
        $obj->password = md5($req->password);
        if($obj->save()){
            return response()->json([
               'status'=> 'success',
               'message' => 'account created'
            ]);
        }

    }
    public function storeLogin(Request $req){
        $email = $req ->email;
        $password = $req->password;
        $user = User::where('email','=',$email)
                ->where('password','=', md5($password))
                ->first();
        if($user){
          if($user->active == 0){
             return redirect()->back()->with('info','Account not approved yet');
          }
          else if($user->active == 1 && $user->role == 'admin'){
             $req->session()->put('username',$user->name);
             $req->session()->put('userrole',$user->role);
             return redirect('dashboard');
          }
          else if($user->active == 1 && $user->role == 'student'){
             $req->session()->put('username',$user->name);
             $req->session()->put('userrole',$user->role);
             $req->session()->put('userid',$user->id);
             return redirect('student-home');
          }
          else if($user->active == 1 && $user->role == 'teacher'){
             $req->session()->put('username',$user->name);
             $req->session()->put('userrole',$user->role);
             $req->session()->put('userid',$user->id);
             return redirect('teacher-home');
          }
       }
       else{
           return redirect()->back()->with('info','Email & Password doesnt match');
       }
                 
      }
  }
                
            
