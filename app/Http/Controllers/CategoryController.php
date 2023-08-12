<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::with('products')->get();
        return response()->json($category);
    }

    public function create()
    {
        return view('category.create');
    }

    public function update()
    {
        return view('category.update');
    }

    public function categoryEdit($id){
        $category = Category::find($id);
        return view('category.edit',compact('category'));
    }
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
