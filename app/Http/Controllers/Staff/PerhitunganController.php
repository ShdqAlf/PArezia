<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PerhitunganController extends Controller
{
    public function index(){
        return view('staff.kelolaperhitungan');
    }
}
