<?php

namespace App\Http\Controllers;

use App\Models\Collaboration;
use App\Models\CollaborationRequest;
use Illuminate\Http\Request;

class CollaborationController extends Controller
{
    public function index()
    {
        $collaborations = Collaboration::active()->ordered()->with('media')->get();

        return view('pages.collaboration', compact('collaborations'));
    }

    public function showRequest(string $slug)
    {
        $collaboration = Collaboration::active()->bySlug($slug)->with('media')->firstOrFail();

        return view('pages.collaboration-request', compact('collaboration'));
    }

    public function submitRequest(Request $request, string $slug)
    {
        $collaboration = Collaboration::active()->bySlug($slug)->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|max:2000',
            'terms' => 'accepted',
        ], [], [
            'name' => __('general.collaboration_form.name'),
            'email' => __('general.collaboration_form.email'),
            'phone' => __('general.collaboration_form.phone'),
            'message' => __('general.collaboration_form.message'),
            'terms' => __('general.collaboration_form.terms'),
        ]);

        CollaborationRequest::create([
            'collaboration_id' => $collaboration->id,
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'message' => $validated['message'],
        ]);

        return back()->with('success', true);
    }
}
