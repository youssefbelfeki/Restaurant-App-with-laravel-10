@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="card">
            <div class="card-body">
            <h5 class="card-title mb-5 d-inline">Update Order Status</h5>
            <br>
            <p >Order Status Is : <b>{{$Order->status}}</b></p>
            <form method="POST" action="{{route('UpdateOrder',$Order->id)}}" >
                @csrf
                    <div class="form-outline mb-4 mt-4">
                        <select name="status" class="form-select  form-control" aria-label="Default select example">
                            <option value="Processing">Processing</option>
                            <option value="Delevering">Delevering</option>
                            <option value="Delivered">Delivered</option>
                        </select>
                    </div>
                    <br>
                    <!-- Submit button -->
                    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Change Status</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection