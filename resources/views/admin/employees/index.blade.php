@extends('admin.layouts.app')

@section('content')

<div style="background:#fff; padding:20px; border-radius:8px;">

    {{-- Header --}}
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
        <h2>Employees</h2>

        <a href="{{ route('admin.employees.create') }}"
           style="background:#16a34a; color:white; padding:10px 15px; border-radius:6px; text-decoration:none;">
            Add new employee
        </a>
    </div>

    {{-- Table Card --}}
    <div style="border:1px solid #ddd; border-radius:6px; overflow:hidden;">

        <div style="background:#f3f4f6; padding:10px 15px; font-weight:bold;">
            Employees list
        </div>

        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#f9fafb;">
                    <th style="text-align:left; padding:10px; border-bottom:1px solid #ddd;">First Name</th>
                    <th style="text-align:left; padding:10px; border-bottom:1px solid #ddd;">Last Name</th>
                    <th style="text-align:left; padding:10px; border-bottom:1px solid #ddd;">Phone</th>
                    <th style="text-align:left; padding:10px; border-bottom:1px solid #ddd;">Email</th>
                    <th style="text-align:left; padding:10px; border-bottom:1px solid #ddd;">Position</th>
                    <th style="text-align:left; padding:10px; border-bottom:1px solid #ddd;">Company</th>
                    <th style="text-align:left; padding:10px; border-bottom:1px solid #ddd;">Actions</th>
                </tr>
            </thead>

            <tbody>

            @forelse($employees as $employee)
                <tr>
                    <td style="padding:10px; border-bottom:1px solid #eee;">
                        {{ $employee->first_name }}
                    </td>
                    <td style="padding:10px; border-bottom:1px solid #eee;">
                        {{ $employee->last_name }}
                    </td>
                    </td>
                    <td style="padding:10px; border-bottom:1px solid #eee;">
                        {{ $employee->phone ?? '-' }}
                    </td>
                    <td style="padding:10px; border-bottom:1px solid #eee;">
                        {{ $employee->email ?? '-' }}
                    </td>

                    <td style="padding:10px; border-bottom:1px solid #eee;">
                        {{ $employee->position ?? '-' }}
                    </td>

                    <td style="padding:10px; border-bottom:1px solid #eee;">
                        {{ $employee->company->name ?? '-' }}
                    </td>

                    <td style="padding:10px; border-bottom:1px solid #eee;">

                        <a href="{{ route('admin.employees.edit', $employee->id) }}"
                           style="background:#3b82f6; color:white; padding:5px 10px; border-radius:4px; text-decoration:none;">
                            Edit
                        </a>

                        <form action="{{ route('admin.employees.destroy', $employee->id) }}"
                              method="POST"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                onclick="return confirm('Are you sure you want to delete this employee?')"
                                style="background:#dc2626; color:white; padding:5px 10px; border-radius:4px; border:none; cursor:pointer;">
                                Delete
                            </button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="padding:10px; text-align:center;">
                        No employees found
                    </td>
                </tr>
            @endforelse

            </tbody>
        </table>
@if ($employees->hasPages())
    <div style="margin-top:20px; display:flex; justify-content:center;">
        {{ $employees->links('pagination::bootstrap-4') }}
    </div>
@endif
    </div>

</div>

@endsection
