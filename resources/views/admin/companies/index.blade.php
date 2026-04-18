@extends('admin.layouts.app')

@section('content')

<div style="background:#fff; padding:20px; border-radius:8px;">

    {{-- Header --}}
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
        <h2>Companies</h2>

        <a href="{{ route('admin.companies.create') }}"
           style="background:#16a34a; color:white; padding:10px 15px; border-radius:6px; text-decoration:none;">
            Create new company
        </a>
    </div>

    {{-- Table Card --}}
    <div style="border:1px solid #ddd; border-radius:6px; overflow:hidden;">

        <div style="background:#f3f4f6; padding:10px 15px; font-weight:bold;">
            Companies list
        </div>

        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#f9fafb;">
                    <th style="text-align:left; padding:10px; border-bottom:1px solid #ddd;">
                    Logo
                </th>
                    <th style="text-align:left; padding:10px; border-bottom:1px solid #ddd;">Name</th>

                    <th style="text-align:left; padding:10px; border-bottom:1px solid #ddd;">Address</th>
                    <th style="text-align:left; padding:10px; border-bottom:1px solid #ddd;">Website</th>
                    <th style="text-align:left; padding:10px; border-bottom:1px solid #ddd;">Email</th>
                    <th style="text-align:left; padding:10px; border-bottom:1px solid #ddd;">Actions</th>
                </tr>
            </thead>

            <tbody>

            @forelse($companies as $company)
                <tr>
                    <td>
                        @if($company->logo)
                           <div style="padding:5px;  display:inline-block; border-radius:8px;">
                                <img src="{{ asset('storage/' . $company->logo) }}"
                                    width="50"
                                    height="50"
                                    style="object-fit:cover; border-radius:6px;">
                            </div>
                        @else
                            -
                        @endif
                    </td>
                    <td style="padding:10px; border-bottom:1px solid #eee;">
                        {{ $company->name }}
                    </td>

                    <td style="padding:10px; border-bottom:1px solid #eee;">
                        {{ $company->address ?? '-' }}
                    </td>

                    <td style="padding:10px; border-bottom:1px solid #eee;">
                        {{ $company->website ?? '-' }}
                    </td>

                    <td style="padding:10px; border-bottom:1px solid #eee;">
                        {{ $company->email ?? '-' }}
                    </td>

                    <td style="padding:10px; border-bottom:1px solid #eee;">
                        <a href="{{ route('admin.companies.edit', $company->id) }}"
                        style="background:#3b82f6; color:white; padding:5px 10px; border-radius:4px; text-decoration:none;">
                            Edit
                        </a>

                        <form action="{{ route('admin.companies.destroy', $company->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                onclick="return confirm('Are you sure you want to delete this company?')"
                                style="background:#dc2626; color:white; padding:5px 10px; border-radius:4px; text-decoration:none; border:none; cursor:pointer;">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="padding:10px; text-align:center;">
                        No companies found
                    </td>
                </tr>
            @endforelse

            </tbody>
        </table>

@if ($companies->hasPages())
    <div style="margin-top:20px; display:flex; justify-content:center;">
        {{ $companies->links('pagination::bootstrap-4') }}
    </div>
@endif
    </div>

</div>

@endsection
