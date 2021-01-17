<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use App\Teams;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Teams::with('employees' , 'projects')->get();
        return $teams;
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
        $team = new Teams();
        $team->fill($data);
        $team->save();
        return response()->json([
            'status' => 200,
            'team' => $team
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
        return Teams::where('id',$id)->first();
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
        $validator = Validator::make($request->all(),[  
            'name' => 'required|min:3|max:15'
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 401);
        }
        

        $data = $request->all(); 
        $team = Teams::where('id' , $id)->first();       
        $team->firstname = $data['name'];
        $team->update($data);
    
        if($request->image)
        {
            $image = $request->image;
            $name = time().'_' . $image->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('', $name, 'public');
            $team['image'] = $name;  
         }
         
         $team->save();
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
        Teams::where('id' , $id)->delete();
    }
}
