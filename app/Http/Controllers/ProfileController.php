<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'supervisor_id' => 'integer|required',
            'name' => 'string|required',
            'paternal_surname' => 'string|required',
            'maternal_surname' => 'string|required',
            'email' => 'string|email|unique:users|required',
            'password' => 'string|required'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->paternal_surname = $request->paternal_surname;
        $user->maternal_surname = $request->maternal_surname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        if($user->save()){
            $profile = new profile();
            $profile->user_id = $user->id;
            $profile->supervisor_id = $request->supervisor_id;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required'
        ]);
        return User::whereHas('profile', function ($query) use ($request) {
            $query->where('supervisor_id','=',$request->user_id)->where('user_id','!=',$request->user_id);
        })->with('profile')->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function showMember(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required'
        ]);
        return User::whereHas('profile', function ($query) use ($request) {
            $query->where('user_id','=',$request->user_id);
        })->with('profile')->get();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(profile $profile)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function showAll()
    {
        return User::whereHas('profile', function ($query) {
            $query->where(DB::raw('json_value(profiles.privileges,\'$.access_level\')'),'!=','Jefe')
            ->where(DB::raw('json_value(profiles.privileges,\'$.access_level\')'),'!=','Ejecutivo');
        })->with('profile')->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'id' => 'integer|required',
            'name' => 'string|required',
            'paternal_surname' => 'string|required',
            'maternal_surname' => 'string|required',
            'email' => 'string|email|required',
            'phone' => 'nullable|digits:10'
        ]);

        $profile = profile::find($request->id);
        $timestamp = strtotime($request->birthday);
        $destinationPath = str_replace(url('/'), ' ', $request->image_url);
        $destinationPath = substr($destinationPath,2);
        $destinationPath = str_replace('/','\\', $destinationPath);
        $existPath= public_path($destinationPath);
        if(file_exists($existPath) && !$request->file('file')){
            $profile->name = $request->name;
            $profile->paternal_surname = $request->paternal_surname;
            $profile->maternal_surname = $request->maternal_surname;
            if($request->birthday !== '' && $request->birthday !== 'undefined' && $request->birthday !== 'null'
			&& $request->birthday !== 'Invalid Date') {
                $profile->birthday = date("Y-m-d", $timestamp);
            }
            if($request->phone !== '' && $request->phone !== 'undefined' && $request->phone !== 'null') {
                $profile->phone = $request->phone;
            }
            if ($profile->save()) {
                $user=User::find($profile->user_id);
                $user->name = $request->name;
                $user->paternal_surname = $request->paternal_surname;
                $user->maternal_surname = $request->maternal_surname;
                // if($user->email !== $request->email){
                //     $user->email = $request->email;
                // }
                if ($user->save()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Información almacenada correctamente'
                   ]);
                }
            }
        } else {
			if (!is_null($request->image_url)) {
				$destinationPath = str_replace(url('/'), ' ', $request->image_url);
				$destinationPath = substr($destinationPath,2);
				$destinationPath = str_replace('/','\\', $destinationPath);
				$existPath= public_path($destinationPath);
				if(unlink($existPath)) {
					$destinationPath = 'uploads/profiles';
					$file = $request->file('file');
					$uniqueId = uniqid();
					$path = url('/').'/'.$destinationPath.'/'.$request->id.'/'.$uniqueId.'.jpg';
					$existPath= public_path($destinationPath.'/'.$request->id.'/'.$uniqueId.'.jpg');

					if(!file_exists($existPath)) {
						if($file->move($destinationPath.'/'.$request->id,$uniqueId.'.jpg')) {
							$profile->name = $request->name;
							$profile->paternal_surname = $request->paternal_surname;
							$profile->maternal_surname = $request->maternal_surname;
							if($request->birthday !== ''  && $request->birthday !== 'undefined'  && $request->birthday !== 'null') {
								$profile->birthday = date("Y-m-d", $timestamp);
							}
							if($request->phone !== '' && $request->phone !== 'undefined' && $request->phone !== 'null') {
								$profile->phone = $request->phone;
							}
							$profile->image_profile = $path;
							if ($profile->save()) {
                                $user=User::find($profile->id);
                                $user->name = $request->name;
                                $user->paternal_surname = $request->paternal_surname;
                                $user->maternal_surname = $request->maternal_surname;
                                // if($user->email !== $request->email){
                                //     $user->email = $request->email;
                                // }
								if ($user->save()) {
									return response()->json([
										'success' => true,
										'message' => 'Información almacenada correctamente'
									]);
								}
							}

						} else{
							return response()->json([
								'success' => false,
								'message' => 'Error al cargar el archivo al servidor'
							], 500);
						}
					}
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Ya existe un archivo con ese nombre en el servidor'
                    ], 302);
                }
            } else {
			    $destinationPath = 'uploads/profiles';
				$file = $request->file('file');
				$uniqueId = uniqid();
				$path = url('/').'/'.$destinationPath.'/'.$request->id.'/'.$uniqueId.'.jpg';
				$existPath= public_path($destinationPath.'/'.$request->id.'/'.$uniqueId.'.jpg');

				if(!file_exists($existPath)){
					if($file->move($destinationPath.'/'.$request->id,$uniqueId.'.jpg')){
						$profile->name = $request->name;
						$profile->paternal_surname = $request->paternal_surname;
						$profile->maternal_surname = $request->maternal_surname;
						if($request->birthday !== ''  && $request->birthday !== 'undefined'  && $request->birthday !== 'null') {
							$profile->birthday = date("Y-m-d", $timestamp);
						}
						if($request->phone !== '' && $request->phone !== 'undefined' && $request->phone !== 'null') {
							$profile->phone = $request->phone;
						}
						$profile->image_profile = $path;
						if ($profile->save()) {
                            $user=User::find($profile->id);
                            $user->name = $request->name;
                            $user->paternal_surname = $request->paternal_surname;
                            $user->maternal_surname = $request->maternal_surname;
                            // if($user->email !== $request->email){
                            //     $user->email = $request->email;
                            // }
                            if ($user->save()) {
                                return response()->json([
                                    'success' => true,
                                    'message' => 'Información almacenada correctamente'
                                ]);
                            }
						}
					}
					else{
						return response()->json([
							'success' => false,
							'message' => 'Error al cargar el archivo al servidor'
						], 500);
					}
				}
				else{
					return response()->json([
						'success' => false,
						'message' => 'Ya existe un archivo con ese nombre en el servidor'
					], 302);
				}
			}
        }
    }

    public function updatePrivileges(Request $request){
        $this->validate($request, [
            'id' => 'integer|required',
            'access_level' => 'string|required',
        ]);

        $profile = profile::where('user_id',$request->id)->first();
        $profile->privileges = $request->access_level;
        if ($profile->save()) {
        return response()->json([
            'success' => true,
            'message' => 'Información almacenada correctamente'
        ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function delete($id){
        $registry = User::find($id);
        $profile = Profile::where('user_id',$id);

        if (!$registry) {
            return response()->json([
                'success' => false,
                'message' => 'El registro con el id ' . $id . ' no puede ser encontrado'
            ], 400);
        }

        if ($registry->delete()) {
            if($profile->delete()){
                return response()->json([
                    'success' => true
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el registro'
            ], 500);
        }
    }
}
