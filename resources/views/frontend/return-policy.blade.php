@extends('frontend.layouts.app')

@section('title', 'Return Policy')

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
                          <h1><i class="fa fa-undo"></i> Return Policy</h1>
                          <p class="page-subtitle">Understanding our refund and return policies</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>Overview</h2>
                          <p>We want you to be completely satisfied with our services. This return policy outlines the terms and conditions for refunds, returns, and cancellations of our advertising services and premium features.</p>
                          <p>Please read this policy carefully before making a purchase. By using our services, you agree to the terms outlined below.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>Service Refund Policy</h2>
                          
                          <div class="refund-category">
                              <h3>Premium Advertising Services</h3>
                              <p>For our premium advertising services (Super Ads, VIP Ads, and additional features), we offer the following refund terms:</p>
                              <ul>
                                  <li><strong>7-Day Money-Back Guarantee:</strong> Full refund available within 7 days of purchase if you're not satisfied with the service</li>
                                  <li><strong>Partial Refunds:</strong> Pro-rated refunds may be available for unused portions of monthly/annual subscriptions</li>
                                  <li><strong>Service Issues:</strong> Full refund if we cannot deliver the promised service due to technical issues on our end</li>
                              </ul>
                          </div>
                          
                          <div class="refund-category">
                              <h3>Additional Services</h3>
                              <p>For professional photography, copywriting, and other add-on services:</p>
                              <ul>
                                  <li><strong>Before Service Delivery:</strong> Full refund if cancelled before work begins</li>
                                  <li><strong>During Service:</strong> Partial refund based on work completed</li>
                                  <li><strong>After Delivery:</strong> Refund only if service doesn't meet agreed-upon specifications</li>
                              </ul>
                          </div>
                          
                          <div class="refund-category">
                              <h3>Non-Refundable Services</h3>
                              <p>The following services are non-refundable:</p>
                              <ul>
                                  <li>Basic ad posting fees (if applicable)</li>
                                  <li>Completed professional services</li>
                                  <li>Analytics and reporting services after delivery</li>
                                  <li>Social media promotion after campaign launch</li>
                              </ul>
                          </div>
                      </div>
                      
                      <div class="content-section">
                          <h2>Refund Process</h2>
                          
                          <div class="process-steps">
                              <div class="step">
                                  <div class="step-number">1</div>
                                  <h3>Submit Request</h3>
                                  <p>Contact our customer support team with your refund request, including your order number and reason for the refund.</p>
                              </div>
                              
                              <div class="step">
                                  <div class="step-number">2</div>
                                  <h3>Review Process</h3>
                                  <p>Our team will review your request within 2-3 business days and may request additional information if needed.</p>
                              </div>
                              
                              <div class="step">
                                  <div class="step-number">3</div>
                                  <h3>Approval & Processing</h3>
                                  <p>Once approved, refunds are processed within 5-10 business days, depending on your payment method.</p>
                              </div>
                              
                              <div class="step">
                                  <div class="step-number">4</div>
                                  <h3>Confirmation</h3>
                                  <p>You'll receive an email confirmation when your refund has been processed and issued.</p>
                              </div>
                          </div>
                      </div>
                      
                      <div class="content-section">
                          <h2>Refund Eligibility Requirements</h2>
                          <p>To be eligible for a refund, you must meet the following criteria:</p>
                          <ul>
                              <li>Submit your refund request within the specified time frame</li>
                              <li>Provide a valid reason for the refund request</li>
                              <li>Include your order number and account information</li>
                              <li>Not have violated our terms of service</li>
                              <li>Not have used the service extensively (for service-related refunds)</li>
                          </ul>
                      </div>
                      
                      <div class="content-section">
                          <h2>Refund Methods</h2>
                          <p>Refunds are issued through the same payment method used for the original purchase:</p>
                          <ul>
                              <li><strong>Credit/Debit Cards:</strong> 5-10 business days to appear on your statement</li>
                              <li><strong>PayPal:</strong> 3-5 business days to your PayPal account</li>
                              <li><strong>Bank Transfers:</strong> 7-14 business days to your bank account</li>
                          </ul>
                          <p><strong>Note:</strong> Processing times may vary depending on your financial institution and payment processor.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>Cancellation Policy</h2>
                          
                          <div class="cancellation-info">
                              <h3>Subscription Cancellations</h3>
                              <p>You may cancel your subscription at any time:</p>
                              <ul>
                                  <li><strong>Immediate Effect:</strong> Cancellation takes effect at the end of your current billing period</li>
                                  <li><strong>No Refund:</strong> No refund for the current billing period</li>
                                  <li><strong>Service Continuation:</strong> Services remain active until the end of the paid period</li>
                                  <li><strong>Data Retention:</strong> Your ad data is retained for 30 days after cancellation</li>
                              </ul>
                          </div>
                          
                          <div class="cancellation-info">
                              <h3>Service Cancellations</h3>
                              <p>For one-time services and add-ons:</p>
                              <ul>
                                  <li><strong>Before Service Begins:</strong> Full refund available</li>
                                  <li><strong>During Service:</strong> Partial refund based on work completed</li>
                                  <li><strong>After Completion:</strong> No refund unless service doesn't meet specifications</li>
                              </ul>
                          </div>
                      </div>
                      
                      <div class="content-section">
                          <h2>Exceptions and Special Circumstances</h2>
                          <p>We understand that exceptional circumstances may arise. In such cases, we may consider refunds outside our standard policy:</p>
                          <ul>
                              <li>Technical issues preventing service delivery</li>
                              <li>Billing errors or duplicate charges</li>
                              <li>Service unavailability due to platform maintenance</li>
                              <li>Extenuating personal circumstances (case-by-case basis)</li>
                          </ul>
                          <p>All exceptions are reviewed on a case-by-case basis by our management team.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>Dispute Resolution</h2>
                          <p>If you disagree with a refund decision:</p>
                          <ol>
                              <li><strong>Contact Support:</strong> Reach out to our customer support team for clarification</li>
                              <li><strong>Escalation:</strong> Request escalation to a supervisor if needed</li>
                              <li><strong>Documentation:</strong> Provide any additional documentation or evidence</li>
                              <li><strong>Final Review:</strong> Final decision made by our management team</li>
                          </ol>
                          <p>We are committed to fair and transparent resolution of all disputes.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>Contact Information</h2>
                          <p>For refund requests, cancellations, or questions about this policy, please contact us:</p>
                          <div class="contact-info">
                              <p><i class="fa fa-envelope"></i> Email: refunds@adsplatform.com</p>
                              <p><i class="fa fa-phone"></i> Phone: +1 (555) 123-4567</p>
                              <p><i class="fa fa-map-marker"></i> Address: 123 Business Street, City, State 12345</p>
                              <p><i class="fa fa-clock"></i> Business Hours: Monday - Friday, 9:00 AM - 6:00 PM</p>
                          </div>
                      </div>
                      
                      <div class="content-section">
                          <h2>Policy Updates</h2>
                          <p>We reserve the right to update this return policy at any time. Changes will be effective immediately upon posting on our website. We encourage you to review this policy periodically.</p>
                          <p>Continued use of our services after policy changes constitutes acceptance of the updated terms.</p>
                      </div>
                      
                      <div class="content-section">
                          <p class="last-updated"><strong>Last Updated:</strong> {{ date('F d, Y') }}</p>
                      </div>
                  </div>
              </div>
          </section>
      </div>
@endsection
