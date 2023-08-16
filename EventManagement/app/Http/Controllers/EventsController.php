<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class EventsController extends Controller
{

    function EventPage(){

        return view('pages.dashboard.event-page');
    }


    
    function createEvents(Request $request){

        $user_id = $request->header('id');

        $img = $request->file('img');

        $t = time(); //For timestamp because of specific user history of add product time
        $file_name = $img->getClientOriginalName();
        $img_name = "{$user_id}--{$t}--{$file_name}"; //Here i concat all the things. User_id+time+file_name

        $img_url = "uploads/{$img_name}";

        //Upload File
        $img->move(public_path('uploads'), $img_url);


        //Save to Database
        return Event::create([

            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'event_datetime' => $request->input('event_datetime'),
            'location' => $request->input('location'),
            'img_url' => $img_url,
            
            'user_id' => $user_id,

        ]);
        
    }


    function DeleteEvent(Request $request){

        $user_id = $request->header('id');
        
        $event_id = $request->input('id');
        $filePath = $request->input('file_path');
        File::delete('$filePath');
        return Event::where('id', $event_id)->where('user_id', $user_id)->delete();

    }


    function EventList(Request $request){

        $user_id = $request->header('id');
        return Event::where('user_id',$user_id)->get();

    }



    function ProductUpdate(Request $request){

        $user_id = $request->header('id');
        $event_id = $request->input('id');

        if($request->hasFile('img')){

            //Same image upload method as like as createProduct 

        $img = $request->file('img');

        $t = time(); //For timestamp because of specific user history of add product time
        $file_name = $img->getClientOriginalName();
        $img_name = "{$user_id}--{$t}--{$file_name}"; //Here i concat all the things. User_id+time+file_name

        $img_url = "uploads/{$img_name}";

        //Upload File
        $img->move(public_path('uploads'), $img_url);

        //Delete old File
        $filePath = $request->input('file_path');
        File::delete($filePath);


        return Event::where('id', $event_id)->where('user_id', $user_id)->update([

            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'event_datetime' => $request->input('event_datetime'),
            'location' => $request->input('location'),
            'img_url' => $img_url,
            

        ]);



        }else{

            return Event::where('id',$event_id)->where('user_id',$user_id)->update([

                'name' => $request->input('title'),
                'price' => $request->input('description'),
                'unit' => $request->input('event_datetime'),
                'category_id' => $request->input('location')


            ]);
        }

        

    }

}
