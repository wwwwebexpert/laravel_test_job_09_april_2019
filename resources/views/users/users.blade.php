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
                
                <div class="card-body">

                @if(Route::current()->getName()=='EditUser')

                    <div class="card-header">Update a user</div>
                    <br>

                    <form method="POST" action="{{ route('UpdateUser') }}">

                        <input  type="hidden"  name="id" value="{{ $datas->id }}">

                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $datas->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $datas->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Assign Role</label>

                            <div class="col-md-6">
                                <select name="role_id" class="form-control">
                                    @foreach($roles as $role)

                                        @if($datas->role_id==$role->id)
                                            <option value="{{$role->id}}" selected="selected">{{$role->name}}</option>
                                        @else    
                                             <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endif

                                    @endforeach
                                </select>
                            </div>
                        </div>



                         <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Assign Team</label>

                            <div class="col-md-6">
                                
                                @php
                                $teamCol = explode(',',$datas->assigned_teams);
                                @endphp

                                @foreach($teams as $team)

                                @if(in_array($team->id,$teamCol))

                                    <input id="teams" type="checkbox" class="" name="assigned_teams[]" value="{{$team->id}}" checked>{{$team->name}} <br>

                                @else 

                                    <input id="teams" type="checkbox" class="" name="assigned_teams[]" value="{{$team->id}}">{{$team->name}} <br>

                                @endif

                                @endforeach  
                                
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Assign Team Owner</label>

                            <div class="col-md-6">

                                 <select name="assigned_team_owner" class="form-control">
                                    <option value="">Select</option>
                                    @foreach($teams as $team)

                                        @if($datas->assigned_team_owner==$team->id)
                                            <option value="{{$team->id}}" selected="selected">{{$team->name}}</option>
                                        @else    
                                             <option value="{{$team->id}}">{{$team->name}}</option>
                                        @endif

                                    @endforeach
                                </select>
                                
                            </div>
                        </div>




                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>


                    @else 
                    
                    <div class="card-header">Add a new user</div>
                    <br>

                    <form method="POST" action="{{ route('users') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Assign Role</label>

                            <div class="col-md-6">
                                <select name="role_id" class="form-control">
                                    @foreach($roles as $role)
  
                                    <option value="{{$role->id}}">{{$role->name}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>



                         <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Assign Team</label>

                            <div class="col-md-6">
                                
                                @foreach($teams as $team)

                                    <input id="teams" type="checkbox" class="" name="assigned_teams[]" value="{{$team->id}}">{{$team->name}} <br>

                                @endforeach  
                                
                            </div>
                        </div>


                         <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Assign Team Owner</label>

                            <div class="col-md-6">

                                 <select name="assigned_team_owner" class="form-control">
                                        <option value="">Select</option>
                                    @foreach($teams as $team)
                                        <option value="{{$team->id}}">{{$team->name}}</option>
                                   @endforeach
                                </select>
                                
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>




                    @endif

                    <br>

                       <table class="table table-striped table-hover table-users">
                            <thead>
                                <tr>                                    
                                    <th class="hidden-phone">Name</th>                                   
                                    <th class="hidden-phone">Email</th>                                   
                                    <th class="hidden-phone">Role</th>                                   
                                    <th class="hidden-phone">Teams</th>                                   
                                    <th class="hidden-phone">Owner of Team</th>                                   
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>

                            <tbody>
                                
                                @foreach($users as $k=>$user)
                               
                                <tr>                                    
                                    <td class="hidden-phone">{{$user->name}}</td>                                    
                                    <td class="hidden-phone">{{$user->email}}</td>                                    
                                    <td class="hidden-phone">{{$user->rname}}</td>                                    
                                    <td class="hidden-phone">
                                        
                                        @php
                                        $teamCol = explode(',',$user->assigned_teams);
                                        @endphp

                                        @foreach($teams as $team)

                                        @if(in_array($team->id,$teamCol))

                                            {{$team->name}}<br>

                                        @endif
                                        @endforeach    
                                    </td>  

                                    <td class="hidden-phone">
                                                                              
                                        @foreach($teams as $team)

                                        @if($team->id==$user->assigned_team_owner)

                                            {{$team->name}}<br>

                                        @endif
                                        @endforeach    
                                    </td> 
                                     @if($user->role_id!=1)
                                        <td><a class="btn mini blue-stripe" href="{{url('/edituser/'.$user->id)}}">Edit</a></td>    
                                        <td><a href="{{url('/deleteuser/'.$user->id)}}" class="confirm-delete btn mini red-stripe" role="button"   data-title="johnny" data-id="1">Delete</a></td>

                                     @else 
                                        <td><a class="btn mini blue-stripe" href="{{url('/edituser/'.$user->id)}}">Edit</a></td>
                                        <td></td>

                                     @endif                                  
                                   
                                </tr>
                                
                                @endforeach
                            
                               </tbody>

                        </table>
            
                        {{ $users->links() }}
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
