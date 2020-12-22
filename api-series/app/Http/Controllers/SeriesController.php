<?php

namespace App\Http\Controllers;

use App\Models\Serie;

class SeriesController
{
    public function index() 
    {
        return Serie::all();
    }
}