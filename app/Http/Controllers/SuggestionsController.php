<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;

class SuggestionsController extends Controller
{
    public function store(Request $request)
    {

        $this->validate($request,[
            'content'=>['required','min:5','max:255']
        ]);

        Suggestion::create([
            'coach_id' => auth()->user()->id,
            'content' => $request->content
        ]);

        return response()->json(['message' => 'suggestion send successfully']);
    }
}
