@extends('admin.layouts.app')

@section('content')

<div style="background:#fff; padding:20px; border-radius:8px; max-width:700px;">

    <h2 style="margin-bottom:20px;">Add Employee</h2>

    <form method="POST" action="{{ route('admin.employees.store') }}">
        @csrf

        {{-- First Name --}}
<div style="margin-bottom:15px;">
    <label>First Name</label><br>
    <input type="text" name="first_name"
           style="width:100%; padding:8px; border:1px solid #ccc; border-radius:5px;"
           required>
</div>
{{-- Last Name --}}
<div style="margin-bottom:15px;">
    <label>Last Name</label><br>
    <input type="text" name="last_name"
           style="width:100%; padding:8px; border:1px solid #ccc; border-radius:5px;"
           required>
</div>
<div style="margin-bottom:15px;">
    <label>Phone</label><br>
    <input type="text" name="phone"
           style="width:100%; padding:8px; border:1px solid #ccc; border-radius:5px;">
</div>
        {{-- Email --}}
        <div style="margin-bottom:15px;">
            <label>Email</label><br>
            <input type="email" name="email"
                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:5px;">
        </div>

        {{-- Position --}}
        <div style="margin-bottom:15px;">
            <label>Position</label><br>
            <input type="text" name="position"
                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:5px;">
        </div>

        {{-- Company --}}
        <div style="margin-bottom:15px;">
            <label>Company</label><br>
            <select name="company_id"
                    style="width:100%; padding:8px; border:1px solid #ccc; border-radius:5px;">
                <option value="">-- Select Company --</option>

                @foreach(\App\Models\Company::all() as $company)
                    <option value="{{ $company->id }}">
                        {{ $company->name }}
                    </option>
                @endforeach

            </select>
        </div>

        {{-- Button --}}
        <button type="submit"
                style="background:#16a34a; color:white; padding:10px 15px; border:none; border-radius:6px;">
            Save Employee
        </button>

    </form>

</div>

@endsection
