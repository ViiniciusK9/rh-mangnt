<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RhUserController extends Controller
{
    public function index()
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page.');

        $colaborators = User::where('role', 'rh')->get();

        return view('rh.colaborators.index', compact('colaborators'));
    }

    public function create()
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page.');

        $departments = Department::all();

        return view('rh.colaborators.create', compact('departments'));
    }

    public function store(Request $request)
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page.');

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'select_department' => 'required|exists:departments,id',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'zip_code' => 'required|string|max:10',
            'city' => 'required|string|max:50',
            'salary' => 'required|decimal:2',
            'admission_date' => 'required|date_format:Y-m-d',
        ]);

        if ($request->select_department != 2) {
            return redirect()->route('home');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'rh',
            'department_id' => $request->select_department,
            'permissions' => json_encode(['rh']),
        ]);

        $user->detail()->create([
            'address' => $request->address,
            'phone' => $request->phone,
            'zip_code' => $request->zip_code,
            'city' => $request->city,
            'salary' => $request->salary,
            'admission_date' => $request->admission_date,
        ]);

        return redirect()->route('rh.colaborators')->with('success', 'Colaborator created successfully.');
    }
}
