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
                          <h1><i class="fa fa-gavel"></i> Terms and Conditions</h1>
                          <p class="page-subtitle">Effective Date: September 6, 2025</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>Welcome to adzlk.com</h2>
                          <p>These Terms and Conditions outline the rules and regulations for using the adzlk.com website, located at https://adzlk.com. By accessing this website, you agree to comply with these Terms. If you do not agree, please discontinue use of adzlk.com.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>Cookies</h2>
                          <p>adzlk.com uses cookies to improve your browsing experience. By using adzlk.com, you consent to the use of required cookies.</p>
                          <p>Cookies are small text files placed on your device by a web server. They cannot run programs or spread viruses. Cookies are unique to you and can only be read by the server that created them.</p>
                          <p>We may use cookies to collect, store, and track information for statistical or marketing purposes. You may accept or decline optional cookies, but required cookies are essential for site operation and cannot be disabled. By accepting required cookies, you also consent to third-party cookies (e.g., embedded content, analytics, or ads).</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>License</h2>
                          <p>Unless otherwise stated, adzlk.com and/or its licensors own the intellectual property rights for all material on this site. All rights are reserved. You may access content for personal use, subject to these restrictions.</p>
                          <p>You must not:</p>
                          <ul>
                              <li>Republish material from adzlk.com</li>
                              <li>Sell, rent, or sub-license material from adzlk.com</li>
                              <li>Reproduce, duplicate, or copy material from adzlk.com</li>
                              <li>Redistribute content from adzlk.com</li>
                          </ul>
                          <p>This agreement begins on the date you start using the website.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>User Content</h2>
                          <p>Parts of this site allow users to post and share opinions, information, or listings. adzlk.com does not filter, edit, or review content before publication. Content reflects the views of users only, not those of adzlk.com, its staff, or affiliates.</p>
                          <p>adzlk.com is not responsible for user content or any damages arising from it. However, we reserve the right to monitor and remove content deemed inappropriate, offensive, unlawful, or in breach of these Terms.</p>
                          <p>By posting content, you confirm that:</p>
                          <ul>
                              <li>You have the right to post and have necessary permissions.</li>
                              <li>Content does not infringe on intellectual property rights of others.</li>
                              <li>Content is not defamatory, offensive, unlawful, or invasive of privacy.</li>
                              <li>Content will not be used to promote illegal activities.</li>
                          </ul>
                          <p>By posting on adzlk.com, you grant us a non-exclusive license to use, reproduce, and edit your content in any media or format.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>Hyperlinking to Our Content</h2>
                          <p>The following organizations may link to adzlk.com without prior approval:</p>
                          <ul>
                              <li>Government agencies</li>
                              <li>Search engines</li>
                              <li>News outlets</li>
                              <li>Online directories</li>
                              <li>Accredited businesses (excluding non-profit soliciting groups)</li>
                          </ul>
                          <p>Approved links must not be misleading, must not falsely imply endorsement, and must fit the context of the linking party's site.</p>
                          <p>Other organizations may request approval. We will consider requests if links are relevant, lawful, and beneficial to both parties.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>Content Liability</h2>
                          <p>We are not responsible for content appearing on external websites linked to adzlk.com. You agree to protect us from claims arising from your site if it links to ours. No links should appear on sites that could be interpreted as libelous, obscene, unlawful, or infringing third-party rights.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>Reservation of Rights</h2>
                          <p>adzlk.com reserves the right to request removal of any links to our site. By linking to adzlk.com, you agree to comply with such requests. We also reserve the right to update these Terms at any time.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>Removal of Links</h2>
                          <p>If you find any link on adzlk.com offensive, you may contact us. While we will consider all requests, we are not obligated to remove content or respond directly.</p>
                          <p>We do not guarantee that all site information is accurate or current, and we may update content at any time without notice.</p>
                      </div>
                      
                      <div class="content-section">
                          <h2>Disclaimer</h2>
                          <p>To the fullest extent permitted by law, adzlk.com excludes all warranties and conditions relating to this website and its use.</p>
                          <p>Nothing in this disclaimer will:</p>
                          <ul>
                              <li>Limit or exclude liability for death or personal injury caused by negligence.</li>
                              <li>Limit or exclude liability for fraud or misrepresentation.</li>
                              <li>Limit any liabilities not permitted under applicable law.</li>
                          </ul>
                          <p>As long as adzlk.com provides services free of charge, we will not be liable for any loss or damage of any kind.</p>
                      </div>
                  </div>
              </div>
          </section>
      </div>
@endsection
