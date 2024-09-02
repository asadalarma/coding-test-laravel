<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search by customer email
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        // Search by order number
        if ($request->filled('order_number')) {
            $query->whereHas('orders', function ($q) use ($request) {
                $q->where('order_number', 'like', '%' . $request->order_number . '%');
            });
        }

        // Search by item name
        if ($request->filled('item_name')) {
            $query->whereHas('orders.items', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->item_name . '%');
            });
        }

          // Eager load orders and items for the results
          $customers = $query->with(['orders.items'])->paginate(10);

          return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function search(Request $request)
    {
        $query = User::query();

        // Search by customer email
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        // Search by order number
        if ($request->filled('order_number')) {
            $query->whereHas('orders', function ($q) use ($request) {
                $q->where('order_number', 'like', '%' . $request->order_number . '%');
            });
        }

        // Search by item name
        if ($request->filled('item_name')) {
            $query->whereHas('orders.items', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->item_name . '%');
            });
        }

          // Eager load orders and items for the results
          $customers = $query->with(['orders.items'])->paginate(10);

          return view('customers.index', compact('customers'));
    }
}
