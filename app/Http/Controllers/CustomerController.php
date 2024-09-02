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
        $customers = $this->searchCriteria($request);
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function search(Request $request)
    {
        
        $customers = $this->searchCriteria($request);
        return view('customers.index', compact('customers'));
    }


    public function searchCriteria($request){
        $query = User::query();

        // Apply search scopes
        if ($request->filled('email')) {
            $query->byEmail($request->email);
        }
    
        if ($request->filled('order_number')) {
            $query->byOrderNumber($request->order_number);
        }
    
        if ($request->filled('item_name')) {
            $query->byItemName($request->item_name);
        }
    
        // Eager load orders and items for the results
        $customers = $query->with(['orders.items'])->paginate(10);

        return $customers;
    }
}
