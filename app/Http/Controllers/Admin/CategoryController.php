<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Category\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class CategoryController extends Controller
{
    const PATH_VIEW = 'Backend.category.';

    const PATH_UPLOAD = 'category';
    public function index(){
        $data = Category::query()
        ->with(['parent', 'children'])
        ->latest('id')->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    public function search(Request $request){
        $search = $request->input('search');
        $parent = $request->input('parent_id');
        $data = Category::where('name', 'like', '%'.$search.'%')
        ->get();

        return view('Backend.category.index', compact('data', 'search'));
    }

    public function create(){
        $parentCategory = Category::query()->with('children')->whereNull('parent_id')->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact('parentCategory'));
    }

    public function store(Request $request){
        $data = $request->except('image');
        $data['is_active'] ??= 0;
        $data['image'] ??= "";

        if($request->hasFile('image')){
            $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
        }

        Category::query()->create($data);

        return redirect()->route('admin.category.index');
    }

    public function show($id){
        $model = Category::query()->findOrFail($id);

        return view(self::PATH_VIEW . __FUNCTION__, compact('model'));
    }

    public function edit($id){
        $model = Category::query()->with('parent')->findOrFail($id);

        return view(self::PATH_VIEW . __FUNCTION__, compact('model'));
    }

    public function update(Request $request, string $id){
        $model = Category::query()->with('parent')->findOrFail($id);
        $data = $request->except('image');
        $data['is_active'] ??= 0;


        if($request->hasFile('image')){
            $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
        }

        $currentImage = $model->image;

        $model->update($data);

        if($request->hasFile('image') &&  $currentImage && $request->exists('image')){
            Storage::delete($currentImage);
        }

        return back();
    }

    public function destroy(string $id){
        $model = Category::query()->with('parent')->findOrFail($id);

        $model->delete();

        if($model->image && Storage::exists($model->image)){
            Storage::delete($model->image);
        }

        return redirect()->route('admin.category.index');
    }
}
