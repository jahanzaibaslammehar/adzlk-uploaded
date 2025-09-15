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
                          <h1><i class="fa fa-question-circle"></i> Frequently Asked Questions</h1>
                          <p class="page-subtitle">Find answers to common questions about our platform</p>
                      </div>
                      
                      <div class="faq-section">
                          <h2>General Questions</h2>
                          
                          <div class="faq-item">
                              <div class="faq-question" onclick="toggleFaq(this)">
                                  <h3>What is this platform?</h3>
                                  <i class="fa fa-chevron-down"></i>
                              </div>
                              <div class="faq-answer">
                                  <p>Our platform is a comprehensive advertising marketplace where individuals and businesses can post, browse, and connect through various types of advertisements. We offer normal, super, and VIP ad options to meet different needs and budgets.</p>
                              </div>
                          </div>
                          
                          <div class="faq-item">
                              <div class="faq-question" onclick="toggleFaq(this)">
                                  <h3>Is it free to use?</h3>
                                  <i class="fa fa-chevron-down"></i>
                              </div>
                              <div class="faq-answer">
                                  <p>Basic usage of our platform is free. You can browse ads, create an account, and post basic advertisements at no cost. We also offer premium features and enhanced visibility options for businesses looking to maximize their reach.</p>
                              </div>
                          </div>
                          
                          <div class="faq-item">
                              <div class="faq-question" onclick="toggleFaq(this)">
                                  <h3>How do I get started?</h3>
                                  <i class="fa fa-chevron-down"></i>
                              </div>
                              <div class="faq-answer">
                                  <p>Getting started is easy! Simply create an account, verify your email, and you can immediately start browsing ads or posting your own. Our platform is designed to be user-friendly and intuitive for users of all experience levels.</p>
                              </div>
                          </div>
                      </div>
                      
                      <div class="faq-section">
                          <h2>Posting Ads</h2>
                          
                          <div class="faq-item">
                              <div class="faq-question" onclick="toggleFaq(this)">
                                  <h3>How do I post an advertisement?</h3>
                                  <i class="fa fa-chevron-down"></i>
                              </div>
                              <div class="faq-answer">
                                  <p>To post an ad, log into your account and click on the "Post Ad" button. Fill in the required information including title, description, category, price, and upload relevant images. Choose your ad type (normal, super, or VIP) and submit. Your ad will be reviewed and published within 24 hours.</p>
                              </div>
                          </div>
                          
                          <div class="faq-item">
                              <div class="faq-question" onclick="toggleFaq(this)">
                                  <h3>What are the different ad types?</h3>
                                  <i class="fa fa-chevron-down"></i>
                              </div>
                              <div class="faq-answer">
                                  <p>We offer three ad types: Normal (standard visibility), Super (enhanced visibility with priority placement), and VIP (premium placement with maximum exposure and additional features). Each type offers different levels of visibility and engagement.</p>
                              </div>
                          </div>
                          
                          <div class="faq-item">
                              <div class="faq-question" onclick="toggleFaq(this)">
                                  <h3>Can I edit my ad after posting?</h3>
                                  <i class="fa fa-chevron-down"></i>
                              </div>
                              <div class="faq-answer">
                                  <p>Yes, you can edit your ads after posting. Simply go to your dashboard, find the ad you want to edit, and click the edit button. You can modify the title, description, price, images, and other details. Changes are typically reflected within a few hours.</p>
                              </div>
                          </div>
                          
                          <div class="faq-item">
                              <div class="faq-question" onclick="toggleFaq(this)">
                                  <h3>How long do ads stay active?</h3>
                                  <i class="fa fa-chevron-down"></i>
                              </div>
                              <div class="faq-answer">
                                  <p>Normal ads typically stay active for 30 days, super ads for 45 days, and VIP ads for 60 days. You can renew your ad before it expires to keep it active. Inactive ads are automatically archived but can be reactivated.</p>
                              </div>
                          </div>
                      </div>
                      
                      <div class="faq-section">
                          <h2>Account & Security</h2>
                          
                          <div class="faq-item">
                              <div class="faq-question" onclick="toggleFaq(this)">
                                  <h3>How do I create an account?</h3>
                                  <i class="fa fa-chevron-down"></i>
                              </div>
                              <div class="faq-answer">
                                  <p>Creating an account is simple. Click on the "Sign Up" button, provide your name, email address, and create a secure password. Verify your email address through the confirmation link sent to your inbox, and you're ready to start using our platform.</p>
                              </div>
                          </div>
                          
                          <div class="faq-item">
                              <div class="faq-question" onclick="toggleFaq(this)">
                                  <h3>What if I forget my password?</h3>
                                  <i class="fa fa-chevron-down"></i>
                              </div>
                              <div class="faq-answer">
                                  <p>If you forget your password, click on the "Forgot Password" link on the login page. Enter your email address, and we'll send you a secure link to reset your password. Make sure to choose a strong, unique password for security.</p>
                              </div>
                          </div>
                          
                          <div class="faq-item">
                              <div class="faq-question" onclick="toggleFaq(this)">
                                  <h3>Is my information secure?</h3>
                                  <i class="fa fa-chevron-down"></i>
                              </div>
                              <div class="faq-answer">
                                  <p>Absolutely! We take security seriously and implement industry-standard measures to protect your personal information. This includes encryption, secure servers, and strict access controls. We never share your personal information with third parties without your consent.</p>
                              </div>
                          </div>
                      </div>
                      
                      <div class="faq-section">
                          <h2>Payment & Billing</h2>
                          
                          <div class="faq-item">
                              <div class="faq-question" onclick="toggleFaq(this)">
                                  <h3>What payment methods do you accept?</h3>
                                  <i class="fa fa-chevron-down"></i>
                              </div>
                              <div class="faq-answer">
                                  <p>We accept various payment methods including credit cards, debit cards, PayPal, and bank transfers. All payments are processed securely through our trusted payment partners. You'll receive a receipt for all transactions.</p>
                              </div>
                          </div>
                          
                          <div class="faq-item">
                              <div class="faq-question" onclick="toggleFaq(this)">
                                  <h3>Can I get a refund?</h3>
                                  <i class="fa fa-chevron-down"></i>
                              </div>
                              <div class="faq-answer">
                                  <p>We offer refunds within 7 days of purchase for premium services if you're not satisfied. Basic posting fees are non-refundable. Please contact our support team if you have any issues with your purchase.</p>
                              </div>
                          </div>
                      </div>
                      
                      <div class="faq-section">
                          <h2>Support & Contact</h2>
                          
                          <div class="faq-item">
                              <div class="faq-question" onclick="toggleFaq(this)">
                                  <h3>How can I contact customer support?</h3>
                                  <i class="fa fa-chevron-down"></i>
                              </div>
                              <div class="faq-answer">
                                  <p>Our customer support team is available through multiple channels: email at support@adsplatform.com, phone at +1 (555) 123-4567, and through our contact form. We typically respond within 24 hours during business days.</p>
                              </div>
                          </div>
                          
                          <div class="faq-item">
                              <div class="faq-question" onclick="toggleFaq(this)">
                                  <h3>What are your business hours?</h3>
                                  <i class="fa fa-chevron-down"></i>
                              </div>
                              <div class="faq-answer">
                                  <p>Our customer support team is available Monday through Friday, 9:00 AM to 6:00 PM local time. For urgent matters outside these hours, you can leave a message and we'll respond as soon as possible.</p>
                              </div>
                          </div>
                      </div>
                      
                      <div class="content-section">
                          <h2>Still Have Questions?</h2>
                          <p>If you couldn't find the answer to your question in our FAQ section, don't hesitate to reach out to us. Our friendly support team is here to help you with any questions or concerns you may have.</p>
                          <div class="contact-info">
                              <p><i class="fa fa-envelope"></i> Email: support@adsplatform.com</p>
                              <p><i class="fa fa-phone"></i> Phone: +1 (555) 123-4567</p>
                              <p><i class="fa fa-map-marker"></i> Address: 123 Business Street, City, State 12345</p>
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
