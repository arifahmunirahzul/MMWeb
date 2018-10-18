<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Train;
use MailgunMailgun;



class APIImageController extends Controller
{
    public function UploadImage(Request $request)
    {
      
        if ($request->hasFile('url_image'))
        {
        $file = $request->file('url_image');
        $filename = time() . str_random(5) . '_' .  '.' . $file->getClientOriginalExtension();
        $path = 'upload/train';
        $file->move($path, $filename);

        $train = new Train;
        $train->url_image = $filename;
        $train->save();

        $urlimage = Train::orderBy('created_at', 'desc')->value('url_image');

        return response()->json(['message' => 'Image has been upload', 'url_image' => $urlimage, 'status' => true], 201);
       }
        

        else{
            return response()->json(['message' => 'No image has been upload', 'status' => false], 401);
        }
        
       
       

    }//end public

   
}//end class


