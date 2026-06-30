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
                                  d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-1a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>

                    <h1 class="text-xl font-bold mt-2">Create Account</h1>
                    <p class="text-sm text-base-content/60">Get started quickly</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <div>
                        <input type="text"
                               name="name"
                               placeholder="Full Name"
                               value="{{ old('name') }}"
                               class="input input-bordered w-full @error('name') input-error @enderror"
                               required autofocus>

                        @error('name')
                            <p class="text-xs text-error mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <input type="email"
                               name="email"
                               placeholder="Email"
                               value="{{ old('email') }}"
                               class="input input-bordered w-full @error('email') input-error @enderror"
                               required>

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

                    <div>
                        <input type="password"
                               name="password_confirmation"
                               placeholder="Confirm Password"
                               class="input input-bordered w-full"
                               required>
                    </div>

                    <button class="btn btn-primary w-full">
                        Register
                    </button>
                </form>

                <div class="divider text-xs">OR</div>

                <p class="text-center text-sm">
                    Already have an account?
                    <a href="{{ route('login') }}" class="link link-primary">Sign in</a>
                </p>

            </div>
        </div>

    </div>
</div>
@endsection