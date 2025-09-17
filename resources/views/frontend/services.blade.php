@extends('frontend.layouts.app')

@section('title', 'Our Services')

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
                          <h1><i class="fa fa-cogs"></i> Services – adzlk.com</h1>
                          <p class="page-subtitle">Simple tools to help you reach the right audience</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>Welcome to adzlk.com Services</h2>
                          <p>At adzlk.com, our goal is to make it easy for Sri Lankans to connect, promote, and grow. Whether you're an individual, a small business, or just someone looking to meet new people, our platform provides simple tools to help you reach the right audience.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>What We Offer</h2>
                          
                          <div class="service-offering">
                              <div class="service-header">
                                  <span class="service-icon">🟢</span>
                                  <h3>Free & Paid Ad Listings</h3>
                              </div>
                              <ul>
                                  <li>Post Normal Ads free of charge.</li>
                                  <li>Upgrade to Super or VIP Ads for maximum visibility.</li>
                                  <li>After 24 hours, Super and VIP Ads automatically convert to Normal Ads, keeping your listing active for the full duration.</li>
                              </ul>
                          </div>
                          
                          <div class="service-offering">
                              <div class="service-header">
                                  <span class="service-icon">🟢</span>
                                  <h3>Category-Based Listings</h3>
                              </div>
                              <p>Choose from a wide range of categories to make sure your ad reaches the right audience, including:</p>
                              <ul>
                                  <li>Personal ads & meetups</li>
                                  <li>Services (spa, tutoring, repair, transport, etc.)</li>
                                  <li>Buy & sell items</li>
                                  <li>Events & promotions</li>
                              </ul>
                          </div>
                          
                          <div class="service-offering">
                              <div class="service-header">
                                  <span class="service-icon">🟢</span>
                                  <h3>Premium Visibility</h3>
                              </div>
                              <ul>
                                  <li><strong>VIP Ads</strong> – Top placement for 24 hours, then continue as Normal Ads.</li>
                                  <li><strong>Super Ads</strong> – Boosted placement for 24 hours, then continue as Normal Ads.</li>
                                  <li>Both ad types help you get quick attention when it matters most.</li>
                              </ul>
                          </div>
                          
                          <div class="service-offering">
                              <div class="service-header">
                                  <span class="service-icon">🟢</span>
                                  <h3>User-Friendly Dashboard</h3>
                              </div>
                              <ul>
                                  <li>Create, manage, and track all your ads in one place.</li>
                                  <li>Edit, renew, or delete ads anytime.</li>
                                  <li>See how many views your ads are getting.</li>
                              </ul>
                          </div>
                          
                          <div class="service-offering">
                              <div class="service-header">
                                  <span class="service-icon">🟢</span>
                                  <h3>Community-Focused Platform</h3>
                              </div>
                              <ul>
                                  <li>Built for Sri Lankan users.</li>
                                  <li>Simple, safe, and transparent.</li>
                                  <li>Designed to help people connect easily without complications.</li>
                              </ul>
                          </div>
                      </div>
                      
                      <div class="content-section">
                          <h2>Why Choose adzlk.com?</h2>
                          <div class="benefits-grid">
                              <div class="benefit-item">
                                  <i class="fa fa-check-circle"></i>
                                  <h3>Easy to post and manage ads</h3>
                              </div>
                              
                              <div class="benefit-item">
                                  <i class="fa fa-check-circle"></i>
                                  <h3>Flexible ad options (Normal, Super, VIP)</h3>
                              </div>
                              
                              <div class="benefit-item">
                                  <i class="fa fa-check-circle"></i>
                                  <h3>Strong community focus</h3>
                              </div>
                              
                              <div class="benefit-item">
                                  <i class="fa fa-check-circle"></i>
                                  <h3>Affordable promotion for individuals and businesses</h3>
                              </div>
                          </div>
                      </div>
                      
                      <div class="content-section">
                          <h2>Get Started Today!</h2>
                          <p>👉 Start today! Post your ad on adzlk.com and get noticed.</p>
                          <div class="cta-buttons">
                              <button class="btn-primary" onclick="location.href='{{ route('login') }}'">
                                  <i class="fa fa-user-plus"></i> Create Account
                              </button>
                              <button class="btn-secondary" onclick="location.href='{{ route('home') }}'">
                                  <i class="fa fa-search"></i> Browse Ads
                              </button>
                          </div>
                      </div>
                  </div>
              </div>
          </section>
      </div>
@endsection
