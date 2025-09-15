@extends('frontend.layouts.app')

@section('title', 'Terms & Conditions')

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
                          <h1><i class="fa fa-gavel"></i> Terms & Conditions</h1>
                          <p class="page-subtitle">Please read these terms carefully before using our service</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>1. Acceptance of Terms</h2>
                          <p>By accessing and using this website, you accept and agree to be bound by the terms and provision of this agreement. If you do not agree to abide by the above, please do not use this service.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>2. Use License</h2>
                          <p>Permission is granted to temporarily download one copy of the materials (information or software) on our website for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:</p>
                          <ul>
                              <li>Modify or copy the materials</li>
                              <li>Use the materials for any commercial purpose or for any public display</li>
                              <li>Attempt to reverse engineer any software contained on the website</li>
                              <li>Remove any copyright or other proprietary notations from the materials</li>
                          </ul>
                      </div>
                      
                      <div class="content-section">
                          <h2>3. User Responsibilities</h2>
                          <p>As a user of our platform, you agree to:</p>
                          <ul>
                              <li>Provide accurate and truthful information</li>
                              <li>Respect the rights of other users</li>
                              <li>Not post inappropriate, offensive, or illegal content</li>
                              <li>Not engage in spam or fraudulent activities</li>
                              <li>Maintain the security of your account</li>
                          </ul>
                      </div>
                      
                      <div class="content-section">
                          <h2>4. Content Guidelines</h2>
                          <p>All content posted on our platform must:</p>
                          <ul>
                              <li>Be accurate and truthful</li>
                              <li>Comply with applicable laws and regulations</li>
                              <li>Not infringe on intellectual property rights</li>
                              <li>Not contain harmful, offensive, or inappropriate material</li>
                              <li>Respect the privacy and dignity of others</li>
                          </ul>
                      </div>
                      
                      <div class="content-section">
                          <h2>5. Privacy and Data Protection</h2>
                          <p>We are committed to protecting your privacy. Our collection and use of personal information is governed by our Privacy Policy, which is incorporated into these Terms by reference.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>6. Limitation of Liability</h2>
                          <p>In no event shall our company or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption) arising out of the use or inability to use the materials on our website.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>7. Termination</h2>
                          <p>We may terminate or suspend your account and bar access to the service immediately, without prior notice or liability, under our sole discretion, for any reason whatsoever and without limitation, including but not limited to a breach of the Terms.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>8. Changes to Terms</h2>
                          <p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material, we will try to provide at least 30 days notice prior to any new terms taking effect.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>9. Contact Information</h2>
                          <p>If you have any questions about these Terms & Conditions, please contact us at:</p>
                          <div class="contact-info">
                              <p><i class="fa fa-envelope"></i> Email: support@adsplatform.com</p>
                              <p><i class="fa fa-phone"></i> Phone: +1 (555) 123-4567</p>
                              <p><i class="fa fa-map-marker"></i> Address: 123 Business Street, City, State 12345</p>
                          </div>
                      </div>
                      
                      <div class="content-section">
                          <p class="last-updated"><strong>Last Updated:</strong> {{ date('F d, Y') }}</p>
                      </div>
                  </div>
              </div>
          </section>
      </div>
@endsection
