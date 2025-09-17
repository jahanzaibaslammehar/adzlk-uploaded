@extends('frontend.layouts.app')

@section('title', 'Privacy Policy')

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
                          <h1><i class="fa fa-shield-alt"></i> Privacy Policy</h1>
                          <p class="page-subtitle">Effective Date: September 6, 2025</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>Introduction</h2>
                          <p>At adzlk.com, your privacy is important to us. This Privacy Policy explains how we collect, use, and protect your personal information when you use our website https://adzlk.com. By accessing or using adzlk.com, you consent to the practices described here.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>Information We Collect</h2>
                          <p>When you use adzlk.com, we may collect:</p>
                          <ul>
                              <li><strong>Personal Information</strong> – such as your name, email address, phone number, or other details you provide when registering, posting an ad, or contacting us.</li>
                              <li><strong>Usage Data</strong> – including your IP address, browser type, device information, and pages visited, collected automatically for analytics and site improvement.</li>
                              <li><strong>Cookies</strong> – small files placed on your device to improve your browsing experience, remember preferences, and support ads or analytics.</li>
                          </ul>
                      </div>
                      
                      <div class="content-section">
                          <h2>How We Use Your Information</h2>
                          <p>We may use your information to:</p>
                          <ul>
                              <li>Create and manage your account.</li>
                              <li>Publish your ads or listings.</li>
                              <li>Improve our website and services.</li>
                              <li>Respond to your messages or support requests.</li>
                              <li>Send updates, notifications, or promotional content (you can opt out anytime).</li>
                              <li>Prevent fraud, spam, or other unlawful activity.</li>
                          </ul>
                      </div>
                      
                      <div class="content-section">
                          <h2>Sharing Your Information</h2>
                          <p>We do not sell or rent your personal information. However, we may share information with:</p>
                          <ul>
                              <li>Service providers (e.g., payment gateways, analytics tools) who help us operate the site.</li>
                              <li>Legal authorities if required by law or to protect our rights, users, or the public.</li>
                              <li>Other users of adzlk.com when you publish ads or listings (only the details you choose to share).</li>
                          </ul>
                      </div>
                      
                      <div class="content-section">
                          <h2>Cookies and Tracking</h2>
                          <p>adzlk.com uses cookies to personalize your experience and analyze site performance. You may disable cookies in your browser settings, but some features may not work properly.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>Data Security</h2>
                          <p>We take reasonable steps to protect your personal information from unauthorized access, loss, or misuse. However, no method of transmission over the internet is 100% secure, and we cannot guarantee absolute security.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>Your Rights</h2>
                          <p>You have the right to:</p>
                          <ul>
                              <li>Access the personal data we hold about you.</li>
                              <li>Request corrections to inaccurate information.</li>
                              <li>Request deletion of your account or personal data (subject to legal obligations).</li>
                              <li>Opt out of marketing communications.</li>
                          </ul>
                          <p>To exercise your rights, contact us at support@adzlk.com.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>Third-Party Links</h2>
                          <p>adzlk.com may contain links to external websites. We are not responsible for the privacy practices or content of third-party sites.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>Changes to This Policy</h2>
                          <p>We may update this Privacy Policy from time to time. Any changes will be posted on this page with a revised "Effective Date." Continued use of adzlk.com after updates means you accept the new policy.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>Contact Us</h2>
                          <p>If you have questions about this Privacy Policy or how we handle your data, please contact us at:</p>
                          <div class="contact-info">
                              <p><i class="fa fa-envelope"></i> 📧 support@adzlk.com</p>
                          </div>
                      </div>
                  </div>
              </div>
          </section>
      </div>
@endsection
