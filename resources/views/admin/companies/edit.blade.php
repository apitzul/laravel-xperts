@extends('admin.layouts.app')

@section('content')

<div style="background:#fff; padding:20px; border-radius:8px; max-width:700px;">

    <h2 style="margin-bottom:20px;">Edit Company</h2>

    <form method="POST" action="{{ route('admin.companies.update', $company->id) }}"   enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Name --}}
        <div style="margin-bottom:15px;">
            <label>Company Name</label><br>
            <input type="text" name="name"
                   value="{{ $company->name }}"
                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:5px;"
                   required>
        </div>
        {{-- Logo --}}
        <div style="margin-bottom:15px;">
            <label>Logo</label><br>

            @if($company->logo)
    <div style="margin-bottom:10px;">
        <img src="{{ asset('storage/' . $company->logo) }}"
            width="80"
            height="80"
            style="object-fit:cover; border-radius:6px;">
    </div>
@endif
            <input type="file" name="logo"
                style="width:100%; padding:8px; border:1px solid #ccc; border-radius:5px;">
        </div>
        {{-- Address --}}
        <div style="margin-bottom:15px;">
            <label>Address</label><br>
            <input type="text" name="address"
                   value="{{ $company->address }}"
                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:5px;">
        </div>

        {{-- Website --}}
        <div style="margin-bottom:15px;">
            <label>Website</label><br>
            <input type="text" name="website"
                   value="{{ $company->website }}"
                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:5px;">
        </div>

        {{-- Email --}}
        <div style="margin-bottom:15px;">
            <label>Email</label><br>
            <input type="email" name="email"
                   value="{{ $company->email }}"
                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:5px;">
        </div>

        {{-- Button --}}
        <button type="submit"
                style="background:#3b82f6; color:white; padding:10px 15px; border:none; border-radius:6px;">
            Update Company
        </button>

    </form>

</div>

@endsection
