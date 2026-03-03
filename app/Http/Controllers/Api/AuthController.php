<?php

namespace App\Http\Controllers\Api;

use App\Enums\UserType;
use App\Models\Address;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Wishlist;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends BaseController
{
    public function register(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'type' => ['nullable', 'string', 'in:' . implode(',', UserType::values())],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
            'type' => $validated['type'] ?? UserType::CUSTOMER->value,
        ]);

        // Create wallet
        Wallet::create(['user_id' => $user->id]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->success([
            'user' => $user,
            'token' => $token,
        ], 'تم التسجيل بنجاح', 201);
    }

    public function login(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($validated)) {
            return $this->error('بيانات الدخول غير صحيحة', 401);
        }

        $user = Auth::user();

        if (!$user->is_active) {
            return $this->error('حسابك غير مفعل', 403);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->success([
            'user' => $user,
            'token' => $token,
        ], 'تم تسجيل الدخول بنجاح');
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return $this->success(null, 'تم تسجيل الخروج بنجاح');
    }

    public function user(Request $request): JsonResponse
    {
        $user = $request->user()->load(['wallet', 'addresses']);

        return $this->success($user);
    }

    public function updateProfile(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'bio' => ['nullable', 'string', 'max:1000'],
        ]);

        $request->user()->update($validated);

        return $this->success($request->user(), 'تم تحديث الملف الشخصي بنجاح');
    }

    public function forgotPassword(Request $request): JsonResponse
    {
        $request->validate(['email' => ['required', 'email']]);

        // TODO: Implement password reset logic

        return $this->success(null, 'تم إرسال رابط استعادة كلمة المرور إلى بريدك الإلكتروني');
    }

    public function addresses(Request $request): JsonResponse
    {
        $addresses = $request->user()->addresses;

        return $this->success($addresses);
    }

    public function storeAddress(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:100'],
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:20'],
            'address_line_1' => ['required', 'string', 'max:500'],
            'address_line_2' => ['nullable', 'string', 'max:500'],
            'city' => ['required', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'country' => ['required', 'string', 'max:100'],
            'is_default' => ['boolean'],
        ]);

        $address = $request->user()->addresses()->create($validated);

        if ($validated['is_default'] ?? false) {
            $address->setAsDefault();
        }

        return $this->success($address, 'تم إضافة العنوان بنجاح', 201);
    }

    public function updateAddress(Request $request, Address $address): JsonResponse
    {
        if ($address->user_id !== $request->user()->id) {
            return $this->error('غير مصرح', 403);
        }

        $validated = $request->validate([
            'title' => ['sometimes', 'string', 'max:100'],
            'first_name' => ['sometimes', 'string', 'max:100'],
            'last_name' => ['sometimes', 'string', 'max:100'],
            'phone' => ['sometimes', 'string', 'max:20'],
            'address_line_1' => ['sometimes', 'string', 'max:500'],
            'address_line_2' => ['nullable', 'string', 'max:500'],
            'city' => ['sometimes', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'country' => ['sometimes', 'string', 'max:100'],
            'is_default' => ['boolean'],
        ]);

        $address->update($validated);

        if ($validated['is_default'] ?? false) {
            $address->setAsDefault();
        }

        return $this->success($address, 'تم تحديث العنوان بنجاح');
    }

    public function deleteAddress(Request $request, Address $address): JsonResponse
    {
        if ($address->user_id !== $request->user()->id) {
            return $this->error('غير مصرح', 403);
        }

        $address->delete();

        return $this->success(null, 'تم حذف العنوان بنجاح');
    }

    public function wallet(Request $request): JsonResponse
    {
        $wallet = $request->user()->wallet()->with('transactions')->first();

        return $this->success($wallet);
    }

    public function wishlist(Request $request): JsonResponse
    {
        $wishlist = Wishlist::where('user_id', $request->user()->id)
            ->with('wishlistable')
            ->get();

        return $this->success($wishlist);
    }

    public function addToWishlist(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'type' => ['required', 'in:product,horse,service'],
            'id' => ['required', 'integer'],
        ]);

        $modelMap = [
            'product' => \App\Models\Product::class,
            'horse' => \App\Models\Horse::class,
            'service' => \App\Models\Service::class,
        ];

        Wishlist::firstOrCreate([
            'user_id' => $request->user()->id,
            'wishlistable_type' => $modelMap[$validated['type']],
            'wishlistable_id' => $validated['id'],
        ]);

        return $this->success(null, 'تم الإضافة للمفضلة');
    }

    public function removeFromWishlist(Request $request, int $id): JsonResponse
    {
        Wishlist::where('user_id', $request->user()->id)
            ->where('id', $id)
            ->delete();

        return $this->success(null, 'تم الإزالة من المفضلة');
    }

    public function notifications(Request $request): JsonResponse
    {
        $notifications = $request->user()->notifications()->paginate(20);

        return $this->paginated($notifications);
    }
}
