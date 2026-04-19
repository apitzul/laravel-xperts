<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::paginate(10);
        return response()->json($companies);
        //return view('admin.companies.index', compact('companies'));
    }
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'nullable|string|max:255',
        'website' => 'nullable|string|max:255',
        'email' => 'nullable|email|max:255',
        'logo' => 'nullable|image|max:2048',
    ]);

    $logoPath = null;

    if ($request->hasFile('logo')) {
        $logoPath = $request->file('logo')->store('companies', 'public');
    }

    Company::create([
        'name' => $request->name,
        'address' => $request->address,
        'website' => $request->website,
        'email' => $request->email,
        'logo' => $logoPath,
    ]);

    return redirect()->route('admin.companies.index');
}
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('admin.companies.index')
            ->with('success', 'Company deleted successfully');
    }


    public function edit(Company $company)
    {
        return view('admin.companies.edit', compact('company'));
    }

   public function update(Request $request, Company $company)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'nullable|string|max:255',
        'website' => 'nullable|string|max:255',
        'email' => 'nullable|email|max:255',
        'logo' => 'nullable|image|max:2048',
    ]);

    $logoPath = $company->logo;

    if ($request->hasFile('logo')) {
        $logoPath = $request->file('logo')->store('companies', 'public');
    }

    $company->update([
        'name' => $request->name,
        'address' => $request->address,
        'website' => $request->website,
        'email' => $request->email,
        'logo' => $logoPath,
    ]);

    return redirect()->route('admin.companies.index');
}

//show list ofg employees

public function show($id)
{
    try {
        $company = Company::with('employees')
            ->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $company->id,
                'name' => $company->name,
                'employees' => $company->employees,
                'employee_count' => $company->employees->count(),
            ]
        ]);

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Company not found'
        ], 404);

    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Something went wrong',
            'error' => $e->getMessage() // remove in production if needed
        ], 500);
    }
}
}
