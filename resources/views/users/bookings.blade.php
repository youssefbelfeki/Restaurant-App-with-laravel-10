@extends('layouts.app')
@section('content')
<div class="container-xxl py-5 bg-dark hero-header mb-5" style="margin-top: -25px">
    <div class="container text-center my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">My Booking</h1>
    </div>
</div>
<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Number Of Peole</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Review</th>
                </tr>
            </thead>
            <tbody>
                @if ($allBookings ->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center">You Dont have any booking.</td>
                    </tr>
                @else
                        @foreach ($allBookings as $booking)
                    <tr>
                    <td>{{$booking->name}}</td>
                    <td>{{$booking->email}}</td>
                    <td>{{$booking->nbr_people}}</td>
                    <td>{{$booking->date}}</td>
                    <td>{{$booking->status}}</td>
                    @if ($booking->status == 'Booked')
                       <td><a href="{{route('viewReview')}}" class="btn btn-success text-white">Review</a></td> 
                    @else
                        <td>Not available yet</td>
                    @endif
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection