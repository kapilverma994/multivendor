<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $category=Category::latest()->get();
       return view('backend.category.index',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('backend.category.create');
    }

     public function status(Request $request){
      $Category=Category::find($request->id);
   if($request->mode=='true'){
       $Category->status='active';
       $Category->save();
       return response()->json(['msg'=>'Category Active Successfully','status'=>'true']);
   }else{
       $Category->status='inactive';
          $Category->save();
          return response()->json(['msg'=>'Category Inactive Successfully','status'=>'true']);
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
         'condition'=>'nullable|in:Category,promo',
'status'=>'nullable|in:active,inactive'
        ]);

       $data=$request->all();
       $data['slug']=Str::of($request->title)->slug('-');
       $status=Category::create($data);
       if($status){
 return redirect()->route('Categorys.index')->with('success','Category Added Successfully');
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
        $Category=Category::find($id);
        return view('backend.Categorys.edit',compact('Category'));
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
    $Category=Category::find($id);
        $this->validate($request,[
            'title'=>'string|required',
         
            'description'=>'string|nullable',
            'photo'=>'required',
            'condition'=>'nullable|in:Category,promo',
   'status'=>'nullable|in:active,inactive'
           ]);
           $data=$request->all();
           $data['slug']=Str::of($request->title)->slug('-');
           $status=$Category->fill($data)->save();
if($status){
return redirect()->route('category.index')->with('success','Category Updated Successfully');
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
      $Category=Category::find($id);
      $Category->delete();
      return redirect()->route('category.index')->with('success','Category deleted successfully');
    }
}
