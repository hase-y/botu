<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function add()
    {
    return view('create.add');
    //return view('home.index',['message' =>$message]);
    }

    public function create()
    {
        return redirect('create');
    }

    public function edit()
    {
        return view('edit');
    }

    public function update()
    {
        return redirect('edit');
    }

}