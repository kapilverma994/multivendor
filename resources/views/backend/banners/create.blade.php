@extends('backend.layouts.master')
@section('content')
<div class="col-lg-8 ">
    <!-- Form Basic -->
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Add Banner</h6>
      </div>
      <div class="card-body">
        <form action="{{'banners.store'}}" method="post" enctype="multipart/form-data">
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
                <input id="thumbnail" class="form-control" type="text" name="filepath">
              </div>
              <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          </div>

          <div class="form-group">


            <select name="conditon" class="form-control" id="">
                <option value="">Condition</option>
                <option value="banner" {{old('condition')=='banner'?'selected':''}}>Banner</option>
                <option value="promo"  {{old('condition')=='promo'?'selected':''}} >Promote</option>
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

@endsection