@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4 d-inline">Orders</h5>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">email</th>
                            <th scope="col">town</th>
                            <th scope="col">country</th>
                            <th scope="col">zipcode</th>
                            <th scope="col">phone_number</th>
                            <th scope="col">address</th>
                            <th scope="col">total_price</th>
                            <th scope="col">status</th>
                            <th scope="col">delete</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($getAllChekout as $checkout)
                             <tr>
                                <th scope="row">{{$checkout->id}}</th>
                                <td>{{$checkout->name}}</td>
                                <td>{{$checkout->email}}</td>
                                <td>{{$checkout->town}}</td>
                                <td>{{$checkout->country}}</td>
                                <td>{{$checkout->zipcode}}</td>
                                <td>{{$checkout->phone}}</td>
                                <td>{{$checkout->address}}</td>
                                <td>${{$checkout->price}}</td>
                                <td>{{$checkout->status}}</td>
                                <td><a href="{{route('EditOrder',$checkout->id)}}" class="btn btn-warning text-white">Change Status</a></td>
                                <td><a href="{{route('DeleteOrder',$checkout->id)}}" class="btn btn-danger text-white">delete</a></td>
                                </tr>
                            @endforeach
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
</div>
@endsection