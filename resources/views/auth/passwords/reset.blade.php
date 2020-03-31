@extends('layouts.app')

@section('content')
<div class="mx-auto h-full flex justify-center items-center bg-gray-300">
    <div class="w-96 bg-blue-900 rounded-lg shadow-xl p-6">
        <img src="img/logoSRmedium.png">
        <h1 class="text-white text-3xl pt-8" >Reset password</h1>
        {{-- <h2 class="text-blue-300 " >Enter your credentials below</h2> --}}
        <form method="POST" action="{{ route('password.update') }}"  class="pt-8">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                
                <div class="relative">
                    <label for="email" class="uppercase text-blue-500 text-xs font-bold absolute pl-3 pt-3">E-Mail</label>
                    <div>
                        <input id="email" type="email" 
                            class="pt-8 w-full rounded p-3 bg-blue-800 text-gray-100 outline-none focus:bg-blue-700"
                            name="email" value="{{ $email ?? old('email') }}" autocomplete="email" autofocus
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
                            name="password" autocomplete="new-password"
                        >
                        @error('password')
                            <span class="text-red-600 text-sm pt-1" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="relative pt-3">
                    <label for="password-confirm" class="uppercase text-blue-500 text-xs font-bold absolute pl-3 pt-3">Confirm</label>
                    <div>
                        <input id="password-confirm" type="password" 
                            class="pt-8 w-full rounded p-3 bg-blue-800 text-gray-100 outline-none focus:bg-blue-700" 
                            name="password_confirmation" autocomplete="new-password"
                        >
                    </div>
                </div>
                <div class="pt-8">
                    <button type="submit" class="w-full bg-gray-200 py-2 px-3 text-left uppercase rounded text-blue-800 font-bold hover:bg-blue-400 focus:bg-blue-600">
                       Reset Password
                    </button>
                </div>
            </form>
    </div>
</div>
@endsection
