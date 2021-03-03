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
        $category=Category::where('is_parent',1)->latest()->get();
      return view('backend.category.create',compact('category'));
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
     public function getChild(Request $request){
        $cat=Category::find($request->cat_id);
        if($cat){
            $child_id=Category::getChild($request->cat_id);
            if(count($child_id)<=0){
                return response()->json(['status'=>false,'data'=>Null,'msg'=>'No child category found']);
            }else{
                return response()->json(['status'=>true,'data'=>$child_id,'msg'=>'data found']);
            }
        }else{
            return response()->json(['status'=>false,'data'=>null,'msg'=>'category not  found']);
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
       'parent_id'=>'sometimes|in:1',
 'parent_cat_id'=>'nullable',
'status'=>'required|in:active,inactive'
        ]);

       $data=$request->all();
       $data['slug']=Str::of($request->title)->slug('-');
       $data['is_parent']=$request->input('parent_id',0);
       $data['parent_id']=$request->parent_cat_id;
 
       $status=Category::create($data);
       if($status){
 return redirect()->route('category.index')->with('success','Category Added Successfully');
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
        $cats=Category::where('is_parent',1)->latest()->get();
        $category=Category::find($id);
        return view('backend.Category.edit',compact('category','cats'));
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
    // dd($request->all());
        $this->validate($request,[
            'title'=>'string|required',
            'description'=>'string|nullable',
            'photo'=>'required',
          'parent_id'=>'sometimes|in:1',
    'parent_cat_id'=>'nullable',
   'status'=>'nullable|in:active,inactive'
           ]);
           $data=$request->all();
           $data['slug']=Str::of($request->title)->slug('-');
          if($request->is_parent==1){
              $data['parent_id']=null;
          }
           $data['parent_id']=$request->parent_cat_id;
     
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
