<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile(User $user)
    {
        //        dd($user->id);
        $orders = Order::with('products')->where('user_id', $user->id)->get();
        //        dd($orders);
        //foreach ($orders as $order){
        //    foreach ($order->products as $product){
        //        $products = $product->id;
        //    }
        //
        //}
        //dd($products);

        if (!Auth::user())
            return redirect()->route('home');
        if (Auth::user()->isAdmin() || $user->id == Auth::user()->id)
            return view('profile', compact('user',   'orders'));

        return redirect()->route('home');
    }

    public function save(Request $request)
    {
        $input = request()->all();

        $name = $input['name'];
        $email = $input['email'];
        $userId = $input['userId'];
        $picture = $input['picture'] ?? null;
        $newAddress = $input['new_address'] ?? null;
        $user = User::find($userId);
        //dd($input);
        request()->validate([
            'name' => 'required',
            'email' => "email|required|unique:users,email,{$user->id}",
            'picture' => 'mimetypes:image/*',
            'current_password' => 'current_password|required_with:password|nullable',
            'password' => 'confirmed|min:8|nullable'
        ]);

        if ($request['password']) {
            $user->password = Hash::make($input['password']);
            $user->save();
        }


        Address::where('user_id', $user->id)->update([
            'main' => 0
        ]);

        Address::where('id', $input['main_address'])->update([
            'main' => 1
        ]);

        if ($newAddress && $input['main_address'] == 'on') {
            Address::where('user_id', $user->id)->update([
                'main' => 0
            ]);

            Address::create([
                'user_id' => $user->id,
                'address' => $newAddress,
                'main' => 1
            ]);
        }

        if ($picture) {
            $ext = $picture->getClientOriginalExtension();
            $fileName = time() . rand(10000, 99999) . '.' . $ext;
            $picture->storeAs('public/users', $fileName);
            $user->picture = "public/users/$fileName";
        }

        $user->name = $name;
        $user->email = $email;
        $user->save();
        session()->flash('profileSaved');
        return back();
    }
}
