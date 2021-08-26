<?php

namespace App\Http\Controllers;

class MessageController extends Controller
{
    public function inbox()
    {
        return view('admin.inbox');
    }
}
