@extends('frontend.layouts.app')

@section('title', 'Frequently Asked Questions')

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
                          <h1><i class="fa fa-question-circle"></i> Frequently Asked Questions (FAQ) – adzlk.com</h1>
                          <p class="page-subtitle">Find answers to common questions about our platform</p>
                      </div>
                      
                      <div class="faq-section">
                          <div class="faq-item">
                              <div class="faq-question" onclick="toggleFaq(this)">
                                  <h3>1. What is adzlk.com?</h3>
                                  <i class="fa fa-chevron-down"></i>
                              </div>
                              <div class="faq-answer">
                                  <p>adzlk.com is a Sri Lankan online listing platform where you can buy, sell, promote services, or connect with people. It's designed to be quick, safe, and easy to use.</p>
                              </div>
                          </div>
                          
                          <div class="faq-item">
                              <div class="faq-question" onclick="toggleFaq(this)">
                                  <h3>2. How do I post an ad?</h3>
                                  <i class="fa fa-chevron-down"></i>
                              </div>
                              <div class="faq-answer">
                                  <ul>
                                      <li>Sign up or log in to your account.</li>
                                      <li>Click "Post an Ad."</li>
                                      <li>Choose your category, add a title, description, price, and photos.</li>
                                      <li>Select your ad type (Normal, Super, or VIP).</li>
                                      <li>Review your details and publish.</li>
                                  </ul>
                                  <p>Your ad will appear on the site once it's approved.</p>
                              </div>
                          </div>
                          
                          <div class="faq-item">
                              <div class="faq-question" onclick="toggleFaq(this)">
                                  <h3>3. What are the different ad types on adzlk.com?</h3>
                                  <i class="fa fa-chevron-down"></i>
                              </div>
                              <div class="faq-answer">
                                  <ul>
                                      <li><strong>Normal Ads</strong> – Standard ads that appear in the general listing section.</li>
                                      <li><strong>Super Ads</strong> – Ads that appear with higher visibility for the first 24 hours. After that, they automatically convert into Normal Ads and remain live for the full ad duration.</li>
                                      <li><strong>VIP Ads</strong> – Ads placed at the very top of categories and search results for the first 24 hours. After that, they automatically convert into Normal Ads and remain active for the full ad duration.</li>
                                  </ul>
                                  <p>👉 This way, every paid ad gets maximum exposure in the first 24 hours, and then continues as a Normal Ad for the rest of the listing period.</p>
                              </div>
                          </div>
                          
                          <div class="faq-item">
                              <div class="faq-question" onclick="toggleFaq(this)">
                                  <h3>4. Does it cost money to post an ad?</h3>
                                  <i class="fa fa-chevron-down"></i>
                              </div>
                              <div class="faq-answer">
                                  <ul>
                                      <li><strong>Normal Ads:</strong> Usually free.</li>
                                      <li><strong>Super Ads:</strong> Small fee for boosted visibility for the first 24 hours.</li>
                                      <li><strong>VIP Ads:</strong> Premium fee for top placement for the first 24 hours.</li>
                                  </ul>
                                  <p>After 24 hours, Super and VIP Ads continue as Normal Ads without extra cost.</p>
                              </div>
                          </div>
                          
                          <div class="faq-item">
                              <div class="faq-question" onclick="toggleFaq(this)">
                                  <h3>5. How long will my ad stay active?</h3>
                                  <i class="fa fa-chevron-down"></i>
                              </div>
                              <div class="faq-answer">
                                  <ul>
                                      <li><strong>Normal Ads:</strong> 30 days.</li>
                                      <li><strong>Super Ads:</strong> 30 days (first 24 hours with boosted visibility, then convert to Normal Ads).</li>
                                      <li><strong>VIP Ads:</strong> 30 days (first 24 hours with top-level priority, then convert to Normal Ads).</li>
                                  </ul>
                                  <p>You can renew or re-upgrade anytime.</p>
                              </div>
                          </div>
                          
                          <div class="faq-item">
                              <div class="faq-question" onclick="toggleFaq(this)">
                                  <h3>6. What type of ads can I post?</h3>
                                  <i class="fa fa-chevron-down"></i>
                              </div>
                              <div class="faq-answer">
                                  <p>You can post ads in categories such as:</p>
                                  <ul>
                                      <li>Personal ads & meetups</li>
                                      <li>Services (spa, repair, tutoring, etc.)</li>
                                      <li>Buy & sell items</li>
                                      <li>Events and promotions</li>
                                  </ul>
                                  <p>👉 Please make sure your ads follow our Posting Rules & Guidelines (no illegal or offensive content).</p>
                              </div>
                          </div>
                          
                          <div class="faq-item">
                              <div class="faq-question" onclick="toggleFaq(this)">
                                  <h3>7. How do I edit or delete my ad?</h3>
                                  <i class="fa fa-chevron-down"></i>
                              </div>
                              <div class="faq-answer">
                                  <ul>
                                      <li>Log in to your account.</li>
                                      <li>Go to "My Ads."</li>
                                      <li>Select the ad you want to edit or delete.</li>
                                  </ul>
                              </div>
                          </div>
                          
                          <div class="faq-item">
                              <div class="faq-question" onclick="toggleFaq(this)">
                                  <h3>8. Is adzlk.com safe to use?</h3>
                                  <i class="fa fa-chevron-down"></i>
                              </div>
                              <div class="faq-answer">
                                  <p>We encourage safe practices:</p>
                                  <ul>
                                      <li>Always meet in public places for transactions.</li>
                                      <li>Verify items/services before payment.</li>
                                      <li>Do not share sensitive personal details.</li>
                                  </ul>
                                  <p>adzlk.com monitors listings, but users are responsible for their own safety and decisions.</p>
                              </div>
                          </div>
                          
                          <div class="faq-item">
                              <div class="faq-question" onclick="toggleFaq(this)">
                                  <h3>9. How do I report a suspicious ad or user?</h3>
                                  <i class="fa fa-chevron-down"></i>
                              </div>
                              <div class="faq-answer">
                                  <p>If you come across a suspicious ad or inappropriate content:</p>
                                  <ul>
                                      <li>Click "Report" on the ad, or</li>
                                      <li>Contact us at support@adzlk.com.</li>
                                  </ul>
                                  <p>Our team will review and take action.</p>
                              </div>
                          </div>
                          
                          <div class="faq-item">
                              <div class="faq-question" onclick="toggleFaq(this)">
                                  <h3>10. Do I need an account to browse ads?</h3>
                                  <i class="fa fa-chevron-down"></i>
                              </div>
                              <div class="faq-answer">
                                  <p>No. You can browse freely. But you need an account to post ads, contact advertisers, or manage your listings.</p>
                              </div>
                          </div>
                          
                          <div class="faq-item">
                              <div class="faq-question" onclick="toggleFaq(this)">
                                  <h3>11. How can I contact adzlk.com?</h3>
                                  <i class="fa fa-chevron-down"></i>
                              </div>
                              <div class="faq-answer">
                                  <p>You can reach us at: 📧 support@adzlk.com</p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </section>
      </div>
      
      <script>
          function toggleFaq(element) {
              const answer = element.nextElementSibling;
              const icon = element.querySelector('i');
              
              if (answer.style.display === 'block') {
                  answer.style.display = 'none';
                  icon.className = 'fa fa-chevron-down';
              } else {
                  answer.style.display = 'block';
                  icon.className = 'fa fa-chevron-up';
              }
          }
      </script>
@endsection
