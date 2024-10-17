@extends('frontend.layout.app')
@section('content')
<!-- registration form -->
<div class="registration-form-section mt-100 mb-100">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6">
                <div class="form-title text-center mb-4">
                    <h2>Register</h2>
                </div>
                <div id="form_status">
                    {{-- Display validation errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="registration-form">
                    <form method="POST" id="fruitkha-contact" action="{{ route('register.store') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" placeholder="Full Name" name="name" id="name" required>
                        </div>
                        <div class="form-group mb-3">
                            <input type="email" class="form-control" placeholder="Email" name="email" id="email" required>
                        </div>
                        <div class="form-group mb-3">
                            <input type="tel" class="form-control" placeholder="Phone Number" name="phone" id="phone" pattern="[0-9]{10}" required>
                        </div>
                        <div class="form-group mb-3 position-relative">
                            <input type="password" class="form-control password-field" placeholder="Password" name="password" id="password" required>
                            {{-- <i class="fas fa-eye password-toggle" onclick="togglePassword('password')"></i> --}}
                        </div>
                        <div id="password-strength"></div>
                        <div class="form-group text-center">
                            <input type="submit" class="btn btn-primary btn-block" value="Register">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end registration form -->
@endsection

@section('scripts')
<script>
    function togglePassword(id) {
        var input = document.getElementById(id);
        var icon = input.nextElementSibling;
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }

    var passwordInput = document.getElementById("password");
    var passwordStrength = document.getElementById("password-strength");

    passwordInput.addEventListener("input", function() {
        var password = passwordInput.value;
        var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        if (passwordRegex.test(password)) {
            passwordStrength.innerHTML = "Password strength: Strong";
            passwordStrength.style.color = "green";
        } else {
            passwordStrength.innerHTML = "Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one digit, and one special character.";
            passwordStrength.style.color = "red";
        }
    });
</script>
@endsection
