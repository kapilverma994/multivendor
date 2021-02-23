@extends('backend.layouts.master')

@section('content')



<div class="col-lg-12">
  @include('backend.layouts.notify')
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">All Banners</h6>
      </div>
      <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr>
              <th>S no</th>
              <th>Image</th>
              <th>Name</th>
              <th>Description</th>
              <th>Condition</th>
              <th>Status</th>
              <th>Action</th>
          
            </tr>
          </thead>
          {{-- <tfoot>
            <tr>

              <th>Image</th>
              <th>Name</th>
              <th>Description</th>
              <th>Condition</th>
              <th>Status</th> 
            </tr>
          </tfoot> --}}
          <tbody>
            @foreach($banners as $key=>$row)
            <tr>
             <td>{{$loop->iteration}}</td>
              <td><img src="{{$row->photo}}" alt="" height="80px" width="80px"></td>
              <td> {{$row->title}}</td>
              <td>{!!$row->description!!}</td>
              <td>{{$row->condition}}</td>
              <td>{{$row->status}}</td>
              <td>
                <a href="{{route('banners.edit',$row->id)}}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i>
                </a>
                <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i>  </a>
              </td>
             
            </tr>
           @endforeach
 
          </tbody>
        </table>
      </div>
    </div>
  </div> 

@endsection