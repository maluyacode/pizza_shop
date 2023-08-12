<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Storage;

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
        $category->save();
        return response()->json($category);
        // return view('category.update');
    }

    public function destroy($id)
    {
        Category::destroy($id);
        // return back();
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


    // public function categoryEdit($id){
    //     $category = Category::find($id);
    //     return view('category.edit',compact('category'));
    // }
}

//     public function categoryStore(Request $request){
//         $request->validate([
//         'name' => 'required',
//         'detail' => 'required',
//         'img_path' => 'required'
//     ]);
//         $category = new Category();
//     $category->name = $request->name;
//     $category->detail = $request->detail;
//     $category->img_path = $request->img_path;

//     if($request->file()) {
//         $fileName = time().'_'.$request->file('img_path')->getClientOriginalName();

//         $path = Storage::putFileAs('public/images', $request->file('img_path'), $fileName);
//         $category->img_path = '/storage/images/' . $fileName;}
//     $category->save();

//     return redirect('datatables/category');
//     }

//     public function categoryUpdate(Request $request, $id){
//         $category = category::find($id);
//           $request->validate([
//         'name' => 'required',
//         'detail' => 'required',
//         'img_path' => 'required'
//           ]);

//         $category->name = $request->name;
//         $category->detail = $request->detail;
//         $category->img_path = $request->img_path;
//         $category->save();

//     return redirect()->route('category.datatable');
//     }

//     public function categoryDelete($id)
//     {
//         $category = Category::find($id);
//         $category->delete();
//         return redirect('datatables/category');
//     }
// }
