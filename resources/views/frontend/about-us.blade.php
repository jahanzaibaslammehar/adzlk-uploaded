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
                          <h1><i class="fa fa-info-circle"></i> About Us</h1>
                          <p class="page-subtitle">Connecting people through trusted advertisements</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>Our Story</h2>
                          <p>Founded in 2024, our platform was born from a simple idea: to create a trusted, user-friendly space where people could easily find and share what they need. What started as a small local marketplace has grown into a comprehensive advertising platform serving communities across the region.</p>
                          <p>We believe that everyone deserves access to quality goods and services, and every business deserves a platform to reach their customers effectively. Our mission is to bridge the gap between buyers and sellers, creating meaningful connections that benefit both parties.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>Our Mission</h2>
                          <p>To provide a secure, efficient, and user-friendly platform that empowers individuals and businesses to connect, trade, and grow together. We strive to create an environment where trust, transparency, and community values are at the heart of every transaction.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>Our Vision</h2>
                          <p>To become the most trusted and preferred advertising platform in our region, known for our commitment to user safety, innovative features, and exceptional customer service. We envision a future where our platform serves as the go-to destination for all types of advertisements and business needs.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>What We Offer</h2>
                          <div class="features-grid">
                              <div class="feature-item">
                                  <i class="fa fa-shield-alt"></i>
                                  <h3>Secure Platform</h3>
                                  <p>Advanced security measures to protect your information and transactions</p>
                              </div>
                              <div class="feature-item">
                                  <i class="fa fa-mobile-alt"></i>
                                  <h3>Mobile Friendly</h3>
                                  <p>Access our platform from anywhere, anytime with our responsive design</p>
                              </div>
                              <div class="feature-item">
                                  <i class="fa fa-users"></i>
                                  <h3>Community Driven</h3>
                                  <p>Built for the community, by the community, fostering local connections</p>
                              </div>
                              <div class="feature-item">
                                  <i class="fa fa-star"></i>
                                  <h3>Premium Features</h3>
                                  <p>Enhanced visibility and tools for businesses looking to grow</p>
                              </div>
                          </div>
                      </div>
                      
                      <div class="content-section">
                          <h2>Our Values</h2>
                          <div class="values-list">
                              <div class="value-item">
                                  <h3><i class="fa fa-handshake"></i> Trust</h3>
                                  <p>Building and maintaining trust through transparency and reliability</p>
                              </div>
                              <div class="value-item">
                                  <h3><i class="fa fa-heart"></i> Community</h3>
                                  <p>Supporting and strengthening local communities through our platform</p>
                              </div>
                              <div class="value-item">
                                  <h3><i class="fa fa-lightbulb"></i> Innovation</h3>
                                  <p>Continuously improving our platform with cutting-edge technology</p>
                              </div>
                              <div class="value-item">
                                  <h3><i class="fa fa-check-circle"></i> Quality</h3>
                                  <p>Maintaining high standards in everything we do</p>
                              </div>
                          </div>
                      </div>
                      
                      <div class="content-section">
                          <h2>Our Team</h2>
                          <p>Our dedicated team of professionals is passionate about creating the best possible experience for our users. From developers and designers to customer support specialists, every team member shares our commitment to excellence and user satisfaction.</p>
                          <p>We're constantly learning, growing, and adapting to meet the evolving needs of our community. Your feedback and suggestions help us improve and innovate, making our platform better with each update.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>Community Impact</h2>
                          <p>Since our launch, we've helped thousands of users connect, trade, and grow their businesses. Our platform has facilitated countless successful transactions, supported local businesses, and created opportunities for individuals to find what they need.</p>
                          <p>We're proud to contribute to the economic growth of our communities and look forward to continuing this positive impact in the years to come.</p>
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
