@extends('layouts.app')

@section('title', 'カテゴリー')

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

    <div class = "max-w-2xl mx-auto mt-10">
        <form method = "POST" action = "/categories" class = "mb-5 flex items-center gap-2">
            @csrf
            <input type = "text" name = "name" placeholder = "新しいカテゴリーを追加" class = "border p-2 rounded">
            <button type = "submit" class = "bg-[#000] text-[#fff] px-4 py-2 rounded">作成</button>
        </form>

        <h2 class = "text-xl font-bold mb-4">category</h2>
        <ul>        
            @foreach ($categories as $category)
                <li class = "flex items-center justify-between mb-2">
                    <div>
                        <form method = "POST" action = "/categories/update" class = "inline">
                            @csrf
                            @method('PATCH')
                            <input type = "text" name = "name" value = "{{ $category->name }}" class = "border p-1 rounded">
                            <input type = "hidden" name = "id" value = "{{ $category->id }}">
                            <button type = "submit" class = "bg-[#0000ff] text-[#fff] text-sm px-2 py-1 rounded mr-2">更新</button>
                        </form>
                        <form method = "POST" action = "/categories/delete" class = "inline">
                            @csrf
                            @method('DELETE')
                            <input type = "hidden" name = "id" value = "{{ $category->id }}">
                            <button type = "submit" class = "bg-[#ff0000] text-[#fff] text-sm px-2 py-1 rounded">削除</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>    
    </div>
@endsection