<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Requests\CategoryDeleteRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {   
        $categories = auth()->user()->categories()->withCount('todos')->get();
        return view('category', compact('categories'));
    }

    public function store(CategoryStoreRequest $request)
    {
        auth()->user()->categories()->create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('message', 'カテゴリーを追加しました。');
    }

    public function update(CategoryUpdateRequest $request)
    {
        $category = auth()->user()->categories()->findOrFail($request->id);
        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('message', 'カテゴリーを更新しました。');
    }

    public function destroy(CategoryDeleteRequest $request)
    {
        $category = auth()->user()->categories()->findOrFail($request->id);
        $category->delete();

        return redirect()->back()->with('message', 'カテゴリーを削除しました。');
    }
}
