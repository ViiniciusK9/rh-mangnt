<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    public function index(): View
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page.');

        $departments = Department::all();
        return view('department.index', compact('departments'));
    }

    public function create(): View
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page.');

        return view('department.create');
    }

    public function store(Request $request)
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page.');

        $request->validate([
            'id' => 'integer',
            'name' => 'required|string|min:3|max:50|unique:departments',
        ]);

        if ($request->id) {
            $department = Department::findOrFail($request->id);
            $department->update($request->all());
            return redirect()->route('departments')->with('success', 'Department updated successfully.');
        }

        Department::create($request->all());
        
        return redirect()->route('departments')->with('success', 'Department created successfully.');
    }

    public function edit(Department $department): View
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page.');

        return view('department.edit', compact('department'));
    }

    public function delete(Department $department): View
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page.');

        return view('department.delete', compact('department'));
    }

    public function destroy(Request $request)
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page.');

        Department::findOrFail($request->id)->delete();
        
        return redirect()->route('departments')->with('success', 'Department deleted successfully.');
    }
}
