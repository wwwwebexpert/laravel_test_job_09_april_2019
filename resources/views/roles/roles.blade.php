@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
               
                @if(session()->get('success'))
                    <div class="alert alert-success">
                      {{ session()->get('success') }}  
                    </div><br />
                 @elseif(session()->get('error')) 

                    <div class="alert alert-danger">
                      {{ session()->get('error') }}  
                    </div><br />
                 
                 @endif


                  @if(Route::current()->getName()=='EditRole')

                   <div class="card-header">Update a role</div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('UpdateRole') }}">
                            @csrf

                            <input  type="hidden"  name="id" value="{{ $datas->id }}">

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $datas->name }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>


                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>


                            </div>
                           
                            
                        </form>

                    </div>


                    @else 


                      <div class="card-header">Add a new role</div>

                        <div class="card-body">

                            <form method="POST" action="{{ route('roles') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Save') }}
                                        </button>
                                    </div>

                                </div>

                                
                                
                            </form>
                        </div>


                    @endif

                     <br>

                       <table class="table table-striped table-hover table-users">
                            <thead>
                                <tr>                                    
                                    <th class="hidden-phone">Name</th>                                   
                                    <th>EDIT</th>
                                    <th>DELETE</th>
                                </tr>
                            </thead>

                            <tbody>
                                
                                @foreach($roles as $k=>$role)
                               
                                <tr>                                    
                                    <td class="hidden-phone">{{$role->name}}</td>                       
                                    <td><a class="btn mini blue-stripe" href="{{url('/editrole/'.$role->id)}}">Edit</a></td>

                                    <td>

                                        @if($role->id!=1)    
                                        <a href="{{url('/deleterole/'.$role->id)}}" class="confirm-delete btn mini red-stripe" role="button" data-title="johnny" data-id="1">Delete</a>                        
                                        @endif

                                    </td>
                                </tr>
                                
                                @endforeach
                            
                               </tbody>

                        </table>
            
                        {{ $roles->links() }}

            </div>
        </div>
    </div>
</div>
@endsection
