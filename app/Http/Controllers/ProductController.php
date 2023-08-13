<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Stock;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'media', 'stock'])->get();
        return response()->json($products);
    }

    public function create()
    {
        $categories = Category::pluck('name', 'id');

        return response()->json($categories);
    }

    public function update(Request $request, $id)
    {;
        // $request->validate([
        //     'name' => 'required',
        //     'price' => 'required',
        //     'detail' => 'required',
        //     'img_path' => 'required'
        // ]);
        Debugbar::info($request);
        // Debugbar::info($request, $id);
        $product = Product::with(['stock'])->find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->detail = $request->detail;
        $product->category_id = $request->category_id;
        $product->img_path = 'Wala na po';

        if ($request->document !== null) {
            DB::table('media')->where('model_type', 'App\Models\Product')->where('model_id', $id)->delete();
            foreach ($request->input("document", []) as $file) {
                $product->addMedia(storage_path("product/images/" . $file))->toMediaCollection("images");
            }
        }
        $product->save();


        $stock = Stock::where('product_id', $product->id)->first();
        Debugbar::info($stock);

        if (!$stock) {
            $stock = new Stock;
            $stock->product_id = $product->id;
            $stock->quantity = $request->stock;
            $stock->save();
        } else {
            $stock->quantity = $request->stock;
            $stock->save();
        }

        return response()->json($product);
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

    public function edit($id)
    {
        Debugbar::info($id);
        $product = Product::with(['category', 'stock'])->find($id);
        $categories = Category::whereNotIn('id', [$product->category_id])->pluck('name', 'id');

        return response()->json(['product' => $product, 'categories' => $categories]);
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


        $stock = new Stock;
        $stock->product_id = $product->id;
        $stock->quantity = $request->stock;
        $stock->save();

        return response()->json($product);
    }

    public function destroy($id)
    {
        Product::destroy($id);
        DB::table('media')->where('model_type', 'App\Model\Product')->where('model_id', $id)->delete();
        return response()->json([]);
    }
    public function import(Request $request){
        Excel::import(new ProductImport, $request->excel);
        return redirect()->route('product.index');
    }
}
