<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /*protected $name;
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
    }*/
        public function addData()
        {
            DB::table('students')->insert([
            [
                'name'=>'tester',
                'email'=>'tester@gmail.com',
                'age'=>15,
                'date_of_birth'=>'2010-01-01',
                'gender'=>'m',
                'user_id'=>8
            ],
            [
                'name'=>'tester1',
                'email'=>'tester1@gmail.com',
                'age'=>18,
                'date_of_birth'=>'2010-01-01',
                'gender'=>'m',
                'user_id'=>8
            ],
            [
                'name'=>'tester2',
                'email'=>'tester2@gmail.com',
                'age'=>15,
                'date_of_birth'=>'2010-05-03',
                'gender'=>'m',
                'user_id'=>12
            ],
            [
                'name'=>'tester3',
                'email'=>'tester3@gmail.com',
                'age'=>25,
                'date_of_birth'=>'2077-07-08',
                'gender'=>'f',
                'user_id'=>11
            ]
            ]);

            return 'added Successfully';
        }

        public function getData()
        {
            $items = DB::table('students')
            //->limit(10)
            //->first();   # return output in a object 
            //->where('id',104)
            //->orWhere('id',105)
            //->select('id','name')
            //->get();      # return output in a array 
           ->count();

            return $items;
        }

        public function updateData()
        {
            DB::table('students')->where('id',102)->update([
                'name'=>'update name',
            ]);

            return 'updated successfully';
        }

        public function deleteData()
        {
            DB::table('students')->where('id',103)->delete();

            return 'Deleted Successfully';
        }
}
