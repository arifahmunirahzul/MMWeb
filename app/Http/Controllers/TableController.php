<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\TypeService;

class TableController extends Controller
{
    public function TypeService()
    {
         $table = TypeService::all();
         return view('table.type-service', compact('table'));
    }

     public function viewAddTypeService()
    {
        
        return view('table.add-type-service');
    }

    public function addTypeService(Request $request)
    {
        $service = new TypeService;
        $service->name = Input::get('name');
        $service->save();
        return redirect()->route('TypeService');
    }
}
