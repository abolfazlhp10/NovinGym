<?php

namespace App\Http\Controllers;

use App\Http\Resources\CoachResource;
use App\Models\Coach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CoachesController extends Controller
{


    public function index()
    {
        $coaches = Coach::all();
        return $coaches;
    }

    public function register(Request $request)
    {

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:coaches'],
            'number' => ['required', 'min:11', 'max:11', 'unique:coaches'],
            'password' => ['required', 'min:8'],
            'password_confirmation' => ['required', 'min:8']
        ]);

        if ($request->password != $request->password_confirmation) {
            return response()->json(['message' => 'passwords not match'], 401);
        }


        //send sms to the number


        //check input code



        $user = Coach::create([
            'name' => $request->name,
            'username' => $request->username,
            'number' => $request->number,
            'password' => Hash::make($request->password),
            'remain_programs' => 10,
        ]);

        if ($request->hasFile('image')) {
            $user->image = $request->image->store('coaches/images');
            $user->save();
        }


        return new CoachResource($user);
    }

    public function login(Request $request)
    {

        $this->validate($request, [
            'usernameOrNumber' => ['required'],
            'password' => ['required']
        ]);

        $user = Coach::where('username', $request->usernameOrNumber)->orWhere('number', $request->usernameOrNumber)->first();


        if (!$user) {
            return response()->json(['message' => 'username or password is incorrect'], 401);
        }

        if (!password_verify($request->password, $user->password)) {
            return response()->json(['message' => 'username or password is incorrect'], 401);
        }

        $CoachToken = $user->createToken('coachToken', ['*'], now()->addMinutes(24 * 60));

        return response()->json(['token' => $CoachToken->plainTextToken, 'user' => new CoachResource($user)]);
    }
}
