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

        $collaborators = User::with('detail', 'department')
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
}
