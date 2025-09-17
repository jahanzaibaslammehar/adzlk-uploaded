@extends('frontend.layouts.app')

@section('title', 'Return Policy')

@section('content')
        <div class="menu">
          
          <button class="btnPublish">How to Publish Ads?</button>
          <div class="search">
              <input type="text" id="searchInput" placeholder="Search for Ads..." value="{{ request('q') }}">
              <button class="btnSearch" onclick="performSearch()">Search</button>
          </div>
                          <div class="savedButtons">
                    <button class="btnSaved" onclick="location.href='{{ route('saved-ads') }}'"><i class="fa fa-heart" style="color: #C3891B; text-shadow: 0 0 3px #ffff;"></i>Saved Ads</button>
              @if(Auth::guard('poster')->check())
                <button class="loginBtn" onclick="location.href='{{ route('logout') }}'"><i class="fa fa-lock" style="color: #002280; text-shadow: 0 0 3px #ffff;" ></i>Logout</button>
              @else
                <button class="loginBtn" onclick="location.href='{{ route('login') }}'"><i class="fa fa-lock" style="color: #002280; text-shadow: 0 0 3px #ffff;" ></i>Login</button>
              @endif
          </div>
          @if(Auth::guard('poster')->check())
          <div class="btn-dashboard">
                    <button class="btnDashboard" onclick="location.href='{{ route('dashboard') }}'"><i class="fa fa-dashboard"

                        style="color: #ffff; text-shadow: 0 0 3px rgba(0,0,0,0.3);"></i>Dashboard</button>        
                </div>
          @endif
          <div class="quickLinks">
              <h1>Quick Links</h1>
              <div></div>
              <ul class="menu-list">
                <li onclick="location.href='{{ route('home') }}'" style="cursor: pointer;">
                  All Categories
                </li>
                @foreach($category as $item)
                  <li onclick="location.href='{{ route('category.show', $item->id) }}'" style="cursor: pointer;">
                    {{ $item->name }}
                  </li>
                @endforeach
              </ul>
          </div>
        </div>
        <div id="content">
          <section class="container-fluid">
              <div class="main-content">
                  <div class="social-btns">
                      @if($settings && $settings->subscribe_whatsapp_link)
                          <button class="btnSubscribe" onclick="openWhatsApp('{{ $settings->subscribe_whatsapp_link }}')"><i class="fa fa-whatsapp"></i>Subscribe</button>
                      @else
                          <button class="btnSubscribe"><i class="fa fa-whatsapp"></i>Subscribe</button>
                      @endif
                      
                      @if($settings && $settings->subscribe_twitter_link)
                          <button class="btnSubscribe1" onclick="window.open('{{ $settings->subscribe_twitter_link }}', '_blank')"><i class="fa fa-twitter"></i>Subscribe</button>
                      @else
                          <button class="btnSubscribe1"><i class="fa fa-twitter"></i>Subscribe</button>
                      @endif
                      
                      @if($settings && $settings->subscribe_telegram_link)
                          <button class="btnSubscribe2" onclick="window.open('{{ $settings->subscribe_telegram_link }}', '_blank')"><i class="fa fa-telegram"></i>Subscribe</button>
                      @else
                          <button class="btnSubscribe2"><i class="fa fa-telegram"></i>Subscribe</button>
                      @endif
                  </div>
                  
                  <div class="page-content">
                      <div class="page-header">
                          <h1><i class="fa fa-undo"></i> Return & Refund Policy – adzlk.com</h1>
                          <p class="page-subtitle">Effective Date: September 6, 2025</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>Overview</h2>
                          <p>At adzlk.com, we operate as an online listing platform where users can post and browse ads. Since we do not sell products or services directly, we do not handle physical returns or exchanges. Please read the following carefully:</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>1. Transactions Between Users</h2>
                          <ul>
                              <li>All purchases, sales, and services arranged through ads on adzlk.com are between the buyer and the seller.</li>
                              <li>adzlk.com does not guarantee the quality, safety, legality, or delivery of goods or services listed by users.</li>
                              <li>Any return, refund, or exchange request must be resolved directly between the parties involved.</li>
                          </ul>
                      </div>
                      
                      <div class="content-section">
                          <h2>2. Paid Advertising Services</h2>
                          <p>adzlk.com offers promotional ad services such as Normal, Super, and VIP Ads.</p>
                          <ul>
                              <li>Normal Ads are free or low-cost, and payments (if any) are non-refundable once the ad is posted.</li>
                              <li>Super Ads and VIP Ads are premium upgrades that give additional visibility for the first 24 hours, after which they convert to Normal Ads.</li>
                              <li>Once purchased and published, payments for Super or VIP Ads are non-refundable, even if you choose to remove your ad early.</li>
                          </ul>
                      </div>
                      
                      <div class="content-section">
                          <h2>3. Cancellations</h2>
                          <ul>
                              <li>Users may delete their ads at any time from their account dashboard.</li>
                              <li>Deleting an ad does not qualify for a refund of any fees already paid.</li>
                          </ul>
                      </div>
                      
                      <div class="content-section">
                          <h2>4. Platform Errors</h2>
                          <p>If there is a proven technical error on adzlk.com that prevents your ad from being published or displayed properly:</p>
                          <ul>
                              <li>Please contact us at support@adzlk.com within 48 hours of posting.</li>
                              <li>Our team will review the issue and may, at our discretion, offer:</li>
                              <li>A re-post of the ad at no extra charge, or</li>
                              <li>A refund of the promotional fee.</li>
                          </ul>
                      </div>
                      
                      <div class="content-section">
                          <h2>5. Contact Us</h2>
                          <p>If you have questions about this Return Policy, please contact us:</p>
                          <div class="contact-info">
                              <p><i class="fa fa-envelope"></i> 📧 support@adzlk.com</p>
                          </div>
                      </div>
                  </div>
              </div>
          </section>
      </div>
@endsection
