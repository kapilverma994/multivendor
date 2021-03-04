<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product=Product::latest()->get();
        return view('backend.product.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand=Brand::latest()->get();
        $cats=Category::where('is_parent',1)->latest()->get();
        return view('backend.product.create',compact('brand','cats'));
    }
    public function status(Request $request){
        $product=Product::find($request->id);
     if($request->mode=='true'){
         $product->status='active';
         $product->save();
         return response()->json(['msg'=>'Product Active Successfully','status'=>'true']);
     }else{
         $product->status='inactive';
            $product->save();
            return response()->json(['msg'=>'Product Inactive Successfully','status'=>'true']);
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
          'title'=>'required',
          'description'=>'required',
               'ldescription'=>'required',
               'stock'=>'required|numeric',
               'photo'=>'required',
               'price'=>'required|numeric',
               'sprice'=>'required|numeric',
               'dprice'=>'nullable|numeric',
               'size'=>'required',
               'brand_id'=>'required',
               'category_id'=>'required|exists:categories,id',
               'childcat'=>'nullable|exists:categories,id',
               'condition'=>'required',
               'vendor'=>'required',
               'status'=>'required|in:active,inactive',

      ]);
      $data=$request->all();
      $data['slug']=Str::of($request->title)->slug('-');
      $data['summary']=$request->description;
      $data['description']=$request->ldescription;
      $data['offer_price']=$request->price-($request->price*$request->discount)/100;
      $data['discount']=$request->dprice;
      $data['vendor_id']=$request->vendor;

      $status=Product::create($data);
      if($status){
return redirect()->route('product.index')->with('success','Product Added Successfully');
      }else{
          return back()->with('error','something went wrong!');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::find($id);
        $brand=Brand::latest()->get();
        $cats=Category::where('is_parent',1)->latest()->get();
        return view('backend.product.edit',compact('product','brand','cats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $pro=Product::find($id);
        $this->validate($request,[
            'title'=>'required',
            'description'=>'required',
                 'ldescription'=>'required',
                 'stock'=>'required|numeric',
                 'photo'=>'required',
                 'price'=>'required|numeric',
                 'sprice'=>'required|numeric',
                 'dprice'=>'nullable|numeric',
                 'size'=>'required',
                 'brand_id'=>'required',
                 'category_id'=>'required|exists:categories,id',
                 'childcat'=>'nullable|exists:categories,id',
                 'condition'=>'required',
                 'vendor'=>'required',
                
  
        ]);
        $data=$request->all();
        $data['slug']=Str::of($request->title)->slug('-');
        $data['summary']=$request->description;
        $data['description']=$request->ldescription;
        $data['offer_price']=$request->price-($request->price*$request->discount)/100;
        $data['discount']=$request->dprice;
        $data['vendor_id']=$request->vendor;
 
        $status=$pro->fill($data)->save();
        if($status){
  return redirect()->route('product.index')->with('success','Product Updated Successfully');
        }else{
            return back()->with('error','something went wrong!');
        }
      }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pro=Product::find($id);
        $status=$pro->delete();
        if($status){
            return redirect()->route('product.index')->with('success','Product deleted Successfully');
                  }else{
                      return back()->with('error','something went wrong!');
                  }

    }
}
