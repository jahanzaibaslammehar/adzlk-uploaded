@extends('frontend.layouts.app')

@section('title', 'Login Page')

@section('content')

<div class="login-container">
                <div class="login-card">
                    <div class="login-header">
                        <h2>OTP Verification</h2>
                        <p>Enter the 6-digit code sent to <span id="userPhoneDisplay"></span></p>
                    </div>
                    
                    <form class="otp-form" id="otpForm" action="{{ route('verifyOtp') }}" method="post">
                        @csrf()
                        <div class="otp-input-group">
                            <input type="text" name="otp[]" class="otp-input" maxlength="1" data-index="0" required>
                            <input type="text" name="otp[]" class="otp-input" maxlength="1" data-index="1" required>
                            <input type="text" name="otp[]" class="otp-input" maxlength="1" data-index="2" required>
                            <input type="text" name="otp[]" class="otp-input" maxlength="1" data-index="3" required>
                            <input type="text" name="otp[]" class="otp-input" maxlength="1" data-index="4" required>
                            <input type="text" name="otp[]" class="otp-input" maxlength="1" data-index="5" required>
                        </div>
                        
                        <div class="otp-timer">
                            <p>Resend code in <span id="timer">60</span>s</p>
                        </div>
                        
                        <button type="submit" class="login-submit-btn">
                            <i class="fa fa-check"></i>
                            Verify OTP
                        </button>
                        <input type="hidden" name="phone" value="{{ request('phone') }}">
                    </form>
                    
                    <div class="otp-footer">
                        <button class="resend-btn" id="resendBtn" disabled>
                            <i class="fa fa-refresh"></i>
                            Resend OTP
                        </button>
                        <p>Didn't receive the code? Check your spam folder</p>
                    </div>
                </div>
            </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const otpInputs = document.querySelectorAll('.otp-input');
    
    // Auto-focus functionality
    otpInputs.forEach((input, index) => {
        input.addEventListener('input', function(e) {
            const value = e.target.value;
            
            // Only allow single digit
            if (value.length > 1) {
                e.target.value = value.slice(0, 1);
            }
            
            // Move to next input if current input has a value
            if (value.length === 1 && index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
            }
        });
        
        // Handle backspace
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Backspace' && e.target.value === '' && index > 0) {
                otpInputs[index - 1].focus();
            }
        });
        
        // Handle paste
        input.addEventListener('paste', function(e) {
            e.preventDefault();
            const pastedData = e.clipboardData.getData('text').replace(/\D/g, '');
            
            if (pastedData.length >= 6) {
                for (let i = 0; i < 6; i++) {
                    otpInputs[i].value = pastedData[i];
                }
                otpInputs[5].focus();
            }
        });
    });
    
    // Focus first input on page load
    if (otpInputs.length > 0) {
        otpInputs[0].focus();
    }
});
</script>

@endsection