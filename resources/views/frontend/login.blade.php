@extends('frontend.layouts.app')

@section('title', 'Login Page')

@section('content')

            <div class="login-container">
                <div class="login-card">
                    <div class="login-header">
                        <h2>Welcome Back</h2>
                        <p>Enter your phone number to continue</p>
                    </div>
                    
                    <form class="login-form" id="phoneForm" action="{{ route('sendOtp') }}" method="post">
                        @csrf()
                        <div class="phone-input-group">
                            <div class="country-code-select">
                                <select name="country_code" class="country-code">
                                    <option value="+94" selected>+94</option>
                                </select>
                            </div>
                            <div class="phone-input">
                                <input type="tel" id="phoneNumber" placeholder="7xxxxxxxx" name="phone" maxlength="11" required>
                            </div>
                        </div>
                        
                        <button type="submit" class="login-submit-btn">
                            <i class="fa fa-sign-in"></i>
                            Continue
                        </button>
                    </form>
                    
                    <div class="login-footer">
                        <p>By continuing, you agree to our <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a></p>
                    </div>
                </div>
            </div>

@endsection