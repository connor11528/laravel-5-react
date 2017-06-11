@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <h1>Map</h1>
        <map></map>
    </div>
    <div class='row'>
        <h2>Business List</h2>

        <div id="example"></div>
    </div>
    <div class='row'>
        <a href='/businesses/create'>Create a new business</a>
    </div>
</div>
@endsection
