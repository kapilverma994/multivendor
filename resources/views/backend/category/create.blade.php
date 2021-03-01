@extends('backend.layouts.master')
@section('content')
<div class="col-lg-8 ">
    <!-- Form Basic -->
    <div class="card mb-4">
      @include('backend.layouts.notify')
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      
        <h6 class="m-0 font-weight-bold text-primary">Add Category</h6>
      </div>
      @if($errors->any() )
      <ul>
        @foreach($errors->all() as $error)
      <li class="text-danger">{{$error}}</li>
        @endforeach
      </ul>


      @endif
      <div class="card-body">
        <form action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="form-group">
         <label for="">Title</label>
         <input type="text" name="title" class="form-control" value="{{old('title')}}">
          </div>
          <div class="form-group">
            <label for="">Description</label>
           <textarea name="description" id="summernote" class="form-control" cols="30" rows="5">{{old('description')}}</textarea>
           
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
          <div class="form-group" id="parent_div">
            <label for="">Is Parent :</label>
            <input type="checkbox" name="parent_id" value="1" id="parent_id" checked> Yes

          </div>

          <div class="form-group">


            <select name="parent_cat_id" class="form-control d-none" id="parent_cat_id">
                <option value="">--Parent Category--</option>
                @foreach($category as $cats)
                   <option value="{{$cats->id}}" {{old('parent_cat_id')==$cats->id ?'selected':''}}>{{$cats->title}}</option>
                @endforeach
            
              
            </select>
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
<script>
$('#parent_id').change(function(e){
e.preventDefault();
var parent_id=$('#parent_id').prop('checked');
if(parent_id){
$('#parent_cat_id').addClass('d-none');
$('#parent_cat_id').val('');
}else{
  $('#parent_cat_id').removeClass('d-none');
}
})

</script>

@endsection