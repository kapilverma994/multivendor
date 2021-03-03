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
        <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="form-group">
         <label for="">Title</label>
         <input type="text" name="title" class="form-control" value="{{old('title')}}">
          </div>
          <div class="form-group">
            <label for="">Short Description</label>
           <textarea name="description" id="summernote" class="form-control" cols="30" rows="4">{{old('description')}}</textarea>
           
          </div>
          <div class="form-group">
            <label for="">Long Description</label>
           <textarea name="ldescription" id="summernote1" class="form-control" cols="30" rows="8">{{old('ldescription')}}</textarea>
           
          </div>
          <div class="form-group">
            <label for="">Quantity</label>

            <input type="number" class="form-control" name="stock" placeholder="Enter Stock Quantity" required>

          </div>
          <div class="form-group">
            <label for="">Price</label>
            <input type="text" name="price" class="form-control" required>

          </div>
          <div class="form-group">
            <div class="input-group">
                <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                    <i class="fa fa-picture-o"></i> Choose
                  </a>
                </span>
                <input id="thumbnail" class="form-control" type="text" name="photo">
              </div>
              <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          </div>

          <div class="form-group">


            <select name="condition" class="form-control" id="">
                <option value="">--Condition--</option>
                <option value="new" {{old('condition')=='new'?'selected':''}}>New</option>
                <option value="hot"  {{old('condition')=='hot'?'selected':''}} >Hot</option>
                <option value="popular"  {{old('condition')=='popular'?'selected':''}} >Popular</option>
            </select>
          </div>
<div class="form-group">
  <input class="form-control" type="text"  name="size" id="size" data-role="tagsinput" > 

</div>
          <div class="form-group">


          <select name="status" class="form-control" id="">
              <option value="">Status</option>
              <option value="active" {{old('status')=='active'?'selected':''}}>Active</option>
              <option value="inactive"  {{old('status')=='inactive'?'selected':''}} >Inactive</option>
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

@endsection