@extends('layouts.app')

@section('title', 'Todo')
@section('content')
    @if (session('message'))
        <div class = "bg-[#d1e7dd] text-[#0f5132] border border-[#badbcc] p-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    @if ($errors->any())
        <div class = "bg-[#f8d7da] text-[#842029] border border-[#f5c2c7] p-2 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
        </div>
    @endif

    <h1 class = "text-2xl font-bold mb-4">新規作成</h1>
    <form method = "POST" action = "/todos" class = "mb-5">
        @csrf
        <input type = "text" name = "content" placeholder = "Todoを入力" class = "border p-2 w-full rounded">
        <select name = "category_id" class = "border p-2 w-full rounded mt-2">
            <option value = "">カテゴリーを選択</option>
            @foreach ($categories as $category)
                <option value = "{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <button type = "submit" class = "bg-[#000] text-[#fff] px-4 py-2 mt-2 rounded">作成</button>
    </form>
    <h1 class = "text-2xl font-bold mb-4">検索</h1>
    <form method = "GET" action = "/todos/search" class = "mb-5">
        <input type = "text" name = "keyword" placeholder = "キーワードを入力" class = "border p-2 w-full rounded">
        <select name = "category_id" class = "border p-2 w-full rounded mt-2">
            <option value = "">カテゴリーを選択</option>
            @foreach ($categories as $category)
                <option value = "{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <button type = "submit" class = "bg-[#000] text-[#fff] px-4 py-2 mt-2 rounded">検索</button>
    </form>
    <h1 class = "text-2xl font-bold mb-4">Todo List</h1>
    <ul>
        @foreach ($todos as $todo)
            <li class = "mb-2">
                <div class = "grid grid-cols-[350px_150px_80px_80px] items-center gap-3">
                    <form method = "POST" action = "/todos/update" class = "contents">
                        @csrf
                        @method('PATCH')
                        <input type = "text" name = "content" value = "{{ $todo->content }}" 
                            class = "border p-1 rounded w-full">

                        <p class = "text-sm text-gray-600 truncate">{{ $todo->category->name }}</p>

                        <button type = "submit" 
                            class = "bg-[#0000ff] text-[#fff] text-sm px-2 py-1 rounded w-full">
                            更新
                        </button>
                    </form>

                    <form method = "POST" action = "/todos/delete" class = "contents">
                        @csrf
                        @method('DELETE')
                        <input type = "hidden" name = "id" value = "{{ $todo->id }}">
                        <button type = "submit" 
                            class = "bg-[#ff0000] text-[#fff] text-sm px-2 py-1 rounded w-full">
                            削除
                        </button>
                    </form>
                </div>
            </li>

        @endforeach
    </ul>
@endsection