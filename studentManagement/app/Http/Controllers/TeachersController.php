<?php

namespace App\Http\Controllers;

use App\Models\Teachers;
use Illuminate\Http\Request;

class TeachersController extends Controller
{
    public function index()
    {
        return Teachers::all();
    }

    public function add()
    {
        $item = new Teachers();
        $item->name = 'Tester';
        $item->save();

        return 'Added Successfully';
    }

    public function show($id)
    {
        $item = Teachers::findorFail($id);
        return $item;
    }

    public function update($id)
    {
        $item = Teachers::findorFail($id);
        $item->name = 'Updated Tacher';
        $item->update();

        return 'updated suvvessfully';
    }

    public function delete($id)
    {
        $item = Teachers::findorFail($id);
        $item->delete();

        return 'deleted successfully';
    }
}
