<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function all()
    {
        $levels = Level::all();
        return response()->json($levels);
    }
}
