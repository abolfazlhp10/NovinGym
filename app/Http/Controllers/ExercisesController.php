<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExercisesController extends Controller
{
    //show all exercises
    public function index()
    {
        return Exercise::all();
    }

    //store exercise
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'unique:exercises'],
            'category_id' => ['required'],
            'description' => ['required'],
            'video' => ['required'],
        ]);



        $exercise = Exercise::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'video' => $request->video->store('exerciseVideos'),
        ]);

        return $exercise;
    }


    //show data about selected exercise for update
    public function edit($id)
    {
        $exercise = Exercise::findOrFail($id);
        return $exercise;
    }

    //update exercise
    public function update($id, Request $request)
    {
        $exercise = Exercise::findOrFail($id);

        if ($request->hasFile('video')) {
            Storage::delete($exercise->video);
            $exercise->video = $request->video->store('exerciseVideos');
            $exercise->save();
        }

        $exercise->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description
        ]);

        return response()->json(['message' => 'the exercise updated successfully']);
    }


    //delete exercise
    public function destroy($id)
    {
        $exercise = Exercise::findOrFail($id);

        Storage::delete($exercise->video);

        $exercise->delete();

        return response()->json(['message' => 'the exercise deleted successfully']);
    }
}
