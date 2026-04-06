@extends('layouts.app')

@section('content')
<div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md" x-data="{ loading: false }">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Buat Akun Baru</h2>
    
    <form method="POST" action="{{ route('register') }}" @submit="loading = true">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}" 
                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror" 
                   placeholder="Masukkan nama Anda" required autofocus>
            @error('name') 
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span> 
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Alamat Email</label>
            <input type="email" name="email" value="{{ old('email') }}" 
                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror" 
                   placeholder="email@contoh.com" required>
            @error('email') 
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span> 
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
            <input type="password" name="password" 
                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror" 
                   placeholder="Minimal 8 karakter" required>
            @error('password') 
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span> 
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" 
                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                   placeholder="Ulangi password" required>
        </div>

        <button type="submit" 
                class="w-full bg-green-600 text-white font-bold py-2 rounded-lg hover:bg-green-700 transition flex items-center justify-center" 
                x-bind:disabled="loading">
            <template x-if="!loading">
                <span>Daftar Sekarang</span>
            </template>
            <template x-if="loading">
                <span class="flex items-center">
                    <svg class="animate-spin h-5 w-5 mr-2 text-white" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Memproses...
                </span>
            </template>
        </button>

        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login di sini</a>
            </p>
        </div>
    </form>
</div>
@endsection