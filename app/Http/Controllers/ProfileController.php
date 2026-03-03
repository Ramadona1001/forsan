<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Conversation;
use App\Models\Horse;
use App\Models\Message;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user()->load(['wallet', 'addresses']);

        return view('profile.index', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:1000',
            'avatar' => 'nullable|image|max:2048', // 2MB max
            'password' => 'nullable|min:8|confirmed',
        ]);

        // Update basic info
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'bio' => $validated['bio'] ?? null,
        ]);

        // Update password if provided
        if (!empty($validated['password'])) {
            $user->update(['password' => bcrypt($validated['password'])]);
        }

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $user->clearMediaCollection('avatar');
            $user->addMediaFromRequest('avatar')
                ->toMediaCollection('avatar');
        }

        return back()->with('success', 'تم تحديث الملف الشخصي بنجاح');
    }

    public function orders()
    {
        $orders = auth()->user()
            ->orders()
            ->with('items.product:id,name')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('profile.orders', compact('orders'));
    }

    public function orderShow($orderId)
    {
        $order = auth()->user()
            ->orders()
            ->with(['items.product.media', 'store:id,name'])
            ->findOrFail($orderId);

        return view('profile.order-show', compact('order'));
    }

    public function bookings(Request $request)
    {
        $query = auth()->user()
            ->bookings()
            ->with(['bookable', 'horse', 'package']);

        // Filter by status if provided
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('profile.bookings', compact('bookings'));
    }

    public function bookingShow($bookingId)
    {
        $booking = auth()->user()
            ->bookings()
            ->with(['bookable', 'horse'])
            ->findOrFail($bookingId);

        return view('profile.booking-show', compact('booking'));
    }

    public function cancelBooking(Request $request, $bookingId)
    {
        $booking = auth()->user()->bookings()->findOrFail($bookingId);

        if (!$booking->canBeCancelled()) {
            return back()->with('error', 'لا يمكن إلغاء هذا الحجز');
        }

        $booking->cancel($request->input('reason'));

        return back()->with('success', 'تم إلغاء الحجز بنجاح');
    }

    public function horses()
    {
        $horses = auth()->user()
            ->horses()
            ->with('media')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('profile.horses', compact('horses'));
    }

    public function createHorse()
    {
        return view('profile.horse-create');
    }

    public function storeHorse(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'breed' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:50',
            'gender' => 'nullable|in:male,female',
            'birth_date' => 'nullable|date',
            'price' => 'nullable|numeric|min:0',
            'is_for_sale' => 'boolean',
            'is_for_rent' => 'boolean',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:6000',
            'gallery' => 'nullable|array|max:20',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:6000',
        ]);

        $validated['owner_id'] = auth()->id();

        $horse = Horse::create($validated);

        if ($request->hasFile('main_image')) {
            $horse->addMediaFromRequest('main_image')->toMediaCollection('main_image');
        }
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $horse->addMedia($file)->toMediaCollection('gallery');
            }
        }

        return redirect()->route('profile.horses')->with('success', 'تم إضافة الحصان بنجاح');
    }

    public function editHorse(Horse $horse)
    {
        if ($horse->owner_id !== auth()->id()) {
            abort(403);
        }

        return view('profile.horse-edit', compact('horse'));
    }

    public function updateHorse(Request $request, Horse $horse)
    {
        if ($horse->owner_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'breed' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:50',
            'gender' => 'nullable|in:male,female',
            'birth_date' => 'nullable|date',
            'price' => 'nullable|numeric|min:0',
            'is_for_sale' => 'boolean',
            'is_for_rent' => 'boolean',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:6000',
            'gallery' => 'nullable|array|max:20',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:6000',
        ]);

        $horse->update($validated);

        if ($request->hasFile('main_image')) {
            $horse->clearMediaCollection('main_image');
            $horse->addMediaFromRequest('main_image')->toMediaCollection('main_image');
        }
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $horse->addMedia($file)->toMediaCollection('gallery');
            }
        }

        return back()->with('success', 'تم تحديث بيانات الحصان بنجاح');
    }

    public function deleteHorse(Horse $horse)
    {
        if ($horse->owner_id !== auth()->id()) {
            abort(403);
        }

        $horse->delete();

        return redirect()->route('profile.horses')->with('success', 'تم حذف الحصان بنجاح');
    }

    public function wallet()
    {
        $wallet = auth()->user()->wallet()->with('transactions')->first();

        return view('profile.wallet', compact('wallet'));
    }

    public function addresses()
    {
        $addresses = auth()->user()->addresses;

        return view('profile.addresses', compact('addresses'));
    }

    public function storeAddress(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:100',
            'street' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'is_default' => 'boolean',
        ]);

        // If is_default is checked, unset all other default addresses
        if ($request->has('is_default')) {
            auth()->user()->addresses()->update(['is_default' => false]);
            $validated['is_default'] = true;
        }

        $address = auth()->user()->addresses()->create($validated);

        return back()->with('success', 'تم إضافة العنوان بنجاح');
    }

    public function updateAddress(Request $request, Address $address)
    {
        if ($address->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'type' => 'required|string|max:100',
            'street' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
        ]);

        $address->update($validated);

        return back()->with('success', 'تم تحديث العنوان بنجاح');
    }

    public function deleteAddress(Address $address)
    {
        if ($address->user_id !== auth()->id()) {
            abort(403);
        }

        $address->delete();

        return back()->with('success', 'تم حذف العنوان بنجاح');
    }

    public function setDefaultAddress(Address $address)
    {
        if ($address->user_id !== auth()->id()) {
            abort(403);
        }

        // Unset all default addresses for this user
        auth()->user()->addresses()->update(['is_default' => false]);

        // Set this address as default
        $address->update(['is_default' => true]);

        return response()->json(['success' => true]);
    }

    public function wishlist()
    {
        $wishlist = Wishlist::where('user_id', auth()->id())
            ->with('wishlistable')
            ->get();

        return view('profile.wishlist', compact('wishlist'));
    }

    public function addToWishlist(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:product,horse,service,horse_review',
            'id' => 'required|integer',
        ]);

        $modelMap = [
            'product' => \App\Models\Product::class,
            'horse' => \App\Models\Horse::class,
            'horse_review' => \App\Models\HorseReview::class,
        ];

        Wishlist::firstOrCreate([
            'user_id' => auth()->id(),
            'wishlistable_type' => $modelMap[$validated['type']],
            'wishlistable_id' => $validated['id'],
        ]);

        return back()->with('success', 'تم الإضافة للمفضلة');
    }

    public function removeFromWishlist($id)
    {
        Wishlist::where('user_id', auth()->id())->where('id', $id)->delete();

        return back()->with('success', 'تم الإزالة من المفضلة');
    }

    public function conversations()
    {
        $userId = auth()->id();
        $conversations = Conversation::where('user_one_id', $userId)
            ->orWhere('user_two_id', $userId)
            ->with(['userOne', 'userTwo', 'latestMessage'])
            ->get()
            ->sortByDesc(function ($conversation) {
                return $conversation->latestMessage ? $conversation->latestMessage->created_at : $conversation->created_at;
            });

        $userTypes = \App\Enums\UserType::cases();

        return view('profile.conversations', compact('conversations', 'userTypes'));
    }

    public function getMessages(Conversation $conversation)
    {
        // Check authorization
        if ($conversation->user_one_id !== auth()->id() && $conversation->user_two_id !== auth()->id()) {
            abort(403);
        }

        // Mark unread messages as read
        $conversation->messages()
            ->where('sender_id', '!=', auth()->id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = $conversation->messages()->with('sender')->get();
        $otherUser = $conversation->getOtherParticipant(auth()->user());

        return response()->json([
            'messages' => $messages,
            'otherUser' => [
                'id' => $otherUser->id,
                'name' => $otherUser->name,
                'avatar_url' => $otherUser->getFirstMediaUrl('avatar') ?: asset('images/icons/user.webp'),
                'status' => 'online'
            ],
            'currentUser' => auth()->user()
        ]);
    }

    public function sendMessage(Request $request, Conversation $conversation)
    {
        // Check authorization
        if ($conversation->user_one_id !== auth()->id() && $conversation->user_two_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'message' => 'required|string',
        ]);

        $message = $conversation->messages()->create([
            'sender_id' => auth()->id(),
            'content' => $validated['message'],
        ]);

        return response()->json([
            'success' => true,
            'message' => $message->load('sender')
        ]);
    }

    public function searchUsers(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string',
            'query' => 'nullable|string|min:1',
        ]);

        $users = \App\Models\User::where('type', $validated['type'])
            ->where('id', '!=', auth()->id())
            ->where(function ($q) use ($validated) {
                if (!empty($validated['query'])) {
                    $q->where('name', 'like', '%' . $validated['query'] . '%')
                        ->orWhere('email', 'like', '%' . $validated['query'] . '%');
                }
            })
            ->select('id', 'name', 'avatar')
            ->limit(20)
            ->get();

        // Append avatar url manually or via resource
        $users->transform(function ($user) {
            $user->avatar_url = $user->getFirstMediaUrl('avatar') ?: asset('images/icons/user.webp');
            return $user;
        });

        return response()->json($users);
    }

    public function startConversation(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $targetUserId = $validated['user_id'];
        $authUserId = auth()->id();

        if ($targetUserId == $authUserId) {
            return response()->json(['error' => 'لا يمكنك بدء محادثة مع نفسك'], 422);
        }

        // Check if exists
        $conversation = Conversation::where(function ($q) use ($authUserId, $targetUserId) {
            $q->where('user_one_id', $authUserId)->where('user_two_id', $targetUserId);
        })->orWhere(function ($q) use ($authUserId, $targetUserId) {
            $q->where('user_one_id', $targetUserId)->where('user_two_id', $authUserId);
        })->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'user_one_id' => $authUserId,
                'user_two_id' => $targetUserId,
            ]);
        }

        return response()->json(['conversation_id' => $conversation->id]);
    }
}
