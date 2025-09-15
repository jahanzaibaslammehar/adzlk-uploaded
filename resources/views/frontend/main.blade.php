@extends('frontend.layouts.app')

@section('title', 'Home Page')

@section('content')

        <div class="menu">
          
          <button class="btnPublish" onclick="location.href='{{ route('how-to-publish') }}'">How to Publish Ads?</button>
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
                <li onclick="location.href='{{ route('home') }}'" style="cursor: pointer; {{ !isset($selectedCategory) ? 'color: #E84393; font-weight: 600;' : '' }}">
                  All Categories
                </li>
                @foreach($category as $item)
                  <li onclick="location.href='{{ route('category.show', $item->id) }}'" style="cursor: pointer; {{ isset($selectedCategory) && $selectedCategory->id == $item->id ? 'color: #E84393; font-weight: 600;' : '' }}">
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
                  
                  @if(isset($selectedCategory))
                  <div class="category-header" style="padding: 15px 20px; margin-bottom: 20px; width: 60%; margin-left: auto; margin-right: auto; text-align: center;">
                      <h2 style="font-size: 1.5rem; margin: 0 0 8px 0;">Showing ads in: <span class="category-name">{{ $selectedCategory->name }}</span></h2>
                      <a href="{{ route('home') }}" class="clear-filter" style="font-size: 0.9rem;">← Back to All Categories</a>
                  </div>
                  @endif
                  
                  @if(isset($query))
                  <div class="category-header" style="padding: 15px 20px; margin-bottom: 20px; width: 60%; margin-left: auto; margin-right: auto; text-align: center;">
                      <h2 style="font-size: 1.5rem; margin: 0 0 8px 0;">Search Results for: <span class="category-name">"{{ $query }}"</span></h2>
                      <p style="margin: 5px 0; color: #666;">Found {{ $ads->total() }} ads</p>
                      <a href="{{ route('home') }}" class="clear-filter" style="font-size: 0.9rem;">← Back to All Ads</a>
                  </div>
                  @endif
                  
                  <div class="ads-grid">
                      
                      @foreach($ads as $ad)
                      <!-- Dynamic Ad Card -->
                    <div class="ad-card {{ $ad->effective_ad_type == 2 ? 'yellow' : ($ad->effective_ad_type == 3 ? 'blue' : 'normal') }}" onclick="location.href='{{ route('ad.show', $ad->id) }}'" style="cursor: pointer;">

                        <div class="badge badge-desktop {{ $ad->effective_ad_type == 1 ? 'badge-normal' : ($ad->effective_ad_type == 2 ? 'badge-super' : 'badge-vip') }}">{{ $ad->effective_ad_type == 1 ? 'Normal' : ($ad->effective_ad_type == 2 ? 'Super' : 'VIP') }}</div>

                            <div class="meta mobileShow">
                                <div class="views">
                                <div class="badge {{ $ad->effective_ad_type == 1 ? 'badge-normal' : ($ad->effective_ad_type == 2 ? 'badge-super' : 'badge-vip') }}">{{ $ad->effective_ad_type == 1 ? 'Normal' : ($ad->effective_ad_type == 2 ? 'Super' : 'VIP') }}</div>
                                  <span class="like-container" onclick="event.stopPropagation(); toggleLike({{ $ad->id }}, this)">
                                    <i class="fa fa-heart saved-heart-icon" data-ad-id="{{ $ad->id }}"></i> 
                                    <span class="likes-count">{{ $ad->total_likes }}</span> Likes
                                  </span>
                                  <span>{{ $ad->total_views }} Views</span>
                                  @if($ad->poster->is_verified)
                                    <span class="verified-badge"><i class="fa fa-check-circle"></i> Verified</span>
                                  @endif
                                </div>
                                  
                                <div class="dots" onclick="event.stopPropagation(); toggleReportMenu(this, {{ $ad->id }})"><i class="fa fa-ellipsis-h"></i></div>
                            </div>
                        <div class="ad-content">
                          <div class="img">
                            <img src="{{ url('public/storage/' . ($ad->thumbnail ?? $ad->image)) }}" />    
                            <p class="mobile-time">{{ $ad->created_at->diffForHumans() }}</p>            
                          </div> 
                          <div class="details">
                            <div class="title">
                              <h3>{{ $ad->title }}</h3>
                              <span class="ago">{{ $ad->created_at->diffForHumans() }}</span>
                            </div>
                            <p>{!! Str::words(preg_replace('/\s+/', ' ', strip_tags($ad->description)), 40, '...') !!}</p>
                            <div class="meta">
                                <div class="views">
                                  <span class="like-container" onclick="event.stopPropagation(); toggleLike({{ $ad->id }}, this)">
                                    <i class="fa fa-heart saved-heart-icon" data-ad-id="{{ $ad->id }}"></i> 
                                    <span class="likes-count">{{ $ad->total_likes }}</span> Likes
                                  </span>
                                  <span>{{ $ad->total_views }} Views</span>
                                  @if($ad->poster->is_verified)
                                    <span class="verified-badge"><i class="fa fa-check-circle"></i> Verified</span>
                                  @endif
                                </div>
                                  
                                <div class="dots" onclick="event.stopPropagation(); toggleReportMenu(this, {{ $ad->id }})"><i class="fa fa-ellipsis-h"></i></div>
                            </div>
                          </div>
                        </div>
                      </div>
                  
                      @endforeach
                  </div>

                  <!-- Pagination Section -->
                  @if($ads->hasPages())
                  <div class="pagination-container">
                      <div class="pagination-info">
                          <span>Showing <strong>{{ $ads->firstItem() ?? 0 }}</strong> to <strong>{{ $ads->lastItem() ?? 0 }}</strong> of <strong>{{ $ads->total() }}</strong> ads</span>
                      </div>
                      <div class="pagination-controls">
                          {{-- Previous Button --}}
                          @if($ads->onFirstPage())
                              <button class="pagination-btn prev-btn" disabled>
                                  <i class="fa fa-chevron-left"></i>
                                  Previous
                              </button>
                          @else
                              <a href="{{ $ads->previousPageUrl() }}" class="pagination-btn prev-btn">
                                  <i class="fa fa-chevron-left"></i>
                                  Previous
                              </a>
                          @endif
                          
                          {{-- Page Numbers --}}
                          <div class="page-numbers">
                              @php
                                  $currentPage = $ads->currentPage();
                                  $lastPage = $ads->lastPage();
                                  $start = max(1, $currentPage - 2);
                                  $end = min($lastPage, $currentPage + 2);
                              @endphp
                              
                              {{-- First page --}}
                              @if($start > 1)
                                  <a href="{{ $ads->url(1) }}" class="page-number">1</a>
                                  @if($start > 2)
                                      <span class="page-dots">...</span>
                                  @endif
                              @endif
                              
                              {{-- Page range around current page --}}
                              @for($page = $start; $page <= $end; $page++)
                                  @if($page == $currentPage)
                                      <span class="page-number active">{{ $page }}</span>
                                  @else
                                      <a href="{{ $ads->url($page) }}" class="page-number">{{ $page }}</a>
                                  @endif
                              @endfor
                              
                              {{-- Last page --}}
                              @if($end < $lastPage)
                                  @if($end < $lastPage - 1)
                                      <span class="page-dots">...</span>
                                  @endif
                                  <a href="{{ $ads->url($lastPage) }}" class="page-number">{{ $lastPage }}</a>
                              @endif
                          </div>
                          
                          {{-- Next Button --}}
                          @if($ads->hasMorePages())
                              <a href="{{ $ads->nextPageUrl() }}" class="pagination-btn next-btn">
                                  Next
                                  <i class="fa fa-chevron-right"></i>
                              </a>
                          @else
                              <button class="pagination-btn next-btn" disabled>
                                  Next
                                  <i class="fa fa-chevron-right"></i>
                              </button>
                          @endif
                      </div>
                  </div>
                  @endif
                    
              </div>
          </section>
      </div>
@endsection