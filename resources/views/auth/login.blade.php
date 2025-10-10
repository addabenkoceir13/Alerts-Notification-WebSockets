@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white rounded-xl shadow-md p-6">
        <h2 class="text-2xl font-bold text-center mb-6">تسجيل الدخول</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">البريد الإلكتروني</label>
                <input type="email" name="email" required autofocus
                    class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">كلمة المرور</label>
                <input type="password" name="password" required
                    class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>
            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">دخول</button>
        </form>
    </div>
</div>
@endsection
