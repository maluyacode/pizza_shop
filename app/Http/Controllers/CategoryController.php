<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::with(['media'])->get();
        return response()->json($category);
    }

    public function create()
    {
        return view('category.create');
    }
    public function store(Request $request)
    {
        $category = new Category;
        $category->name = $request->name;
        $category->detail = $request->detail;
        $category->img_path = "Default";
        if ($request->document !== null) {
            foreach ($request->input("document", []) as $file) {
                $category->addMedia(storage_path("category/images/" . $file))->toMediaCollection("images");
            }
        }
        $category->save();
        // return redirect()->route('author.tables');
        return response()->json($category);
    }

    public function edit(String $id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }

    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->detail = $request->detail;
        $category->img_path = "Edited Default";
        if ($request->document !== null) {
            DB::table('media')->where('model_type', 'App\Models\Category')->where('model_id', $id)->delete();
            foreach ($request->input("document", []) as $file) {
                $category->addMedia(storage_path("category/images/" . $file))->toMediaCollection("images");
            }
        }
        $category->save();
        return response()->json($category);
    }

    public function destroy($id)
    {
        Category::destroy($id);
        return response()->json([]);
    }

    public function storeMedia(Request $request)
    {
        $path = storage_path("category/images");
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
}
