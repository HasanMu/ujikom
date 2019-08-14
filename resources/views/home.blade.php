@extends('layouts.app')

@section('content')
    <div class="container">
        <router-view></router-view>

        <vue-progress-bar></vue-progress-bar>
    </div>
@endsection
