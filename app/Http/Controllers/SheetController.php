<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sheet;

class SheetController extends Controller
{
    public function index() {
        $sheets = Sheet::all();
        return view('/sheet/index',compact('sheets'));
    }
}
