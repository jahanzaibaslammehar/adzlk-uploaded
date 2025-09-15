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
                          <h1><i class="fa fa-cogs"></i> Our Services</h1>
                          <p class="page-subtitle">Comprehensive advertising solutions for every need</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>Advertising Solutions</h2>
                          <p>We offer a comprehensive range of advertising services designed to help individuals and businesses reach their target audience effectively. Whether you're looking to sell a single item or promote your business, we have the right solution for you.</p>
                      </div>
                      
                      <div class="services-grid">
                          <div class="service-card">
                              <div class="service-icon">
                                  <i class="fa fa-star"></i>
                              </div>
                              <h3>Normal Ads</h3>
                              <p>Perfect for individual sellers and small businesses. Get your message out with our standard advertising package.</p>
                              <ul class="service-features">
                                  <li>30-day visibility</li>
                                  <li>Basic search optimization</li>
                                  <li>Image upload support</li>
                                  <li>Contact information display</li>
                                  <li>Category placement</li>
                              </ul>
                              <div class="service-price">
                                  <span class="price">Free</span>
                                  <span class="period">Basic Package</span>
                              </div>
                          </div>
                          
                          <div class="service-card featured">
                              <div class="service-icon">
                                  <i class="fa fa-rocket"></i>
                              </div>
                              <h3>Super Ads</h3>
                              <p>Enhanced visibility for serious sellers. Stand out from the crowd with priority placement and additional features.</p>
                              <ul class="service-features">
                                  <li>45-day visibility</li>
                                  <li>Priority placement in search results</li>
                                  <li>Enhanced image gallery</li>
                                  <li>Featured category placement</li>
                                  <li>Analytics dashboard</li>
                                  <li>Social media sharing</li>
                              </ul>
                              <div class="service-price">
                                  <span class="price">$19.99</span>
                                  <span class="period">per month</span>
                              </div>
                          </div>
                          
                          <div class="service-card">
                              <div class="service-icon">
                                  <i class="fa fa-crown"></i>
                              </div>
                              <h3>VIP Ads</h3>
                              <p>Premium advertising solution for businesses seeking maximum exposure and professional presentation.</p>
                              <ul class="service-features">
                                  <li>60-day visibility</li>
                                  <li>Top placement in all categories</li>
                                  <li>Unlimited image uploads</li>
                                  <li>Premium customer support</li>
                                  <li>Advanced analytics</li>
                                  <li>Cross-category promotion</li>
                                  <li>Priority customer service</li>
                              </ul>
                              <div class="service-price">
                                  <span class="price">$49.99</span>
                                  <span class="period">per month</span>
                              </div>
                          </div>
                      </div>
                      
                      <div class="content-section">
                          <h2>Additional Services</h2>
                          <div class="additional-services">
                              <div class="service-item">
                                  <i class="fa fa-camera"></i>
                                  <h3>Professional Photography</h3>
                                  <p>High-quality product photography to make your ads stand out. Our professional photographers can capture your products in the best light.</p>
                                  <span class="service-cost">Starting at $29.99</span>
                              </div>
                              
                              <div class="service-item">
                                  <i class="fa fa-edit"></i>
                                  <h3>Ad Copywriting</h3>
                                  <p>Professional copywriting services to create compelling ad descriptions that drive engagement and sales.</p>
                                  <span class="service-cost">Starting at $19.99</span>
                              </div>
                              
                              <div class="service-item">
                                  <i class="fa fa-chart-line"></i>
                                  <h3>Performance Analytics</h3>
                                  <p>Detailed insights into your ad performance, including views, clicks, and engagement metrics.</p>
                                  <span class="service-cost">Starting at $9.99/month</span>
                              </div>
                              
                              <div class="service-item">
                                  <i class="fa fa-bullhorn"></i>
                                  <h3>Social Media Promotion</h3>
                                  <p>Extend your reach with social media promotion across multiple platforms.</p>
                                  <span class="service-cost">Starting at $39.99</span>
                              </div>
                          </div>
                      </div>
                      
                      <div class="content-section">
                          <h2>Business Solutions</h2>
                          <p>For businesses looking to scale their advertising efforts, we offer customized solutions and bulk pricing options.</p>
                          
                          <div class="business-features">
                              <div class="feature-item">
                                  <i class="fa fa-users"></i>
                                  <h3>Bulk Ad Management</h3>
                                  <p>Manage multiple advertisements from a single dashboard with bulk editing and scheduling capabilities.</p>
                              </div>
                              
                              <div class="feature-item">
                                  <i class="fa fa-chart-bar"></i>
                                  <h3>Advanced Reporting</h3>
                                  <p>Comprehensive reporting tools to track performance, ROI, and campaign effectiveness.</p>
                              </div>
                              
                              <div class="feature-item">
                                  <i class="fa fa-headset"></i>
                                  <h3>Dedicated Support</h3>
                                  <p>Priority customer support with dedicated account managers for business clients.</p>
                              </div>
                              
                              <div class="feature-item">
                                  <i class="fa fa-shield-alt"></i>
                                  <h3>Verification Badge</h3>
                                  <p>Build trust with verified business accounts and premium verification badges.</p>
                              </div>
                          </div>
                      </div>
                      
                      <div class="content-section">
                          <h2>Why Choose Our Services?</h2>
                          <div class="benefits-grid">
                              <div class="benefit-item">
                                  <i class="fa fa-check-circle"></i>
                                  <h3>Proven Results</h3>
                                  <p>Thousands of satisfied customers have achieved their advertising goals with our platform.</p>
                              </div>
                              
                              <div class="benefit-item">
                                  <i class="fa fa-clock"></i>
                                  <h3>Quick Setup</h3>
                                  <p>Get your ads running in minutes with our streamlined setup process.</p>
                              </div>
                              
                              <div class="benefit-item">
                                  <i class="fa fa-mobile-alt"></i>
                                  <h3>Mobile Optimized</h3>
                                  <p>Reach customers on all devices with our mobile-friendly platform.</p>
                              </div>
                              
                              <div class="benefit-item">
                                  <i class="fa fa-globe"></i>
                                  <h3>Local & Global Reach</h3>
                                  <p>Target local customers or expand your reach to broader markets.</p>
                              </div>
                          </div>
                      </div>
                      
                      <div class="content-section">
                          <h2>Get Started Today</h2>
                          <p>Ready to boost your advertising success? Choose the service that best fits your needs and start reaching more customers today.</p>
                          <div class="cta-buttons">
                              <button class="btn-primary" onclick="location.href='{{ route('login') }}'">
                                  <i class="fa fa-user-plus"></i> Create Account
                              </button>
                              <button class="btn-secondary" onclick="location.href='{{ route('home') }}'">
                                  <i class="fa fa-search"></i> Browse Ads
                              </button>
                          </div>
                      </div>
                      
                      <div class="content-section">
                          <h2>Need Help Choosing?</h2>
                          <p>Not sure which service is right for you? Our team is here to help you make the best choice for your advertising needs.</p>
                          <div class="contact-info">
                              <p><i class="fa fa-envelope"></i> Email: services@adsplatform.com</p>
                              <p><i class="fa fa-phone"></i> Phone: +1 (555) 123-4567</p>
                              <p><i class="fa fa-map-marker"></i> Address: 123 Business Street, City, State 12345</p>
                          </div>
                      </div>
                  </div>
              </div>
          </section>
      </div>
@endsection
