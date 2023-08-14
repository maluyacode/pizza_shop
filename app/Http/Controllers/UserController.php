<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UserImport;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::with(['media'])->whereNot('id', Auth::user()->id)->get());
    }

    public function create()
    {
    }

    public function storeMedia(Request $request)
    {
        $path = storage_path("user/images");
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file("file");
        $name = uniqid() . "_" . trim($file->getClientOriginalName());
        $file->move($path, $name);

        return response()->json([
            "name" => $name,
            "original_name" => $file->getClientOriginalName(),
        ]);
    }

    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);

        if ($request->document !== null) {
            foreach ($request->input("document", []) as $file) {
                $user->addMedia(storage_path("user/images/" . $file))->toMediaCollection("images");
            }
        }

        $user->save();

        return response()->json($user);
    }

    public function edit($id)
    {
        return response()->json(User::with(['media'])->find($id));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->role = $request->role;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        if ($request->document !== null) {
            DB::table('media')->where('model_type', 'App\Models\User')->where('model_id', $id)->delete();
            foreach ($request->input("document", []) as $file) {
                $user->addMedia(storage_path("user/images/" . $file))->toMediaCollection("images");
            }
        }

        $user->save();

        return response()->json($user);
    }

    public function destroy($id)
    {
        User::destroy($id);
        return response()->json([]);
    }
    public function import(Request $request)
    {
        Excel::import(new UserImport, $request->excel);
        return redirect()->route('user.index');
    }

    public function profile()
    {
        return View::make('user.profile', [
            'user' => Auth::user(),
        ]);
    }

    public function orders()
    {
        return View::make('user.orders', [
            'orders' => Order::with(['products'])->paginate(8),
        ]);
    }

    public function vieworder($id)
    {
        // Debugbar::info($id);
        return response()->json(['orders' => Order::with(['products.media', 'products'])->find($id)]);
    }
}
