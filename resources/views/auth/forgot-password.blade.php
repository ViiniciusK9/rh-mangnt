<x-layout-guest page-title="Forgot Password">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-5">

                <!-- logo -->
                <div class="text-center mb-5">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" width="200px">
                </div>

                <!-- forgot password form -->
                <div class="card p-5">

                    @if (!session('status'))
                        <p>Enter your email to recover your password.</p>

                        <form action="{{ route('password.email') }}" method="post">

                            @csrf

                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('login') }}">Back to login</a>
                                <button type="submit" class="btn btn-primary p-2">Send email</button>
                            </div>

                        </form>
                    @else
                        <div class="text-center mb-5">
                            <p>An email has been sent to you with instructions to recover your
                                password.</p>
                            <p class="mb-5">Please check your email box.</p>
                            <a class="btn btn-primary p-2" href="{{ route('login') }}">Back to login</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-layout-guest>
