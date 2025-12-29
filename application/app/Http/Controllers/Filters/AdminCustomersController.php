<?php

namespace App\Http\Controllers\Filters;

use App\Http\Controllers\Controller;
use App\Helpers\MockDataHelper;
use Illuminate\Http\Request;

class AdminCustomersController extends Controller
{
    public function index(Request $request)
    {
        $customers = MockDataHelper::getMockCustomers();

        // Apply filters
        if ($request->filled('customer_name')) {
            $searchTerm = $request->customer_name;
            $customers = $customers->filter(function($customer) use ($searchTerm) {
                $name = MockDataHelper::getCustomerName($customer);
                return stripos($name, $searchTerm) !== false ||
                       stripos($customer['phone'] ?? '', $searchTerm) !== false ||
                       stripos($customer['first_name'] ?? '', $searchTerm) !== false ||
                       stripos($customer['last_name'] ?? '', $searchTerm) !== false ||
                       stripos($customer['brand_name'] ?? '', $searchTerm) !== false;
            });
        }

        if ($request->filled('customer_email')) {
            $searchTerm = $request->customer_email;
            $customers = $customers->filter(function($customer) use ($searchTerm) {
                return stripos($customer['email'] ?? '', $searchTerm) !== false;
            });
        }

        if ($request->filled('customer_id')) {
            $searchTerm = $request->customer_id;
            $customers = $customers->filter(function($customer) use ($searchTerm) {
                $identifier = MockDataHelper::getCustomerIdentifier($customer);
                return stripos($identifier ?? '', $searchTerm) !== false;
            });
        }

        if ($request->filled('customer_type')) {
            $customers = $customers->where('type', $request->customer_type);
        }

        if ($request->filled('customer_status')) {
            $customers = $customers->where('status', $request->customer_status);
        }

        return view('filters.admin.customers', compact('customers'));
    }
}

