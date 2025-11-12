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
                    <h1 class="display-3 text-white mb-3 animated slideInDown"> Food Details</h1>
                </div>
            </div>
        </div>
         
        <div class="container-xxl py-5">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
                    <div class="container">
                        <div class="row g-5 align-items-center">
                            <div class="col-md-6">
                                <div class="row g-3">
                                    <div class="col-12 text-start">
                                        <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.1s" src="{{asset('img/'.$foodDetails->image)}}">
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h1 class="mb-4">{{$foodDetails->name}}</h1>
                                <p class="mb-4">{{$foodDetails->description}}.</p>
                                <div class="row g-4 mb-4">
                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-center border-start border-5 border-primary px-3">
                                            <h3>Price: $ {{$foodDetails->price}}</h3>                                   
                                        </div>
                                    </div>
                                
                                </div>
                                @Auth
                                <form method="POST" action="{{route('foodCart', $foodDetails->id)}}">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    <input type="hidden" name="food_id" value="{{$foodDetails->id}}"> 
                                    <input type="hidden" name="name" value="{{$foodDetails->name}}"> 
                                    <input type="hidden" name="price" value="{{$foodDetails->price}}">  
                                    <input type="hidden" name="image" value="{{$foodDetails->image}}"> 
                                    @if ($cartVerify > 0)
                                        <button   class="btn btn-primary py-3 px-5 mt-2" disabled >Added to Cart</button>
                                    @else
                                        <button  type="submit" name="submit" class="btn btn-primary py-3 px-5 mt-2" >Add to Cart</button>
                                    @endif 
                                </form>
                                @else
                                 <p class="alert alert-success">Login to Add food in cart</p>
                                @endAuth
                            </div>
                        </div>
                    </div>
                </div>

@endsection