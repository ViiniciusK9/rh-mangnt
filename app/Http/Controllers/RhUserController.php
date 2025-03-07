<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmAccountEmail;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RhUserController extends Controller
{
    public function index()
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page.');

        $collaborators = User::with('detail')->where('role', 'rh')->get();

        return view('rh.collaborators.index', compact('collaborators'));
    }

    public function create()
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page.');

        $departments = Department::all();

        return view('rh.collaborators.create', compact('departments'));
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

        $token = Str::random(60);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'confirmation_token' => $token,
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

        // send email to user
        Mail::to($user->email)->send(new ConfirmAccountEmail(route('confirm-account', $token)));

        return redirect()->route('rh.collaborators')->with('success', 'Collaborator created successfully.');
    }

    public function update(Request $request)
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page.');

        $request->validate([
            'id' => 'required|exists:users,id',
            'salary' => 'required|decimal:2',
            'admission_date' => 'required|date_format:Y-m-d',
        ]);

        $collaborator = User::find($request->id);

        $collaborator->detail()->update([
            'salary' => $request->salary,
            'admission_date' => $request->admission_date,
        ]);

        return redirect()->route('rh.collaborators')->with('success', 'Collaborator updated successfully.');
    }

    public function edit(User $collaborator)
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page.');

        $collaborator->load('detail');

        return view('rh.collaborators.edit', compact('collaborator'));
    }

    public function delete(User $collaborator)
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page.');

        return view('rh.collaborators.delete', compact('collaborator'));
    }

    public function destroy(Request $request)
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page.');

        User::findOrFail($request->id)->delete();

        return redirect()->route('rh.collaborators')->with('success', 'Collaborator deleted successfully.');
    }
}
