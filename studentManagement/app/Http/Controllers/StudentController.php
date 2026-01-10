<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $name;
    protected $age;
    public function __construct()
    {
        $this->name = "Sakshi";
        $this->age = 20;
    }
    public function index()
    {
        return 'hello from controller';
    }

    public function about($id,$name)
    {
        //$name = $this->privatefunction();
        //return 'Id No' . $id .'Name'. $name;
        return $this->name;
        //return $this->age;
        //return view('aboutus',compact('id','name'));
    }

    private function privatefunction()
    {
        return 'Hello World';
    }
}
