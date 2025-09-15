<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Verification Checkout</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 20px;
            min-height: 100vh;
        }
        .checkout-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            align-items: start;
        }
        .ad-details-card {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        .checkout-container {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .ad-image {
            width: 100%;
            height: auto;
            max-height: 300px;
            object-fit: contain;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .ad-info {
            margin-bottom: 20px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        .info-label {
            font-weight: 600;
            color: #666;
        }
        .info-value {
            color: #333;
        }
        .price {
            font-size: 18px;
            font-weight: 700;
            color: #e84393;
        }
        .verification-badge {
            background: #fff3cd;
            color: #856404;
            padding: 10px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
            border: 1px solid #ffeaa7;
        }
        .verification-badge i {
            margin-right: 8px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #6772e5;
            border: none;
            border-radius: 6px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        button:hover {
            background: #5a67d8;
        }
        button:disabled {
            background: #aaa;
            cursor: not-allowed;
        }
        .message {
            text-align: center;
            margin-bottom: 15px;
            font-weight: bold;
            padding: 10px;
            border-radius: 6px;
        }
        .success {
            color: #155724;
            background: #d4edda;
            border: 1px solid #c3e6cb;
        }
        .error {
            color: #721c24;
            background: #f8d7da;
            border: 1px solid #f5c6cb;
        }
        .info {
            color: #0c5460;
            background: #d1ecf1;
            border: 1px solid #bee5eb;
        }
        .social-icons {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        .social-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
        }
        .whatsapp { background: #25d366; }
        .telegram { background: #0088cc; }
        .imo { background: #00b0ff; }
        .viber { background: #7360f2; }
        
        /* Pricing Breakdown Styles */
        .pricing-breakdown {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #e9ecef;
        }
        
        .pricing-breakdown h3 {
            margin: 0 0 15px 0;
            color: #333;
            font-size: 16px;
            text-align: center;
        }
        
        .price-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #dee2e6;
        }
        
        .price-item:last-of-type {
            border-bottom: none;
        }
        
        .price-label {
            color: #666;
            font-weight: 500;
        }
        
        .price-value {
            color: #333;
            font-weight: 600;
        }
        
        .verification-price {
            background: #fff3cd;
            margin: 5px -10px;
            padding: 8px 10px;
            border-radius: 4px;
            border-left: 3px solid #ffc107;
        }
        
        .verification-price .price-label {
            color: #856404;
        }
        
        .verification-price .price-value {
            color: #856404;
            font-weight: 700;
        }
        
        .price-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0 5px 0;
            margin-top: 10px;
            border-top: 2px solid #dee2e6;
        }
        
        .total-label {
            color: #333;
            font-weight: 700;
            font-size: 16px;
        }
        
        .total-value {
            color: #e84393;
            font-weight: 700;
            font-size: 18px;
        }
        
        .payment-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #e9ecef;
            margin-top: 20px;
        }
        
        .payment-info p {
            margin: 10px 0;
            color: #333;
            font-size: 14px;
        }
        
        .payment-info strong {
            color: #e84393;
        }
        
        @media (max-width: 768px) {
            .checkout-wrapper {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }
    </style>
</head>
<body>

<div class="checkout-wrapper">
    <!-- Left Side - Ad Details -->
    <div class="ad-details-card">
        <h2>Ad Details</h2>
        
        @if(isset($pendingAdData))
            @if($pendingAdData['image'])
                <img src="{{ asset('storage/' . $pendingAdData['image']) }}" alt="{{ $pendingAdData['title'] }}" class="ad-image">
            @else
                <div class="ad-image" style="background: #f5f5f5; display: flex; align-items: center; justify-content: center; color: #666;">
                    No Image
                </div>
            @endif
            
            <div class="ad-info">
                <div class="info-row">
                    <span class="info-label">Title:</span>
                    <span class="info-value">{{ $pendingAdData['title'] }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Category:</span>
                    <span class="info-value">{{ $category->name ?? 'N/A' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Ad Type:</span>
                    <span class="info-value">{{ $adType->name ?? 'Normal' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Location:</span>
                    <span class="info-value">{{ $pendingAdData['location'] }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Price:</span>
                    <span class="info-value price">Rs. {{ number_format($pendingAdData['price']) }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Description:</span>
                    <span class="info-value">{{ Str::limit($pendingAdData['description'], 100) }}</span>
                </div>
                
                @if($pendingAdData['is_on_whatsapp'] || $pendingAdData['is_on_telegram'] || $pendingAdData['is_on_imo'] || $pendingAdData['is_on_viber'])
                    <div class="info-row">
                        <span class="info-label">Available on:</span>
                        <span class="info-value">
                            <div class="social-icons">
                                @if($pendingAdData['is_on_whatsapp'])
                                    <div class="social-icon whatsapp"><i class="fa fa-whatsapp"></i></div>
                                @endif
                                @if($pendingAdData['is_on_telegram'])
                                    <div class="social-icon telegram"><i class="fa fa-telegram"></i></div>
                                @endif
                                @if($pendingAdData['is_on_imo'])
                                    <div class="social-icon imo"><i class="fa fa-comment"></i></div>
                                @endif
                                @if($pendingAdData['is_on_viber'])
                                    <div class="social-icon viber"><i class="fa fa-phone"></i></div>
                                @endif
                            </div>
                        </span>
                    </div>
                @endif
            </div>
            @if(isset($pendingAdData['profile_verification']) && $pendingAdData['profile_verification'])
            <div class="verification-badge">
                <i class="fa fa-shield"></i>
                <strong>Profile Verification Required</strong><br>
                <small>This category requires profile verification. Rs. 500 will be charged for verification.</small>
            </div>
            @endif
        @endif
    </div>

    <!-- Right Side - Payment Form -->
    <div class="checkout-container">
        <h2>Payment Details</h2>

        @if(session('success'))
            <p class="message success">{{ session('success') }}</p>
        @endif
        @if(session('error'))
            <p class="message error">{{ session('error') }}</p>
        @endif
        @if(session('info'))
            <p class="message info">{{ session('info') }}</p>
        @endif

        <!-- Pricing Breakdown -->
        <div class="pricing-breakdown">
            <h3>Payment Summary</h3>
            <div class="price-item">
                <span class="price-label">Ad Price:</span>
                <span class="price-value">Rs. {{ number_format($adType->price ?? 0) }}</span>
            </div>
            @if(isset($pendingAdData['profile_verification']) && $pendingAdData['profile_verification'])
                <div class="price-item verification-price">
                    <span class="price-label">Profile Verification Price:</span>
                    <span class="price-value">Rs. 500</span>
                </div>
            @endif
            <div class="price-total">
                <span class="total-label">Total Amount:</span>
                <span class="total-value">Rs. {{ number_format($pendingAdData['total_price']) }}</span>
            </div>
        </div>

        <form id="payment-form" action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="payment-info">
                <p><strong>Payment Method:</strong> Contact us for payment details</p>
                <p><strong>Total Amount:</strong> Rs. {{ number_format($pendingAdData['total_price']) }}</p>
                <p><strong>Status:</strong> Payment pending</p>
            </div>
            <button type="submit" id="pay-button">Pay Rs. {{ number_format($pendingAdData['total_price']) }}</button>
        </form>
    </div>
</div>



</body>
</html>
