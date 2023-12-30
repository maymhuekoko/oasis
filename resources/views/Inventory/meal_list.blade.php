@extends('master')

@section('title','Meal List')

@section('place')

@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="card-title">Meal List</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $i=1;?>
                            @foreach($meal_lists as $meal)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$meal->name}}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-warning rounded" data-toggle="modal" data-target="#edit_item{{$meal->id}}"><i class="far fa-edit"></i>
                                    Edit</a>
                                </td>
                                
                                <div class="modal fade" id="edit_item{{$meal->id}}" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title">Edit Category Form</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>

                                    <div class="modal-body">
                                        <form class="form-material" method="post" action="{{route('meal_update', $meal->id)}}">
                                            @csrf
                                            <div class="form-group">    
                                                <label class="font-weight-bold">Name</label>
                                                <input type="text" name="name" class="form-control" value="{{$meal->name}}"> 
                                            </div>
                                            <input type="submit" name="btnsubmit" class="btnsubmit float-right btn btn-coffee" value="Update">
                                        </form>           
                                    </div>
                               
                              </div>
                                    </div>
                                </div>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="card-title">Meal Create Form</h3>
                <form class="form-material" method="post" action="{{route('meal_store')}}">
                    @csrf
                    
                    <div class="form-group">    
                        <label class="font-weight-bold">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Meal Name" required>

                        @error('name')
                            <span class="invalid-feedback alert alert-danger" role="alert"  height="100">
                                {{ $message }}
                            </span>
                        @enderror 

                    </div>
                    <input type="submit" name="btnsubmit" class="btnsubmit float-right btn btn-coffee" value="Save">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection