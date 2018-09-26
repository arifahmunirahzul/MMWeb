<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\TypeService;
use App\TypeProperty;
use App\TypeEvent;

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

    public function viewEditTypeService($id)
    {
        $data = TypeService::getSingleData($id);
        return view('table.edit-type-service', [
            'data' => $data

        ]);
       
    }
    
    public function  editTypeService(Request $request, $id)
    {
        $service = TypeService::find($id);
        $service->name = Input::get('name');
        $service->save();
        return redirect()->route('TypeService');
    }

    public function deleteTypeService($id)
    {
        TypeService::destroy($id);
        return redirect()->route('TypeService');
    }

    //TYPE_PROPERTY

    public function TypeProperty()
    {
         $table = TypeProperty::all();
         return view('table.type-property', compact('table'));
    }

     public function viewAddTypeProperty()
    {
        
        return view('table.add-type-property');
    }

    public function addTypeProperty(Request $request)
    {
        $service = new TypeProperty;
        $service->name = Input::get('name');
        $service->save();
        return redirect()->route('TypeProperty');
    }

    public function viewEditTypeProperty($id)
    {
        $data = TypeProperty::getSingleData($id);
        return view('table.edit-type-property', [
            'data' => $data

        ]);
       
    }
    
    public function  editTypeProperty(Request $request, $id)
    {
        $service = TypeProperty::find($id);
        $service->name = Input::get('name');
        $service->save();
        return redirect()->route('TypeProperty');
    }

    public function deleteTypeProperty($id)
    {
        TypeProperty::destroy($id);
        return redirect()->route('TypeProperty');
    }

    //TYPE_EVENT

    public function TypeEvent()
    {
         $table = TypeEvent::all();
         return view('table.type-event', compact('table'));
    }

     public function viewAddTypeEvent()
    {
        
        return view('table.add-type-event');
    }

    public function addTypeEvent(Request $request)
    {
        $service = new TypeEvent;
        $service->name = Input::get('name');
        $service->save();
        return redirect()->route('TypeEvent');
    }

    public function viewEditTypeEvent($id)
    {
        $data = TypeEvent::getSingleData($id);
        return view('table.edit-type-event', [
            'data' => $data

        ]);
       
    }
    
    public function  editTypeEvent(Request $request, $id)
    {
        $service = TypeEvent::find($id);
        $service->name = Input::get('name');
        $service->save();
        return redirect()->route('TypeEvent');
    }

    public function deleteTypeEvent($id)
    {
        TypeEvent::destroy($id);
        return redirect()->route('TypeEvent');
    }

}
