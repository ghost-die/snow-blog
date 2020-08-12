

@extends('layouts.app')

@section('content')
    <div class="container">


        <div class="row justify-content-around">


            @include('layouts.left')

            @include('layouts.right')

        </div>
    </div>
@endsection

