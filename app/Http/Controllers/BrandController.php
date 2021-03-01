<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $brands=Brand::latest()->get();
      return view('backend.brand.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
     $this->validate($request,[
         'title'=>'required',
         'photo'=>'required',
         'status'=>'nullable|in:active,inactive'
     ]);
     $data=$request->all();
     $data['slug']=Str::of($request->title)->slug('-');
     $status=Brand::create($data);
     if($status){
        return redirect()->route('brand.index')->with('success','Brand Added Successfully');
              }else{
                  return back()->with('error','something went wrong!');
              }



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
       $brand=Brand::find($id);
       return view('backend.brand.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $brand=Brand::find($id);
   
        $this->validate($request,[
            'title'=>'required',
            'photo'=>'required',
            'status'=>'nullable|in:active,inactive'
        ]);
        $data['slug']=Str::of($request->title)->slug('-');
        $data=$request->all();
     
        $status=$brand->fill($data)->save();
        if($status){
           return redirect()->route('brand.index')->with('success','Brand Updated Successfully');
                 }else{
                     return back()->with('error','something went wrong!');
                 }
    
    }


    public function status(Request $request){
        $brand=Brand::find($request->id);
     if($request->mode=='true'){
         $brand->status='active';
         $brand->save();
         return response()->json(['msg'=>'Brand Active Successfully','status'=>'true']);
     }else{
         $brand->status='inactive';
            $brand->save();
            return response()->json(['msg'=>'Brand Inactive Successfully','status'=>'true']);
     }
   
       }





    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand=Brand::find($id);
        $status=$brand->delete();
        if($status){
            return redirect()->route('brand.index')->with('success','Brand Deleted Successfully');
                  }else{
                      return back()->with('error','something went wrong!');
                  }

    }
}
