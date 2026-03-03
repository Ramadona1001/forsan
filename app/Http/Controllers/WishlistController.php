<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    public function index()
    {
        $productIds = Session::get('wishlist_products', []);

        // Backward compatibility: check 'wishlist' key and migrate if exists
        if (Session::has('wishlist')) {
            $oldWishlist = Session::get('wishlist', []);
            $productIds = array_unique(array_merge($productIds, $oldWishlist));
            Session::put('wishlist_products', $productIds);
            Session::forget('wishlist');
        }

        $horseIds = Session::get('wishlist_horses', []);
        $serviceIds = Session::get('wishlist_services', []);

        $products = Product::whereIn('id', $productIds)->get();
        $horses = \App\Models\Horse::whereIn('id', $horseIds)->get();
        $services = \App\Models\HorseReview::whereIn('id', $serviceIds)->get();

        return view('wishlist.index', compact('products', 'horses', 'services'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'type' => 'required|in:product,horse,service',
        ]);

        $key = match ($request->type) {
            'product' => 'wishlist_products',
            'horse' => 'wishlist_horses',
            'service' => 'wishlist_services',
            default => 'wishlist_products',
        };
        $ids = Session::get($key, []);

        if (!in_array($request->id, $ids)) {
            $ids[] = $request->id;
            Session::put($key, $ids);
        }

        return redirect()->back()->with('success', 'تم الإضافة للمفضلة بنجاح');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'type' => 'required|in:product,horse,service',
        ]);

        $key = match ($request->type) {
            'product' => 'wishlist_products',
            'horse' => 'wishlist_horses',
            'service' => 'wishlist_services',
            default => 'wishlist_products',
        };
        $ids = Session::get($key, []);

        if (($index = array_search($request->id, $ids)) !== false) {
            unset($ids[$index]);
            Session::put($key, array_values($ids));
        }

        return redirect()->back()->with('success', 'تم الحذف من المفضلة بنجاح');
    }
    public function toggle(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'type' => 'required|in:product,horse,service',
        ]);

        $key = match ($request->type) {
            'product' => 'wishlist_products',
            'horse' => 'wishlist_horses',
            'service' => 'wishlist_services',
            default => 'wishlist_products',
        };
        $ids = Session::get($key, []);
        $action = 'added';
        $message = 'تم الإضافة للمفضلة بنجاح';

        if (($index = array_search($request->id, $ids)) !== false) {
            unset($ids[$index]);
            $ids = array_values($ids);
            $action = 'removed';
            $message = 'تم الحذف من المفضلة بنجاح';
        } else {
            $ids[] = $request->id;
        }

        Session::put($key, $ids);

        $totalCount = count(Session::get('wishlist_products', [])) + count(Session::get('wishlist_horses', [])) + count(Session::get('wishlist_services', []));

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'action' => $action,
                'message' => $message,
                'count' => $totalCount
            ]);
        }

        return redirect()->back()->with('success', $message);
    }
}
