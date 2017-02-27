<?php

namespace App\Http\Controllers;

use App\User;
use App\Admin;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller {

    /**
     * *
     */
    public function index() {
        return view('admin_login');
    }

    public function login() {
        session_start();
        $token = bin2hex(random_bytes(32));
        if (isset($_REQUEST["user"]) && isset($_REQUEST["password"])) {
            $user=$_REQUEST["user"];
            $password=$_REQUEST["password"];
            $count = Admin::where('user', $user)
                    ->where('password',$password)
                    ->count();
            if ($count === 0) {
               return redirect()->route('admin_login')->with('error', true);
            }
            Admin::where('user', $user)
                    ->where('password',$password)
                    ->update(['token'=>$token]);
            $_SESSION["token"]=$token; 
            return redirect()->route('home_admin');
            
        }
    }
    public function home(){
        session_start();
        $count = Admin::where('token', $_SESSION["token"])
                    ->count();
            if ($count === 0) {
               return redirect()->route('admin_login')->with('error', true);
            }
        return view("download");
    }
    public function descargar(){
        session_start();
        $count = Admin::where('token', $_SESSION["token"])
                    ->count();
            if ($count === 0) {
               return redirect()->route('admin_login')->with('error', true);
            }
          Excel::create('Kia Excel', function($excel) {
            $excel->sheet('Usuarios', function($sheet) {
 
                $user = User::all();
                $sheet->fromArray($user);
 
            });
        })->export('xls');
    }

}
