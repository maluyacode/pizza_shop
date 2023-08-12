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

    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'price' => 'required',
        //     'detail' => 'required',
        //     'img_path' => 'required'
        // ]);

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->detail = $request->detail;
        $product->category_id = $request->category_id;
        $product->img_path = 'Wala na po';
        if ($request->document !== null) {
            foreach ($request->input("document", []) as $file) {
                $product->addMedia(storage_path("product/images/" . $file))->toMediaCollection("images");
            }
        }
        $product->save();

        return response()->json($product);
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
