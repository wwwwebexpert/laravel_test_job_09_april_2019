@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                


                @if(Auth::user()->role_id==1)

                <div class="card-header"> {{ ucfirst(Auth::user()->name)}}, Welcome to dashboard !!! </div>




                   

                @else 


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>


                @endif

            </div>
        </div>
    </div>
</div>
@endsection
