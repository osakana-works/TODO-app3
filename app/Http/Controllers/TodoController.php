<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        $categories = auth()->user()->categories()->withCount('todos')->get();
        $todos = auth()->user()->todos()->with('category')->get();

        return view('index', compact('categories', 'todos'));
    }

    public function store(TodoRequest $request)
    {   
        $validated = $request->validated();

        auth()->user()->todos()->create($validated);
        return redirect()->back()->with('message', 'Todoを追加しました。');
    }

    public function update(TodoRequest $request)
    {
        $validated = $request->validated();

        $todo = auth()->user()->todos()->findOrFail($validated['id']);
        $todo->update($validated);
        return redirect()->back()->with('message', 'Todoを更新しました。');
    }

    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:todos,id',
        ], [
            'id.required' => 'IDは必須です。',
            'id.exists' => '選択されたTodoは存在しません。',
        ]);

        $todo = auth()->user()->todos()->findOrFail($validated['id']);
        $todo->delete();
        return redirect()->back()->with('message', 'Todoを削除しました。');
    }

    public function search(Request $request)
    {
        $todos = auth()->user()->todos()
            ->keywordSearch($request->input('keyword'))
            ->categorySearch($request->input('category_id'))
            ->get();
        $categories = auth()->user()->categories()->withCount('todos')->get();

        return view('index', compact('todos', 'categories'));
    }
}
