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
                          <p class="page-subtitle">How we collect, use, and protect your information</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>1. Information We Collect</h2>
                          <p>We collect information you provide directly to us, such as when you create an account, post an advertisement, or contact us for support. This may include:</p>
                          <ul>
                              <li>Name, email address, and phone number</li>
                              <li>Account credentials and profile information</li>
                              <li>Content you post, including advertisements and images</li>
                              <li>Communications with us and other users</li>
                              <li>Payment information when you purchase premium services</li>
                          </ul>
                      </div>
                      
                      <div class="content-section">
                          <h2>2. How We Use Your Information</h2>
                          <p>We use the information we collect to:</p>
                          <ul>
                              <li>Provide, maintain, and improve our services</li>
                              <li>Process transactions and send related information</li>
                              <li>Send technical notices, updates, and support messages</li>
                              <li>Respond to your comments and questions</li>
                              <li>Monitor and analyze trends, usage, and activities</li>
                              <li>Detect, investigate, and prevent fraudulent transactions</li>
                          </ul>
                      </div>
                      
                      <div class="content-section">
                          <h2>3. Information Sharing and Disclosure</h2>
                          <p>We do not sell, trade, or otherwise transfer your personal information to third parties without your consent, except in the following circumstances:</p>
                          <ul>
                              <li>With your explicit consent</li>
                              <li>To comply with legal obligations</li>
                              <li>To protect our rights and safety</li>
                              <li>In connection with a business transfer or merger</li>
                              <li>With service providers who assist in our operations</li>
                          </ul>
                      </div>
                      
                      <div class="content-section">
                          <h2>4. Data Security</h2>
                          <p>We implement appropriate technical and organizational measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. These measures include:</p>
                          <ul>
                              <li>Encryption of data in transit and at rest</li>
                              <li>Regular security assessments and updates</li>
                              <li>Access controls and authentication measures</li>
                              <li>Employee training on data protection</li>
                              <li>Incident response and breach notification procedures</li>
                          </ul>
                      </div>
                      
                      <div class="content-section">
                          <h2>5. Cookies and Tracking Technologies</h2>
                          <p>We use cookies and similar tracking technologies to enhance your experience on our website. These technologies help us:</p>
                          <ul>
                              <li>Remember your preferences and settings</li>
                              <li>Analyze how you use our services</li>
                              <li>Provide personalized content and advertisements</li>
                              <li>Improve our website performance and security</li>
                          </ul>
                          <p>You can control cookie settings through your browser preferences.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>6. Your Rights and Choices</h2>
                          <p>You have certain rights regarding your personal information:</p>
                          <ul>
                              <li>Access and review your personal data</li>
                              <li>Correct inaccurate or incomplete information</li>
                              <li>Request deletion of your personal data</li>
                              <li>Object to certain processing activities</li>
                              <li>Withdraw consent where applicable</li>
                              <li>Request data portability</li>
                          </ul>
                      </div>
                      
                      <div class="content-section">
                          <h2>7. Data Retention</h2>
                          <p>We retain your personal information for as long as necessary to provide our services and fulfill the purposes outlined in this policy. We may retain certain information for longer periods when required by law or for legitimate business purposes.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>8. International Data Transfers</h2>
                          <p>Your information may be transferred to and processed in countries other than your own. We ensure that such transfers comply with applicable data protection laws and implement appropriate safeguards to protect your information.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>9. Children's Privacy</h2>
                          <p>Our services are not intended for children under the age of 13. We do not knowingly collect personal information from children under 13. If you believe we have collected such information, please contact us immediately.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>10. Changes to This Policy</h2>
                          <p>We may update this Privacy Policy from time to time. We will notify you of any material changes by posting the new policy on this page and updating the "Last Updated" date. Your continued use of our services after such changes constitutes acceptance of the updated policy.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>11. Contact Us</h2>
                          <p>If you have any questions about this Privacy Policy or our data practices, please contact us:</p>
                          <div class="contact-info">
                              <p><i class="fa fa-envelope"></i> Email: privacy@adsplatform.com</p>
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
