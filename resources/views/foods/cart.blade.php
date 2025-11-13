@extends('layouts.app')
@section('content')
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->
         <div class="container-xxl position-relative p-0">
              <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown"> Cart</h1>
                </div>
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
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($cartItem ->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center">Your cart is empty.</td>
                            </tr>
                        @else
                                @foreach ($cartItem as $item)
                            <tr>
                            <th><img height="60px" width="60px" src="{{asset('img/'.$item->image)}}" /></th>
                            <td>{{$item->name}}</td>
                            <td>${{$item->price}}</td>
                            <td><a href="{{route('deleteItem',$item->food_id)}}" class="btn btn-danger text-white">delete</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                @if (!$cartItem -> isEmpty())
                    <div class="position-relative mx-auto" style="max-width: 400px; padding-left: 679px;">
                    <p style="margin-left: -7px;" class="w-19 py-3 ps-4 pe-5" type="text"> Total: ${{$totalPrice}}</p>
                    <form action="{{route('prepare_checkout')}}" method="POST">
                        @csrf
                        <input type="hidden" name="price" value="{{$totalPrice}}">
                        <button type="submit" class="btn btn-primary py-2 top-0 end-0 mt-2 me-2">Checkout</button>
                    </form>
                    
                </div> 
                @endif
                
            </div>
        </div>

@endsection