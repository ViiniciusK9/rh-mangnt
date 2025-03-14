<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollaboratorsController extends Controller
{
    public function index()
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page');

        $collaborators = User::withTrashed()
            ->with('detail', 'department')
            ->where('role', '<>', 'admin')
            ->get();
        
        return view('collaborators.index', compact('collaborators'));
    }

    public function show(User $collaborator)
    {
        Auth::user()->can('admin', 'rh') ?: abort(403, 'You are not authorized to access this page');

        $collaborator->load('detail', 'department');

        return view('collaborators.show', compact('collaborator'));
    }

    public function delete(User $collaborator)
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page');

        return view('collaborators.delete', compact('collaborator'));
    }

    public function destroy()
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page');

        $data = request()->validate([
            'id' => 'required|exists:users,id',
        ]);

        $collaborator = User::find($data['id']);
        $collaborator->delete();

        return redirect()->route('collaborators')->with('success', 'Collaborator deleted successfully');
    }

    public function restore()
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page');

        $data = request()->validate([
            'id' => 'required',
        ]);

        $collaborator = User::withTrashed()->findOrFail($data['id']);
        $collaborator->restore();

        return redirect()->route('collaborators')->with('success', 'Collaborator restored successfully');
    }
}
