<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    
    function TodoCreate(Request $request){

        $user_id = $request->header('id');
        if (!$user_id) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }
    
        // Check if all required fields are present in the request
        $title = $request->input('title');
        $description = $request->input('description');
        $completed = $request->input('completed');
    
        if (!$title || !$description || !isset($completed)) {
            return response()->json(['error' => 'Missing required fields'], 400);
        }
    
        // Create the todo
        try {
            $todo = Todo::create([
                'title' => $title,
                'description' => $description,
                'completed' => $completed,
                'user_id' => $user_id
            ]);
    
            return response()->json($todo, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create todo'], 500);
        }

    }


    function TodoList(Request $request){
        $user_id=$request->header('id');
        return Todo::where('user_id',$user_id)->get();
    }

    function CustomerDelete(Request $request){
        $todo_id=$request->input('id');
        $user_id=$request->header('id');
        return Todo::where('id',$todo_id)->where('user_id',$user_id)->delete();
    }

    function CustomerUpdate(Request $request){
        $todo_id=$request->input('id');
        $user_id=$request->header('id');
        return Todo::where('id',$todo_id)->where('user_id',$user_id)->update([
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'completed'=>$request->input('completed'),
        ]);
    }


}
