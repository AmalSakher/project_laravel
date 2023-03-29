<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users= User::with('city')->get();
       // dd($users[0]);
        return response()->view('cms.users.index',['users' =>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $cities = City::all();
        $cities = City::where('active' , '=' , true)->get();
        return response()->view('cms.users.create',['cities' => $cities]);

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

        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'email_address' => 'required|email|unique:users,email',
            'city_id' => 'required|numeric|exists:cities,id',
        ]);

        if (!$validator->fails()) {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email_address');
            $user->password = Hash::make('password');
            $user->city_id = $request->input('city_id');
            $isSaved = $user->save();

            return response()->json([
                'message' => $isSaved ? 'Saved successfully' : 'Save failed!'
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        $cities = City::where('active' , '=' , true)->get();
        return response()->view('cms.users.edit',['user' => $user , 'cities' => $cities]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'email_address' => 'required|email|unique:users,email,'.$user->id,
            'city_id' => 'required|numeric|exists:cities,id',
        ]);
        if(! $validator->fails() ){
            $user->name = $request->input('name');
            $user->email = $request->input('email_address');
            $user->city_id = $request->input('city_id');
            $isSaved = $user->save();
            return response()->json([
               'message' => $isSaved ? 'Updatated Successfuly' : 'Updatated Falaied !'],
               $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        }else{
            return response()->json(['message' => $validator->getMessageBag()->first()],
        Response::HTTP_BAD_REQUEST);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $deleted = $user ->delete();
        return response()->json([
            'title' => $deleted ? 'Deleted': 'Deleted Failed!',
            'text' =>  $deleted ? 'User Deleted Successfuly': ' User Deleting Failed!',
            'icon' =>  $deleted ? 'success': 'error'
        ],
        $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
    );
    }
}
