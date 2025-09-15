@extends('frontend.layouts.app')

@section('title', 'How to Publish an Ad')

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
                          <h1><i class="fa fa-plus-circle"></i> How to Publish an Ad</h1>
                          <p class="page-subtitle">Step-by-step guide to successfully publish your advertisement</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>Getting Started</h2>
                          <p>Publishing an ad on our platform is simple and straightforward. Follow these steps to get your advertisement live and reaching potential customers.</p>
                      </div>
                      
                      <div class="steps-container">
                          <div class="step-item">
                              <div class="step-number">1</div>
                              <div class="step-content">
                                  <h3>Create an Account</h3>
                                  <p>If you don't have an account yet, start by creating one:</p>
                                  <ul>
                                      <li>Click on the "Login" button in the top menu</li>
                                      <li>Choose "Sign Up" or "Create Account"</li>
                                      <li>Fill in your details: name, email, and phone number</li>
                                      <li>Verify your email address</li>
                                      <li>Complete your profile setup</li>
                                  </ul>
                                  <div class="step-note">
                                      <i class="fa fa-info-circle"></i>
                                      <strong>Note:</strong> You must be logged in to publish ads.
                                  </div>
                              </div>
                          </div>
                          
                          <div class="step-item">
                              <div class="step-number">2</div>
                              <div class="step-content">
                                  <h3>Access the Dashboard</h3>
                                  <p>Once logged in, access your dashboard:</p>
                                  <ul>
                                      <li>Click on the "Dashboard" button in the top menu</li>
                                      <li>You'll see your account overview and available options</li>
                                      <li>Look for the "New Ads" button in the form buttons section</li>
                                      <li>Click on "New Ads" to start creating your advertisement</li>
                                  </ul>
                              </div>
                          </div>
                          
                          <div class="step-item">
                              <div class="step-number">3</div>
                              <div class="step-content">
                                  <h3>Fill in Ad Details</h3>
                                  <p>Complete the ad creation form with accurate information:</p>
                                  <ul>
                                      <li><strong>Title:</strong> Create a clear, descriptive title (max 100 characters)</li>
                                      <li><strong>Category:</strong> Select the most appropriate category for your ad</li>
                                      <li><strong>Ad Type:</strong> Choose between Normal, Super, or VIP ads</li>
                                      <li><strong>Location:</strong> Specify where your item/service is located</li>
                                      <li><strong>Price:</strong> Enter the price in Pakistani Rupees (Rs.)</li>
                                      <li><strong>Description:</strong> Provide detailed information about your item/service</li>
                                      <li><strong>Image:</strong> Upload a clear, high-quality image (required)</li>
                                  </ul>
                                  <div class="step-note">
                                      <i class="fa fa-lightbulb"></i>
                                      <strong>Tip:</strong> Better descriptions and images lead to more views and responses.
                                  </div>
                              </div>
                          </div>
                          
                          <div class="step-item">
                              <div class="step-number">4</div>
                              <div class="step-content">
                                  <h3>Contact Information</h3>
                                  <p>Set up your contact preferences:</p>
                                  <ul>
                                      <li>Your phone number will be automatically filled (from your profile)</li>
                                      <li>Check the boxes for platforms where you're available:
                                          <ul>
                                              <li>WhatsApp</li>
                                              <li>Telegram</li>
                                              <li>Imo</li>
                                              <li>Viber</li>
                                          </ul>
                                      </li>
                                      <li>If you need to change your phone number, contact support</li>
                                  </ul>
                              </div>
                          </div>
                          
                          <div class="step-item">
                              <div class="step-number">5</div>
                              <div class="step-content">
                                  <h3>Profile Verification (If Required)</h3>
                                  <p>Some categories require profile verification:</p>
                                  <ul>
                                      <li>If posting in "Live Cam" or other sensitive categories, verification is recommended</li>
                                      <li>Check the "Profile Verification" checkbox if prompted</li>
                                      <li>Verification costs Rs. 500 (one-time fee)</li>
                                      <li>This adds a verified badge to your profile</li>
                                  </ul>
                                  <div class="step-note">
                                      <i class="fa fa-shield"></i>
                                      <strong>Security:</strong> Verification helps build trust with potential customers.
                                  </div>
                              </div>
                          </div>
                          
                          <div class="step-item">
                              <div class="step-number">6</div>
                              <div class="step-content">
                                  <h3>Submit and Pay</h3>
                                  <p>Complete the submission process:</p>
                                  <ul>
                                      <li>Review all your information carefully</li>
                                      <li>Click the "Submit" button</li>
                                      <li>You'll be redirected to the checkout page</li>
                                      <li>Review the payment summary:
                                          <ul>
                                              <li>Ad price (based on ad type)</li>
                                              <li>Verification fee (if applicable)</li>
                                              <li>Total amount</li>
                                          </ul>
                                      </li>
                                      <li>Click "Pay Rs. [amount]" to proceed</li>
                                  </ul>
                              </div>
                          </div>
                          
                          <div class="step-item">
                              <div class="step-number">7</div>
                              <div class="step-content">
                                  <h3>Payment Processing</h3>
                                  <p>Complete the payment to activate your ad:</p>
                                  <ul>
                                      <li>Contact us for payment details</li>
                                      <li>Send payment receipt via WhatsApp</li>
                                      <li>Include your ad's phone number</li>
                                      <li>Your ad will be reviewed and activated within 24 hours</li>
                                  </ul>
                                  <div class="step-note">
                                      <i class="fa fa-clock"></i>
                                      <strong>Processing Time:</strong> Ads are typically reviewed and published within 24 hours.
                                  </div>
                              </div>
                          </div>
                          
                          <div class="step-item">
                              <div class="step-number">8</div>
                              <div class="step-content">
                                  <h3>Ad Goes Live</h3>
                                  <p>Once approved, your ad will be live:</p>
                                  <ul>
                                      <li>Your ad will appear in the relevant category</li>
                                      <li>It will be visible to all users browsing the platform</li>
                                      <li>You can track views and likes in your dashboard</li>
                                      <li>Potential customers can contact you through your preferred platforms</li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                      
                      <div class="content-section">
                          <h2>Ad Types and Pricing</h2>
                          <div class="pricing-grid">
                              <div class="pricing-card">
                                  <div class="card-header">
                                      <i class="fa fa-star"></i>
                                      <h3>Normal Ad</h3>
                                  </div>
                                  <div class="price">Free</div>
                                  <ul class="features">
                                      <li>30-day visibility</li>
                                      <li>Basic search optimization</li>
                                      <li>Standard placement</li>
                                      <li>Image upload support</li>
                                  </ul>
                              </div>
                              
                              <div class="pricing-card featured">
                                  <div class="card-header">
                                      <i class="fa fa-rocket"></i>
                                      <h3>Super Ad</h3>
                                  </div>
                                  <div class="price">Rs. 1,500</div>
                                  <ul class="features">
                                      <li>45-day visibility</li>
                                      <li>Priority placement</li>
                                      <li>Enhanced search ranking</li>
                                      <li>Analytics dashboard</li>
                                      <li>Social media sharing</li>
                                  </ul>
                              </div>
                              
                              <div class="pricing-card">
                                  <div class="card-header">
                                      <i class="fa fa-crown"></i>
                                      <h3>VIP Ad</h3>
                                  </div>
                                  <div class="price">Rs. 10,000</div>
                                  <ul class="features">
                                      <li>60-day visibility</li>
                                      <li>Top placement in all categories</li>
                                      <li>Unlimited image uploads</li>
                                      <li>Premium customer support</li>
                                      <li>Advanced analytics</li>
                                      <li>Cross-category promotion</li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                      
                      <div class="content-section">
                          <h2>Best Practices</h2>
                          <div class="tips-grid">
                              <div class="tip-item">
                                  <i class="fa fa-camera"></i>
                                  <h3>High-Quality Images</h3>
                                  <p>Use clear, well-lit photos that showcase your item or service from multiple angles.</p>
                              </div>
                              
                              <div class="tip-item">
                                  <i class="fa fa-edit"></i>
                                  <h3>Detailed Descriptions</h3>
                                  <p>Provide comprehensive information including features, condition, and any relevant details.</p>
                              </div>
                              
                              <div class="tip-item">
                                  <i class="fa fa-tag"></i>
                                  <h3>Competitive Pricing</h3>
                                  <p>Research similar items to set a fair and competitive price that attracts buyers.</p>
                              </div>
                              
                              <div class="tip-item">
                                  <i class="fa fa-map-marker"></i>
                                  <h3>Accurate Location</h3>
                                  <p>Specify your exact location to help buyers understand delivery or pickup options.</p>
                              </div>
                              
                              <div class="tip-item">
                                  <i class="fa fa-clock"></i>
                                  <h3>Quick Response</h3>
                                  <p>Respond promptly to inquiries to increase your chances of making a sale.</p>
                              </div>
                              
                              <div class="tip-item">
                                  <i class="fa fa-shield"></i>
                                  <h3>Profile Verification</h3>
                                  <p>Get your profile verified to build trust and increase response rates.</p>
                              </div>
                          </div>
                      </div>
                      
                      <div class="content-section">
                          <h2>Managing Your Ads</h2>
                          <p>Once your ads are live, you can manage them from your dashboard:</p>
                          <ul>
                              <li><strong>View All Ads:</strong> See all your published ads in the "My Ads" section</li>
                              <li><strong>Track Performance:</strong> Monitor views, likes, and engagement for each ad</li>
                              <li><strong>Edit Ads:</strong> Update information, prices, or images as needed</li>
                              <li><strong>Delete Ads:</strong> Remove ads that are no longer relevant</li>
                              <li><strong>Recover Deleted Ads:</strong> Restore accidentally deleted ads within 30 days</li>
                          </ul>
                      </div>
                      
                      <div class="content-section">
                          <h2>Need Help?</h2>
                          <p>If you encounter any issues or have questions about publishing ads, our support team is here to help:</p>
                          <div class="contact-info">
                              <p><i class="fa fa-envelope"></i> Email: support@adsplatform.com</p>
                              <p><i class="fa fa-phone"></i> Phone: +1 (555) 123-4567</p>
                              <p><i class="fa fa-whatsapp"></i> WhatsApp: Contact us for immediate assistance</p>
                              <p><i class="fa fa-clock"></i> Business Hours: Monday - Friday, 9:00 AM - 6:00 PM</p>
                          </div>
                      </div>
                      
                      <div class="content-section">
                          <h2>Ready to Get Started?</h2>
                          <p>Now that you know how to publish an ad, why not create your first advertisement?</p>
                          <div class="cta-buttons">
                              @if(Auth::guard('poster')->check())
                                  <button class="btn-primary" onclick="location.href='{{ route('dashboard') }}'">
                                      <i class="fa fa-plus"></i> Create Your First Ad
                                  </button>
                              @else
                                  <button class="btn-primary" onclick="location.href='{{ route('login') }}'">
                                      <i class="fa fa-user-plus"></i> Sign Up & Start
                                  </button>
                              @endif
                              <button class="btn-secondary" onclick="location.href='{{ route('home') }}'">
                                  <i class="fa fa-search"></i> Browse Existing Ads
                              </button>
                          </div>
                      </div>
                  </div>
              </div>
          </section>
      </div>
@endsection
