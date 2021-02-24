<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $banners=Banner::latest()->get();
       return view('backend.banners.index',compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('backend.banners.create');
    }

     public function status(Request $request){
      $banner=Banner::find($request->id);
   if($request->mode=='true'){
       $banner->status='active';
       $banner->save();
       return response()->json(['msg'=>'Banner Active Successfully','status'=>'true']);
   }else{
       $banner->status='inactive';
          $banner->save();
          return response()->json(['msg'=>'Banner Inactive Successfully','status'=>'true']);
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
        $this->validate($request,[
         'title'=>'string|required',
      
         'description'=>'string|nullable',
         'photo'=>'required',
         'condition'=>'nullable|in:banner,promo',
'status'=>'nullable|in:active,inactive'
        ]);

       $data=$request->all();
       $data['slug']=Str::of($request->title)->slug('-');
       $status=Banner::create($data);
       if($status){
 return redirect()->route('banners.index')->with('success','Banner Added Successfully');
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
        $banner=Banner::find($id);
        return view('backend.banners.edit',compact('banner'));
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
    $banner=Banner::find($id);
        $this->validate($request,[
            'title'=>'string|required',
         
            'description'=>'string|nullable',
            'photo'=>'required',
            'condition'=>'nullable|in:banner,promo',
   'status'=>'nullable|in:active,inactive'
           ]);
           $data=$request->all();
           $data['slug']=Str::of($request->title)->slug('-');
           $status=$banner->fill($data)->save();
if($status){
return redirect()->route('banners.index')->with('success','Banner Updated Successfully');
}else{
    return redirect()->back()->with('success','Something went wrong!!');
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
      $banner=Banner::find($id);
      $banner->delete();
      return redirect()->route('banners.index')->with('success','Banner deleted successfully');
    }
}
