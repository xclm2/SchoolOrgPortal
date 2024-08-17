<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class OrgController extends Component
{
    use WithPagination, WithoutUrlPagination;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin/org-management', ['organizations' => Organization::paginate(1)]);
    }

    /**
     * Show the form for creating a new resource.
     */
//    public function create()
//    {
//        return view('admin/org-management/create');
//    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin/org-management/create', ['id' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
