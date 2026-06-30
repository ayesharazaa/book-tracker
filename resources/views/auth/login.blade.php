@extends('layout')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-md">

        <div class="card bg-base-100 shadow-xl border border-base-200">
            <div class="card-body space-y-4">

                <div class="text-center">
                    <div class="inline-flex p-3 rounded-full bg-primary/10">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-7 w-7 text-primary"
                             fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>

                    <h1 class="text-xl font-bold mt-2">Welcome Back</h1>
                    <p class="text-sm text-base-content/60">Sign in to continue</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <div>
                        <input type="email"
                               name="email"
                               placeholder="Email"
                               value="{{ old('email') }}"
                               class="input input-bordered w-full @error('email') input-error @enderror"
                               required autofocus>

                        @error('email')
                            <p class="text-xs text-error mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <input type="password"
                               name="password"
                               placeholder="Password"
                               class="input input-bordered w-full @error('password') input-error @enderror"
                               required>

                        @error('password')
                            <p class="text-xs text-error mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="remember" class="checkbox checkbox-sm">
                            Remember me
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="link link-hover">
                                Forgot?
                            </a>
                        @endif
                    </div>

                    <button class="btn btn-primary w-full">
                        Sign In
                    </button>
                </form>

                <div class="divider text-xs">OR</div>

                <p class="text-center text-sm">
                    No account?
                    <a href="{{ route('register') }}" class="link link-primary">Register</a>
                </p>

            </div>
        </div>

    </div>
</div>
@endsection