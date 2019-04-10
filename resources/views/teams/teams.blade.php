@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                 <div class="card-header">Add / Update team </div>

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

                        @if(Route::current()->getName()=='EditTeam')

                       <form method="POST" action="{{ route('UpdateTeam') }}">

                        <input  type="hidden"  name="id" value="{{ $datas->id }}">

                        @else 
                        
                        <form method="POST" action="{{ route('teams') }}">

                        @endif 

                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">

                                @if(Route::current()->getName()=='EditTeam')

                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $datas->name }}">

                                @else 

                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}">

                                @endif    

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                               
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                    <br>
                      

                    <table class="table table-striped table-hover table-users">
                        <thead>
                            <tr>                                    
                                <th class="hidden-phone">Team Name</th>                                   
                                <th>EDIT</th>
                                <th>DELETE</th>
                            </tr>
                        </thead>

                        <tbody>
                            
                            @foreach($teams as $k=>$team)
                           
                            <tr>                                    
                                <td class="hidden-phone">{{$team->name}}</td>                                    
                                <td><a class="btn mini blue-stripe" href="{{url('/editteam/'.$team->id)}}">Edit</a></td>
                                <td><a href="{{url('/deleteteam/'.$team->id)}}" class="confirm-delete btn mini red-stripe" role="button" data-title="johnny" data-id="1">Delete</a></td>
                            </tr>
                            
                            @endforeach
                        
                           </tbody>

                    </table>
        
                    {{ $teams->links() }}

                </div>
            </div>

        </div>

    </div>
</div>
@endsection
