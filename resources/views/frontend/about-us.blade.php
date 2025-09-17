@extends('frontend.layouts.app')

@section('title', 'About Us')

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
                          <h1><i class="fa fa-info-circle"></i> About Us – adzlk.com</h1>
                          <p class="page-subtitle">Sri Lanka's trusted platform for connecting people, businesses, and communities</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>Welcome to adzlk.com</h2>
                          <p>We created adzlk.com with one simple goal: to make it easier for Sri Lankans to find what they need and share what they offer. Whether you're looking to buy, sell, meet new people, or promote your services, adzlk.com gives you a safe and simple space to connect.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>What We Do</h2>
                          <div class="features-grid">
                              <div class="feature-item">
                                  <i class="fa fa-list-alt"></i>
                                  <h3>Local Listings</h3>
                                  <p>Post ads for products, services, meetups, or events.</p>
                              </div>
                              <div class="feature-item">
                                  <i class="fa fa-users"></i>
                                  <h3>Connections</h3>
                                  <p>Meet people, build networks, or discover opportunities near you.</p>
                              </div>
                              <div class="feature-item">
                                  <i class="fa fa-mobile-alt"></i>
                                  <h3>Convenience</h3>
                                  <p>A user-friendly platform that works for everyone, from students and professionals to small businesses.</p>
                              </div>
                          </div>
                      </div>
                      
                      <div class="content-section">
                          <h2>Why Choose adzlk.com?</h2>
                          <div class="values-list">
                              <div class="value-item">
                                  <h3><i class="fa fa-flag"></i> For the Community</h3>
                                  <p>Designed especially for Sri Lankan users, with local needs in mind.</p>
                              </div>
                              <div class="value-item">
                                  <h3><i class="fa fa-rocket"></i> Easy to Use</h3>
                                  <p>Post an ad in minutes and reach thousands of users.</p>
                              </div>
                              <div class="value-item">
                                  <h3><i class="fa fa-shield-alt"></i> Safe & Transparent</h3>
                                  <p>We provide guidelines and monitoring to keep listings real, relevant, and respectful.</p>
                              </div>
                              <div class="value-item">
                                  <h3><i class="fa fa-cogs"></i> Flexible</h3>
                                  <p>From personal ads to business promotions, adzlk.com is built to support a wide range of listings.</p>
                              </div>
                          </div>
                      </div>
                      
                      <div class="content-section">
                          <h2>Our Vision</h2>
                          <p>To become Sri Lanka's go-to online hub where people can connect, share, and grow together.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>Our Promise</h2>
                          <p>We're committed to keeping adzlk.com simple, reliable, and community-focused. Your trust matters, and we work hard to provide a platform that brings real value to everyday life in Sri Lanka.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>Get in Touch</h2>
                          <p>We'd love to hear from you! Whether you have questions, suggestions, or just want to say hello, our team is here to help. Reach out to us through any of these channels:</p>
                          <div class="contact-info">
                              <p><i class="fa fa-envelope"></i> Email: hello@adsplatform.com</p>
                              <p><i class="fa fa-phone"></i> Phone: +1 (555) 123-4567</p>
                              <p><i class="fa fa-map-marker"></i> Address: 123 Business Street, City, State 12345</p>
                              <p><i class="fa fa-clock"></i> Business Hours: Monday - Friday, 9:00 AM - 6:00 PM</p>
                          </div>
                      </div>
                      
                      <div class="content-section">
                          <h2>Join Our Community</h2>
                          <p>Ready to be part of something special? Join thousands of satisfied users who trust our platform for their advertising needs. Whether you're looking to buy, sell, or simply explore what's available in your area, we're here to help you succeed.</p>
                          <div class="cta-buttons">
                              <button class="btn-primary" onclick="location.href='{{ route('home') }}'">
                                  <i class="fa fa-search"></i> Browse Ads
                              </button>
                              <button class="btn-secondary" onclick="location.href='{{ route('login') }}'">
                                  <i class="fa fa-user-plus"></i> Get Started
                              </button>
                          </div>
                      </div>
                  </div>
              </div>
          </section>
      </div>
@endsection
