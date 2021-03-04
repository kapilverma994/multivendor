@extends('backend.layouts.master')
@section('content')
<div class="col-lg-8 ">
    <!-- Form Basic -->
    <div class="card mb-4">
      @include('backend.layouts.notify')
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      
        <h6 class="m-0 font-weight-bold text-primary">Add Product</h6>
      </div>
      @if($errors->any() )
      <ul>
        @foreach($errors->all() as $error)
      <li class="text-danger">{{$error}}</li>
        @endforeach
      </ul>


      @endif
      <div class="card-body">
        <form action="{{route('product.update',$product->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
          <div class="form-group">
         <label for="">Title</label>
         <input type="text" name="title" class="form-control" value="{{$product->title}}">
          </div>
          <div class="form-group">
            <label for="">Short Description</label>
           <textarea name="description" id="summernote" class="form-control" cols="30" rows="4">{{$product->summary}}</textarea>
           
          </div>
          <div class="form-group">
            <label for="">Long Description</label>
           <textarea name="ldescription" id="summernote1" class="form-control" cols="30" rows="8">{{$product->description}}</textarea>
           
          </div>
          <div class="form-group">
            <label for="">Quantity</label>

            <input type="number" class="form-control" name="stock" value="{{$product->stock}}" placeholder="Enter Stock Quantity" required>

          </div>
         
          <div class="form-group">
            <div class="input-group">
                <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                    <i class="fa fa-picture-o"></i> Choose
                  </a>
                </span>
                <input id="thumbnail" class="form-control" type="text" value="{{$product->photo}}" name="photo">
              </div>
              <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          </div>
          <div class="form-group">
            <label for="">Price</label>
            <input type="number" step="any" name="price" class="form-control" value="{{$product->price}}"  required>

          </div>
          <div class="form-group">
            <label for="">Sale Price</label>
            <input type="number" step="any" name="sprice" class="form-control" value="{{$product->offer_price}}"  required>

          </div>
          <div class="form-group">
            <label for="">Discount </label>
            <input type="number" name="dprice" step="any" class="form-control" value="{{$product->discount}}" required>

          </div>
          <div class="form-group">
            <label for="">Size</label>
            <input class="form-control" type="text"  name="size" value="{{$product->size}}" id="size" data-role="tagsinput" > 
          
          </div>
          <div class="form-group">


            <select name="brand_id" class="form-control" id="">
                <option value="">Choose Brand</option>
               @foreach($brand as $br)
<option value="{{$br->id}}" {{$product->brand_id==$br->id?'selected':''}}>{{$br->title}}</option>
               @endforeach
          
            </select>
          </div>
          <div class="form-group">


            <select name="category_id" class="form-control" id="cat_id">
                <option value="">Choose Catgory</option>
               @foreach($cats as $cat)
<option value="{{$cat->id}}"  {{$product->category_id==$cat->id?'selected':''}} >{{$cat->title}}</option>
               @endforeach
          
            </select>
          </div>
          <div class="form-group d-none" id="child_cat_div">


            <select name="childcat" class="form-control " id="child_cat_id">
   
      
          
            </select>
          </div>
          <div class="form-group">


            <select name="condition" class="form-control" id="">
                <option value="">--Condition--</option>
                <option value="new" {{$product->condition=='new'?'selected':''}}>New</option>
                <option value="hot"  {{$product->condition=='hot'?'selected':''}} >Hot</option>
                <option value="popular"  {{$product->condition=='popular'?'selected':''}} >Popular</option>
            </select>
          </div>
          <div class="form-group">
            <select name="vendor" class="form-control" id="" >
              <option value="">Choose Vendor</option>
@foreach(\App\Models\User::where('role','vendor')->get() as $vendor)
<option value="{{$vendor->id}}" {{$product->vendor_id==$vendor->id?'selected':''}} >{{$vendor->full_name}}</option>
@endforeach
            </select>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             

          </div>

       
         
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
@endsection
@section('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
$('#lfm').filemanager('image');
</script>
<script>
  var child_cat_id={{$product->child_cat_id}}
  $('#cat_id').change(function(){
    var cat_id=$(this).val();
    if(cat_id!=null){
      $.ajax({
url:"{{route('category.child')}}",
type:"post",
data:{
  _token:"{{csrf_token()}}",
  cat_id:cat_id,

},
success:function(data){
if(data.status){
  var html_option="<option value=''>--Child Category--</option>";
  $('#child_cat_div').removeClass('d-none');
 $.each(data.data,function(id,title){
html_option+="<option value='"+id+"' "+(child_cat_id==id?'selected':'')+">"+title+"</option>";
 });


}else{
  $('#child_cat_div').addClass('d-none');
}
$('#child_cat_id').html(html_option);
}
      });
    }
 
  })
  if(child_cat_id!=null){
    $('#cat_id').change()

  }
</script>

@endsection
