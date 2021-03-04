<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=User::latest()->get();
        return view('backend.user.index',compact('user'));
    }

    public function status(Request $request){
        $user=User::find($request->id);
     if($request->mode=='true'){
         $user->status='active';
         $user->save();
         return response()->json(['msg'=>'user Active Successfully','status'=>'true']);
     }else{
         $user->status='inactive';
            $user->save();
            return response()->json(['msg'=>'user Inactive Successfully','status'=>'true']);
     }
   
       }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request,[
'full_name'=>'required',
'username'=>'nullable',
'email'=>'required|email|unique:users,email',
'phone'=>'required|numeric',
'password'=>'min:4|required',
'address'=>'required',
'photo'=>'required',
'role'=>'required|in:admin,vendor,customer',
'status'=>'required|in:active,inactive'

        ]);
        $data=$request->all();
        $data['password']=Hash::make($request->password);
        // return $data;
        $status=User::create($data);
        if($status){
  return redirect()->route('user.index')->with('success','User Added Successfully');
        }else{
            return back()->with('error','something went wrong!');
        }
      
  


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::find($id);
        return view('backend.user.edit',compact('user'));
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
        $this->validate($request,[
            'full_name'=>'required',
            'username'=>'nullable',
            'email'=>'required|email|exists:users,email',
            'phone'=>'required|numeric',
    'address'=>'required',
            'photo'=>'required',
            'role'=>'required|in:admin,vendor,customer',
        
            
                    ]);
                    $user=User::find($id);
                    $data=$request->all();
                    // $data['password']=Hash::make($request->password);
                    // return $data;
                    $status=$user->fill($data)->save();
                    if($status){
              return redirect()->route('user.index')->with('success','User Updated Successfully');
                    }else{
                        return back()->with('error','something went wrong!');
                    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);
      $status =$user->delete();
        if($status){
            return redirect()->route('user.index')->with('success','User deleted Successfully');
                  }else{
                      return back()->with('error','something went wrong!');
                  }
    }
}
