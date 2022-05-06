@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-header">{{ __('Proceed to Checkout') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h5>User Requested Order Size: <b>{{$tshirts}}</b></h5>
                    <p></p>
                    <p>Following are the ideal packs to be sent out to fullfill the order:</p>
                    
                    <table class="table table-dark table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Pack Size</th>
                                <th>Number of Packs</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($final_selection as $pack => $count)
                                <tr>
                                    <td>{{$pack}}</td>
                                    <td>{{$count}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <small>You can check the available list of pack sizes available <a href="list-pack-size">here</a></small>
                    <p></p>
                    <input type="submit" id="placeOrder" class="btn btn-primary" value="Place Order" disabled/>
                </div>
            </div>
        </div>
    </div>
</div>
@stop