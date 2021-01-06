<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Validator;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return $users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $user = new User();
        $user->fill($data);
        $user->save();
        return response()->json([
            'status' => 200,
            'user' => $user
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::where('id',$id)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'firstname' => 'required|min:3|max:55',
            'lastname'  => 'required|min:3|max:55',
            'email'     => 'required|email',
            'image'     => 'required|image|mimes:jpeg,jpg,svg,png,gif|max:5048'
            
        ]);


        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 401);
        }
        

        $data = $request->all(); 
        $user = User::where('id' , $id)->first();       
        $user->firstname = $data['firstname'];
        $user->lastname = $data['lastname'];
        $user->email = $data['email'];
        $user->image = $data['image'];
        $user->update($data);
    
        if($request->image)
        {
            $image = $request->image;
            $name = time().'_' . $image->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('', $name, 'public');
            $user['image'] = $name;  
         }
         $user->save();
         
         return response()->json('Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id' , $id)->delete();
    }
}
