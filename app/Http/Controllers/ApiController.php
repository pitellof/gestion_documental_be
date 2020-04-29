<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterAuthRequest;
use App\User;
use App\profile;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class ApiController extends Controller
{
    public $loginAfterSignUp = false;

    public function register(RegisterAuthRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->paternal_surname = $request->paternal_surname;
        $user->maternal_surname = $request->maternal_surname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        if($user->save()){
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->supervisor_id = $user->id;
            $profile->name = $request->name;
            $profile->paternal_surname = $request->paternal_surname;
            $profile->maternal_surname = $request->maternal_surname;
            $profile->privileges = json_encode($request->privileges);

            if($profile->save()){
                return response()->json([
                    'success' => true,
                    'data' => $user->profile()->get()
                ], 200);
            }
        }
    }

    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $jwt_token = null;

        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
                'input' => $input,
            ], 401);
        }

        return response()->json([
            'success' => true,
            'token' => $jwt_token,
        ]);
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

    public function getAuthUser(Request $request)
    {
        $this->validate($request, [
            'key' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->key);

        return response()->json(['user' => $user, 'profile' => profile::where('user_id','=',auth()->user()->id)->get()]);
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'password' => 'required|string|min:6|max:10'
            ]);
        $user = User::find($request->id);
        $user->password = bcrypt($request->password);
        if($user->save()){
            return response()->json([
                'success' => true,
                'data' => $user
            ], 200);
        }
    }

    public function export()
    {
        $date = date('Y-m-d H:i:s');
        $filename = 'Registros_'.strtotime($date).'.xlsx';
        return Excel::download(new UsersExport, $filename);
    }
}
