@extends('layouts.admin')
@section('content')
<div class="row">
<div class="col">
    @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    <div class="card">
    <div class="card-body">
        <h5 class="card-title mb-4 d-inline">Foods</h5>
        <a  href="{{route('createFood')}}" class="btn btn-primary mb-4 text-center float-right">Create Foods</a>
    
        <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">image</th>
            <th scope="col">name</th>
            <th scope="col">description</th>
            <th scope="col">price</th>
            <th scope="col">category</th>
            <th scope="col">delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allFoods as $food)
                <tr>
                <th scope="row">{{$food->id}}</th>
                <td><img width="60" height="60" src="{{asset('img/'.$food->image)}}" /></td>
                <td>{{$food->name}}</td>
                <td>{{$food->description}}</td>
                <td>${{$food->price}}</td>
                <td>{{$food->category}}</td>
                <td><a href="{{route('deleteFood',$food->id)}}" class="btn btn-danger text-white">delete</a></td>
                </tr>
            @endforeach
        </tbody>
        </table> 
    </div>
    </div>
</div>
@endsection