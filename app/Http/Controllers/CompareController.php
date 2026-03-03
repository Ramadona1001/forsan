<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CompareController extends Controller
{
    public function index()
    {
        $productIds = Session::get('compare_products', []);
        $horseIds = Session::get('compare_horses', []);
        $serviceIds = Session::get('compare_services', []);

        $products = Product::whereIn('id', $productIds)->get();
        $horses = \App\Models\Horse::whereIn('id', $horseIds)->get();
        $services = \App\Models\HorseReview::whereIn('id', $serviceIds)->get();

        return view('compare.index', compact('products', 'horses', 'services'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'type' => 'required|in:product,horse,service',
        ]);

        $key = match ($request->type) {
            'product' => 'compare_products',
            'horse' => 'compare_horses',
            'service' => 'compare_services',
            default => 'compare_products',
        };
        $ids = Session::get($key, []);

        if (!in_array($request->id, $ids)) {
            $ids[] = $request->id;
            Session::put($key, $ids);
        }

        return back()->with('success', 'تم الإضافة للمقارنة');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'type' => 'required|in:product,horse,service',
        ]);

        $key = match ($request->type) {
            'product' => 'compare_products',
            'horse' => 'compare_horses',
            'service' => 'compare_services',
            default => 'compare_products',
        };
        $ids = Session::get($key, []);

        $index = array_search($request->id, $ids);
        if ($index !== false) {
            unset($ids[$index]);
            Session::put($key, array_values($ids));
        }

        return back()->with('success', 'تم الحذف من المقارنة');
    }
    public function toggle(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'type' => 'required|in:product,horse,service',
        ]);

        $key = match ($request->type) {
            'product' => 'compare_products',
            'horse' => 'compare_horses',
            'service' => 'compare_services',
            default => 'compare_products',
        };
        $ids = Session::get($key, []);
        $action = 'added';
        $message = 'تم الإضافة للمقارنة';

        if (($index = array_search($request->id, $ids)) !== false) {
            unset($ids[$index]);
            $ids = array_values($ids);
            $action = 'removed';
            $message = 'تم الحذف من المقارنة';
        } else {
            $ids[] = $request->id;
        }

        Session::put($key, $ids);

        $totalCount = count(Session::get('compare_products', [])) + count(Session::get('compare_horses', [])) + count(Session::get('compare_services', []));

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'action' => $action,
                'message' => $message,
                'count' => $totalCount
            ]);
        }

        return back()->with('success', $message);
    }
}
