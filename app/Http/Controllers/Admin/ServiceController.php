<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $this->authorize('viewAny', Service::class);

        $query = Service::with(['category', 'provider'])->latest();

        if (Auth::user()->hasRole('service_provider') && ! Auth::user()->isAdmin()) {
            $query->where('provider_id', Auth::id());
        }

        $services = $query->paginate(15);

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $this->authorize('create', Service::class);

        $categories = Category::ofTypeService()->active()->pluck('name', 'id');

        return view('admin.services.create', compact('categories'));
    }

    public function store(ServiceRequest $request)
    {
        $this->authorize('create', Service::class);

        $data = $request->validated();
        $data['provider_id'] = $data['provider_id'] ?? Auth::id();

        $service = Service::create($data);

        if ($request->hasFile('image')) {
            $service->addMediaFromRequest('image')->toMediaCollection('image');
        }

        return redirect()
            ->route('admin.services.index')
            ->with('success', __('Service created successfully.'));
    }

    public function show(Service $service)
    {
        $this->authorize('view', $service);

        $service->load(['category', 'provider']);

        return view('admin.services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        $this->authorize('update', $service);

        $categories = Category::ofTypeService()->active()->pluck('name', 'id');

        return view('admin.services.edit', compact('service', 'categories'));
    }

    public function update(ServiceRequest $request, Service $service)
    {
        $this->authorize('update', $service);

        $data = $request->validated();

        if (! Auth::user()->isAdmin()) {
            unset($data['provider_id']);
        }

        $service->update($data);

        if ($request->hasFile('image')) {
            $service->clearMediaCollection('image');
            $service->addMediaFromRequest('image')->toMediaCollection('image');
        }

        return redirect()
            ->route('admin.services.index')
            ->with('success', __('Service updated successfully.'));
    }

    public function destroy(Service $service)
    {
        $this->authorize('delete', $service);

        $service->delete();

        return redirect()
            ->route('admin.services.index')
            ->with('success', __('Service deleted successfully.'));
    }
}

