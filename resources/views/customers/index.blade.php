@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Customer Listing</h1>

     <!-- Search Form -->
    <form action="{{ route('customers.search') }}" method="POST" class="mb-4">
            @csrf
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="email" class="form-control" placeholder="Search by Email" value="{{ request('email') }}">
            </div>
            <div class="col-md-4">
                <input type="text" name="order_number" class="form-control" placeholder="Search by Order Number" value="{{ request('order_number') }}">
            </div>
            <div class="col-md-4">
                <input type="text" name="item_name" class="form-control" placeholder="Search by Item Name" value="{{ request('item_name') }}">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="{{ route('customers.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>

    <!-- Customer Listings -->  
@if (count($customers) > 0)
    @foreach ($customers as $customer)
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">{{ $customer->first_name .' '. $customer->last_name }}</h4>
            <small>{{ $customer->email }}</small>
        </div>
        <div class="card-body">
            <h5>Orders:</h5>
            @if ($customer->orders->isEmpty())
            <p>No orders found.</p>
            @else
            @foreach ($customer->orders as $order)
            <div class="card mb-3">
                <div class="card-body">
                    <h6>Order #{{ $order->order_number }}</h6>
                    <p>Status: <span class="badge bg-info">{{ $order->status }}</span></p>
                    <p>Grand Amount: <strong>${{ number_format($order->grand_total, 2) }}</strong></p>
                    <h6>Item Detail:</h6>
                    <ul class="list-group">
                        @foreach ($order->items as $item)
                        
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $item->name }}
                            <span class="badge bg-primary rounded-pill">
                                {{ $item->pivot->quantity }} x ${{ number_format($item->pivot->price, 2) }}
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $item->description }}
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <p>Total Amount: <strong>{{ $item->pivot->quantity }} x ${{ number_format($item->pivot->price, 2) }}</strong></p>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <p>Delivery Fee: <strong> {{ number_format($order->delivery_fee, 2) }}</strong></p>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <p>packing Fee: <strong> {{ number_format($order->packing_fee, 2) }}</strong></p>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    @endforeach
@else
<div class="card mb-4">
    <div class="card-body">
        No Record Found
    </div>
</div>
@endif

    <!-- Pagination Links -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-center">
                {{ $customers->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>

</div>
@endsection
