<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Employees;

use Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employees::with('teams' , 'kpis','projects')->get();
        return $employees;
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



        $employee = [
            'identity'  => $request->identity,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'image' => null,
            'email'    => $request->email,
            'phone'  => $request->phone,
            'team_id' => $request->team_id
        ];
    
    
    
            if($request->image)
           {
               $image = $request->image;
               $name = time().'_' . $image->getClientOriginalName();
               $filePath = $request->file('image')->storeAs('', $name, 'public');
               $employee['image'] = $name;  
            }

            Employees::create($employee);
            
            return response()->json('Successfully added');


        $data = $request->all();
        $employee = new Employees();
        $employee->fill($data);
        $employee->save();
        return response()->json([
            'status' => 200,
            'employee' => $employee 
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
        return Employees::where('id',$id)->first();
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
            'firstname' => 'required|min:3|max:55',
            'lastname'  => 'required|min:3|max:55',
            'email'     => 'required|email',
            'image'     => 'required|image|mimes:jpeg,jpg,svg,png,gif|max:5048',
            'phone'     => 'required|min:11|numeric',
            'identity'  => 'required|min:5'
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 401);
        }
        

        $data = $request->all(); 
        $employee = Employees::where('id' , $id)->first();       
        $employee->firstname = $data['firstname'];
        $employee->lastname = $data['lastname'];
        $employee->email = $data['email'];
        $employee->image = $data['image'];
        $employee->identity = $data['identity'];
        $employee->phone = $data['phone'];
        $employee->update($data);
    
        if($request->image)
        {
            $image = $request->image;
            $name = time().'_' . $image->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('', $name, 'public');
            $employee['image'] = $name;  
         }
         $employee->save();

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
       Employees::where('id' , $id)->delete();
    }
}
