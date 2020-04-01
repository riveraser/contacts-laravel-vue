@extends('layouts.app')

@section('content')
<div class="mx-auto h-full flex justify-center items-center bg-gray-300">
    <div class="w-96 bg-blue-900 rounded-lg shadow-xl p-6">
        <img src="img/logoSRmedium.png">
        <h1 class="text-white text-3xl pt-8" >Register with us</h1>
        <h2 class="text-blue-300 " >Enter your information below</h2>
        <form method="POST" action="{{ route('register') }}" class="pt-8">
                @csrf

                <div class="relative">
                    <label for="name" class="uppercase text-blue-500 text-xs font-bold absolute pl-3 pt-3">Name</label>
                    <div>
                        <input id="name" type="text"
                            class="pt-8 w-full rounded p-3 bg-blue-800 text-gray-100 outline-none focus:bg-blue-700"
                            name="name" value="{{ old('name') }}" autocomplete="name" autofocus placeholder="Name"
                        >
                        @error('name')
                        <span class="text-red-600 text-sm pt-1" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="relative pt-3">
                    <label for="email" class="uppercase text-blue-500 text-xs font-bold absolute pl-3 pt-3">E-Mail</label>
                    <div>
                        <input id="email" type="email"
                            class="pt-8 w-full rounded p-3 bg-blue-800 text-gray-100 outline-none focus:bg-blue-700"
                            name="email" value="{{ old('email') }}" autocomplete="email" placeholder="your@email.com"
                        >
                        @error('email')
                        <span class="text-red-600 text-sm pt-1" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="relative pt-3">
                    <label for="password" class="uppercase text-blue-500 text-xs font-bold absolute pl-3 pt-3">Password</label>
                    <div>
                        <input id="password" type="password"
                            class="pt-8 w-full rounded p-3 bg-blue-800 text-gray-100 outline-none focus:bg-blue-700"
                            name="password" autocomplete="new-password" placeholder="Password"
                        >
                        @error('password')
                        <span class="text-red-600 text-sm pt-1" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="relative pt-3">
                    <label for="password-confirm" class="uppercase text-blue-500 text-xs font-bold absolute pl-3 pt-3">Re-enter Password</label>
                    <div>
                        <input id="password-confirm" type="password"
                            class="pt-8 w-full rounded p-3 bg-blue-800 text-gray-100 outline-none focus:bg-blue-700"
                            name="password_confirmation" autocomplete="new-password" placeholder="Confirm"
                        >
                    </div>
                </div>
                <div class="pt-8">
                    <button type="submit" class="w-full bg-gray-200 py-2 px-3 text-left uppercase rounded text-blue-800 font-bold hover:bg-blue-400 focus:bg-blue-600">
                            Register
                    </button>
                </div>
                <div class="flex justify-between pt-8 text-white text-sm font-bold">
                        <a class="hover:text-blue-400" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                        <a class="hover:text-blue-400" href="{{ route('login') }}">
                            Login
                        </a>
                    </div>
            </form>

    </div>
</div>
@endsection
