<?php

namespace App\Http\Controllers;

class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('plants.index');
    }
}
