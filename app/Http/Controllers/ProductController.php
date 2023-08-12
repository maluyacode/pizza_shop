<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category'])->get();
        return response()->json($products);
    }

    public function create()
    {
        $categories = Category::pluck('name', 'id');

        return response()->json($categories);
    }

    public function update()
    {
        return view('product.update');
    }

    public function storeMedia(Request $request)
    {
        $path = storage_path("product/images");
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
        // unlink($path);
    }

    public function productEdit($id)
    {
        $product = Product::find($id);
        return view('product.edit', compact('product'));
    }

    public function productStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'detail' => 'required',
            'img_path' => 'required'
        ]);

        $product = new Product();

        if ($request->file()) {
            $fileName = time() . '_' . $request->file('img_path')->getClientOriginalName();

            $path = Storage::putFileAs('public/images', $request->file('img_path'), $fileName);
            $product->img_path = '/storage/images/' . $fileName;
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->detail = $request->detail;
        $product->img_path = $request->img_path;
        $product->save();

        return redirect('datatables/product');
    }

    public function productUpdate(Request $request, $id)
    {
        $product = product::find($id);
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'detail' => 'required',
            'img_path' => 'required'
        ]);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->detail = $request->detail;
        $product->img_path = $request->img_path;
        $product->save();

        return redirect()->route('product.datatable');
    }

    public function productDelete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('datatables/product');
    }
}
