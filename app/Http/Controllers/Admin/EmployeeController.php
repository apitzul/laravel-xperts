<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function create()
{
    return view('admin.employees.create');
}
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'position' => 'nullable|string|max:255',
            'company_id' => 'nullable|exists:companies,id',
        ]);

Employee::create([
    'first_name' => $request->first_name,
    'last_name' => $request->last_name,
    'email' => $request->email,
    'phone' => $request->phone,
    'position' => $request->position,
    'company_id' => $request->company_id,
]);

        return redirect()->route('admin.employees.index')
            ->with('success', 'Employee created successfully');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('admin.employees.index')
            ->with('success', 'Employee deleted successfully');
    }

    public function edit(Employee $employee)
    {
        return view('admin.employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|email|max:255',
            'email' => 'nullable|email|max:255',
            'position' => 'nullable|string|max:255',
            'company_id' => 'nullable|exists:companies,id',
        ]);
$employee->update([
    'first_name' => $request->first_name,
    'last_name' => $request->last_name,
    'email' => $request->email,
    'phone' => $request->phone,
    'position' => $request->position,
    'company_id' => $request->company_id,
]);

        return redirect()->route('admin.employees.index')
            ->with('success', 'Employee updated successfully');
    }
}
