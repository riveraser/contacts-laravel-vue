@extends('layouts.app')

@section('content')
<div class="mx-auto h-full flex justify-center items-center bg-gray-300">
    <div class="w-96 bg-blue-900 rounded-lg shadow-xl p-6">
        <img src="../img/logoSRmedium.png">
        <h1 class="text-white text-3xl pt-8" >Reset password</h1>
        <h2 class="text-blue-300 " >Enter your email to reset your password</h2>
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}" class="pt-8">
            @csrf

            <div class="relative">
                <label for="email" class="uppercase text-blue-500 text-xs font-bold absolute pl-3 pt-3">E-Mail</label>
                <div>
                    <input id="email" type="email" 
                        class="pt-8 w-full rounded p-3 bg-blue-800 text-gray-100 outline-none focus:bg-blue-700"
                        name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="your@email.com"
                    >
                    @error('email')
                    <span class="text-red-600 text-sm pt-1" role="alert">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            
            <div class="pt-8">
                <button type="submit" class="w-full bg-gray-200 py-2 px-3 text-left uppercase rounded text-blue-800 font-bold hover:bg-blue-400 focus:bg-blue-600">
                    Send Reset Link
                </button>
            </div>

            <div class="flex justify-between pt-8 text-white text-sm font-bold">
                    <a class="hover:text-blue-400" href="{{ route('login') }}">
                        Login
                    </a>
                    <a class="hover:text-blue-400" href="{{ route('register') }}">
                        Register
                    </a>
                </div>

        </form>
    </div>
</div>
@endsection
