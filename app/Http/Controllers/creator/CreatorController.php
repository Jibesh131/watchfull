<?php

namespace App\Http\Controllers\creator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreatorController extends Controller
{
    public function index() {
        return view('creator.index');
    }
}
