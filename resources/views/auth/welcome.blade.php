<x-layout-guest page-title="Welcome">
    <div class="container mt-5">
        <div class="row justify-content-center">
            {{-- Logo --}}
            <div class="text-center mb-5">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" width="200px">
            </div>

            {{-- Welcome message --}}
            <div class="card p-5 text-center">
                <p>Welcome, <strong>{{ $user->name }}</strong>!</p>
                <p>Your account has been successfully created.</p>
                <p>Click the button below to log in.</p>
                <a href="{{ route('login') }}" class="btn btn-sm p-2 btn-primary">Login</a>
            </div>
        </div>
    </div>
</x-layout-guest>
