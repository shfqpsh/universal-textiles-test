@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Home</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-header">{{ __('Place Order') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="/place-order" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Select Seller: </label>
                            <select name="seller" id="seller" class="form-control">
                                <option value="flosso">Flosso</option>
                            </select>

                            <small id="emailHelp" class="form-text text-muted">Please Note: This wholsaler sells only complete <a href="/list-pack-size">packs</a>.</small>
                        </div>
                        <div class="form-group">
                            <label for="tshirts">Enter Number of T-Shirts: </label>
                            <input type="text" class="form-control" id="tshirts" name="tshirts" placeholder="Ex: 250" onkeypress="return isNumber(event)" minlength="1" maxlength="5" required />
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="agreement" name="agreement" required />
                            <label class="form-check-label" for="agreement">I agree to the Seller's terms.</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
