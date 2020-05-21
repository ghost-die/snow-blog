

@extends('layouts.app')

@section('content')
    <div class="container">


        <div class="row justify-content-around">


            @include('index.left')

            @include('index.right')

        </div>
    </div>
@endsection

