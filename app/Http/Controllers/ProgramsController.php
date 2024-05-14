<?php

namespace App\Http\Controllers;

use App\Http\Resources\CoachResource;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use App\Models\Coach;

class ProgramsController extends Controller
{

    //store new program
    public function store(Request $request)
    {

        $this->validate($request, [
            'coach_id' => ['required'],
            'data' => ['required']
        ]);

        //example data
        // $data =
        [
            "username" => "ابوالفضل هادی پور",

            "phoneNumber" => '09353096075',

            "coach_id" => 1,

            'روز اول' => [
                'پرس پا ماشین' => '4*3',
                'پرس بالا سینه' => '4*3',
                'پرس سینه' => '4*3',
                'فلای' => '4*3',
                'شنا سوِئدی' => '4*3',
                'اسکوات' => '4*3',
                'جلو بازو لاری' => '4*3',
                'فیله کمر' => '4*3',
                'پرس سرشانه' => '4*12'
            ],
            'روز دوم' => [
                'پرس پا ماشین' => '4*3',
                'پرس بالا سینه' => '4*3',
                'پرس سینه' => '4*3',
                'فلای' => '4*3',
                'شنا سوِئدی' => '4*3',
                'اسکوات' => '4*3',
                'جلو بازو لاری' => '4*3',
                'فیله کمر' => '4*3',
                'پرس سرشانه' => '4*12'
            ],
            'روز سوم' => [
                'پرس پا ماشین' => '4*3',
                'پرس بالا سینه' => '4*3',
                'پرس سینه' => '4*3',
                'فلای' => '4*3',
                'شنا سوِئدی' => '4*3',
                'اسکوات' => '4*3',
                'جلو بازو لاری' => '4*3',
                'فیله کمر' => '4*3',
                'پرس سرشانه' => '4*12'
            ]
        ];


        $coach = Coach::findOrFail($request->coach_id);

        if ($coach->remain_programs > 0) {
            $coach->remain_programs = $coach->remain_programs - 1;
            $coach->save();
        } else {
            return response()->json(['message' => 'اشتراک شما به پایان رسیده است']);
        }



        //save program file

        //data with json format
        $jsonString = json_encode($request->data);

        $data = json_decode($jsonString);

        //make name for program file
        $name = Str::random() . ".json";

        $filePath = storage_path("app\programs\\" . $name);

        File::put($filePath, $jsonString);

        Program::create([
            'name' => $filePath,
            'coach_id' => $request->coach_id,
            'username' => $data->username
        ]);

        return response()->json(['message' => 'program created successfully'], 201);
    }

    //read program file
    public function show($programID)
    {

        $program = Program::findOrFail($programID);

        $filePath = $program->name;

        $data = File::get($filePath);

        $data = json_decode($data, true);

        return $data;
    }


    public function destroy($programID)
    {
        $program = Program::findOrFail($programID);
        $program->delete();

        return response()->json(['message' => 'program deleted successfully']);
    }

    
}
