<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index()
    {
        $tenants = Tenant::all();
        return view('superadmin.dashboard', compact('tenants'));
    }

    public function createTenant(Request $request)
    {
        $request->validate([
            'id' => 'required|unique:tenants,id',
            'company_name' => 'required',
            'domain' => 'required|unique:domains,domain',
        ]);

        $tenant = Tenant::create([
            'id' => $request->id,
            'company_name' => $request->company_name,
        ]);

        $tenant->domains()->create(['domain' => $request->domain]);

        return back()->with('success', 'Tenant created successfully.');
    }
}
