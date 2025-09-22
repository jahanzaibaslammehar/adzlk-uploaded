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
                    <button class="btnSaved" onclick="location.href='{{ route('saved-ads') }}'"><i class="fa fa-heart"
                            style="color: #C3891B; text-shadow: 0 0 3px #ffff;"></i>Saved Ads</button>


                    <button class="loginBtn" onclick="location.href='{{ route('logout') }}'"><i class="fa fa-logout"
                            style="color: #002280; text-shadow: 0 0 3px #ffff;"></i>Logout</button>
                   

                </div>
                <div class="btn-dashboard">
                    <button class="btnDashboard"><i class="fa fa-dashboard"
                        style="color: #ffff; text-shadow: 0 0 3px rgba(0,0,0,0.3);"></i>Dashboard</button>
                    @if(auth('poster')->user()->is_verified)
                        <button class="btnVerifyProfile verified" disabled>
                            <i class="fa fa-check-circle" style="color: #28a745; text-shadow: 0 0 3px rgba(0,0,0,0.3);"></i>Verified
                        </button>
                    @else
                        <button class="btnVerifyProfile">
                            <i class="fa fa-times-circle" style="color: #dc3545; text-shadow: 0 0 3px rgba(0,0,0,0.3);"></i>Not Verified
                        </button>
                    @endif
                </div>
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
                        <div class="dashboard">
                            <div class="stats">
                                <div class="account-id">
                                    <h4>Account ID</h4>
                                    <p>{{ auth('poster')->user()->id }}</p>
                                </div>
                                <div class="account-type">
                                    <h4>Account Type</h4>
                                    <p>User</p>
                                </div>
                                <div class="all-ads">
                                    <h4>All Ads</h4>
                                    <p>{{ $ads->count() }}</p>
                                </div>
                                <!-- <div class="credit">
                                    <h4>Credit</h4>
                                    <p>Rs. 0.00</p>
                                </div> -->
                            </div>

                            <div class="form-buttons">
                                <button class="my-ads" onclick="showForm('my-ads-form', this)">My Ads</button>
                                <button class="new-ads" onclick="showForm('new-ads-form', this)">New Ads</button>
                                <button class="btn-recover" onclick="showForm('recover-form', this)">Recover</button>
                                <button class="btn-topup" onclick="showForm('topup-form', this)">Topup</button>
                            </div>

                            <div id="my-ads-form" class="form-container">
                                <div class="my-ad-query">
                                    <h3>For Any Question, Please Contact Admin</h3>
                                    @if($setting && $setting->subscribe_whatsapp_link)
                                        <button onclick="openWhatsApp('{{ $setting->subscribe_whatsapp_link }}')" style="cursor: pointer;"><i class="fa fa-whatsapp"></i>Contact Admin</button>
                                    @else
                                        <button style="cursor: pointer;"><i class="fa fa-whatsapp"></i>Contact Admin</button>
                                    @endif
                                </div>
                                
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                
                                @if(session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                
                                <div class="my-ad-list">
                                    @if($ads->count() > 0)
                                        <div class="ads-grid">
                                            @foreach($ads as $ad)
                                                <div class="ad-item">
                                                    <div class="ad-image">
                                                        @if($ad->image)
                                                            <img src="{{ asset('storage/' . $ad->image) }}" alt="{{ $ad->title }}">
                                                        @else
                                                            <div class="no-image">No Image</div>
                                                        @endif
                                                    </div>
                                                    <div class="ad-details">
                                                        <div class="ad-header">
                                                            <h4>{{ $ad->title }}</h4>
                                                            <span class="ad-status {{ $ad->is_active ? 'active' : 'inactive' }}">
                                                                {{ $ad->is_active ? 'Active' : 'Inactive' }}
                                                            </span>
                                                        </div>
                                                        
                                                        <div class="ad-info">
                                                            <div class="info-row">
                                                                <span class="info-label">Category:</span>
                                                                <span class="info-value">{{ $ad->category->name ?? 'No Category' }}</span>
                                                            </div>
                                                            <div class="info-row">
                                                                <span class="info-label">Ad Type:</span>
                                                                <span class="info-value ad-type">
                                                                    @if($ad->effective_ad_type == 1)
                                                                        <span class="type-badge normal">Normal</span>
                                                                    @elseif($ad->effective_ad_type == 2)
                                                                        <span class="type-badge super">Super</span>
                                                                    @elseif($ad->effective_ad_type == 3)
                                                                        <span class="type-badge vip">VIP</span>
                                                                    @else
                                                                        <span class="type-badge normal">Normal</span>
                                                                    @endif
                                                                </span>
                                                            </div>
                                                            <div class="info-row">
                                                                <span class="info-label">Location:</span>
                                                                <span class="info-value">{{ $ad->location }}</span>
                                                            </div>
                                                            <div class="info-row">
                                                                <span class="info-label">Price:</span>
                                                                <span class="info-value price">Rs. {{ number_format($ad->price) }}</span>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="ad-stats">
                                                            <div class="stat-item">
                                                                <i class="fa fa-heart"></i>
                                                                <span>{{ number_format($ad->total_likes ?? 0) }}</span>
                                                            </div>
                                                            <div class="stat-item">
                                                                <i class="fa fa-eye"></i>
                                                                <span>{{ number_format($ad->total_views ?? 0) }}</span>
                                                            </div>
                                                            <div class="stat-item">
                                                                <i class="fa fa-calendar"></i>
                                                                <span>{{ $ad->created_at->format('M d, Y') }}</span>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="ad-actions">
                                                            <form action="{{ route('delete-ad', $ad->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this ad?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn-delete">
                                                                    <i class="fa fa-trash"></i> Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        
                                        @if($ads->hasPages())
                                            <div class="pagination">
                                                {{ $ads->links() }}
                                            </div>
                                        @endif
                                    @else
                                        <div class="no-ads">
                                            <p>No ads found. Create your first ad!</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div id="new-ads-form" class="form-container">
                                <form action="{{ route('create-ad') }}" class="create-form" method="post" enctype="multipart/form-data" onsubmit="return handleFormSubmission()">
                                    @csrf
                                    <div class="input-fields">
                                        <input type="text" name="title" placeholder="Title" required>
                                    </div>
                                    <div class="input-fields">
                                        <select name="category_id" id="" aria-placeholder="Category" class="category" required>
                                            <option value="" aria-placeholder="Category">Category</option>
                                            @foreach($category as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if($setting->is_stripe_enabled)
                                        <div class="input-fields">
                                            <select name="ad_type" id="" aria-placeholder="Category" class="category" required>
                                                <option value="" aria-placeholder="Category">Ad Type & Prices</option>
                                                @foreach($adType as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }} (Rs. {{ $item->price }})</option>
                                                @endforeach 
                                            </select>
                                        </div>
                                    @endif
                                    <div class="input-fields">
                                        <input type="text" name="location" placeholder="Location" required>
                                        <input type="text" name="price" placeholder="Price" required>

                                    </div>
                                    <div class="input-fields">
                                        <!-- <label for="description">Description</label> -->
                                        <div id="description" class="ckeditor-container"></div>
                                        <textarea name="description" id="description-hidden" style="display: none;"></textarea>
                                    </div>

                                    <div class="input-fields">
                                        <label for="ad-image">Upload Image</label>
                                        <input type="file" name="image" id="ad-image" accept="image/*" required>
                                    </div>

                                    <div class="contact-field">
                                        <select name="country_code" id="country_code" aria-placeholder="+94" class="country-code" disabled>
                                            <option selected value="+94" aria-placeholder="+94">+94</option>
                                        </select>
                                        @php
                                            $userPhone = auth('poster')->user()->phone;
                                            // Remove first 3 digits if phone is longer than 3 digits
                                            $displayPhone = (strlen($userPhone) > 3) ? substr($userPhone, 3) : '';
                                        @endphp
                                        <input type="text" name="phone" id="phone_input" placeholder="Contact Number" value="{{ $displayPhone }}" disabled>
                                        <a href="#" id="change_phone_btn" onclick="togglePhoneEdit(); return false;">Change Phone</a>
                                    </div>
                                    <div class="checkbox-field">
                                        <div class="checkbox-item">
                                            <input type="checkbox" class="available_checkboxes" name="available_on_whatsapp" id="available_on_whatsapp">
                                            <label for="available_on_whatsapp">
                                                <i class="fa fa-whatsapp"></i>
                                                <span>Available on WhatsApp</span>
                                            </label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="checkbox" class="available_checkboxes" name="available_on_imo" id="available_on_imo">
                                            <label for="available_on_imo">
                                                <i class="fa fa-comment"></i>
                                                <span>Available on Imo</span>
                                            </label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="checkbox" class="available_checkboxes" name="available_on_viber" id="available_on_viber">
                                            <label for="available_on_viber">
                                                <i class="fa fa-phone"></i>
                                                <span>Available on Viber</span>
                                            </label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="checkbox" class="available_checkboxes" name="available_on_telegram" id="available_on_telegram">
                                            <label for="available_on_telegram">
                                                <i class="fa fa-paper-plane"></i>
                                                <span>Available on Telegram</span>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <!-- Verification checkbox for Live Cam category -->
                                    <div id="verification-checkbox" class="verification-field" style="display: none;">
                                        <div class="verification-alert">
                                            <input type="checkbox" name="profile_verification" id="profile_verification">
                                            <label for="profile_verification">
                                            Live Cam සඳහා Verified ගිණුම් වලට වැඩි පාරිභෝගික අවධානය ලැබෙන බැවින් ඔබගේ ගිණුම verify කිරීමෙන් වැඩි ආදායමක් ලබා ගත හැක. Verified ලේබලය ලබා ගැනීමට රු.6000ක තැන්පත් මුදලක‍් අය කරනු ලැබේ.

                                            In the Live Cam category, verified profiles receive more customer attention, so by verifying your profile you can earn more. A fee of Rs.6000 will be charged to get the verified label.
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="submit">Submit</button>
                                </form>
                            </div>
                            <div id="recover-form" class="form-container">
                                <div class="recover-header">
                                    <h3>Recover Deleted Ads</h3>
                                    <p>Restore your previously deleted ads</p>
                                </div>
                                
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                
                                @if(session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                
                                <div class="my-ad-list">
                                    @if($deletedAds->count() > 0)
                                        <div class="ads-grid">
                                            @foreach($deletedAds as $ad)
                                                <div class="ad-item deleted">
                                                    <div class="ad-image">
                                                        @if($ad->image)
                                                            <img src="{{ asset('storage/' . $ad->image) }}" alt="{{ $ad->title }}">
                                                        @else
                                                            <div class="no-image">No Image</div>
                                                        @endif
                                                    </div>
                                                    <div class="ad-details">
                                                        <div class="ad-header">
                                                            <h4>{{ $ad->title }}</h4>
                                                            <span class="ad-status deleted">Deleted</span>
                                                        </div>
                                                        
                                                        <div class="ad-info">
                                                            <div class="info-row">
                                                                <span class="info-label">Category:</span>
                                                                <span class="info-value">{{ $ad->category->name ?? 'No Category' }}</span>
                                                            </div>
                                                            <div class="info-row">
                                                                <span class="info-label">Ad Type:</span>
                                                                <span class="info-value ad-type">
                                                                    @if($ad->effective_ad_type == 1)
                                                                        <span class="type-badge normal">Normal</span>
                                                                    @elseif($ad->effective_ad_type == 2)
                                                                        <span class="type-badge super">Super</span>
                                                                    @elseif($ad->effective_ad_type == 3)
                                                                        <span class="type-badge vip">VIP</span>
                                                                    @else
                                                                        <span class="type-badge normal">Normal</span>
                                                                    @endif
                                                                </span>
                                                            </div>
                                                            <div class="info-row">
                                                                <span class="info-label">Location:</span>
                                                                <span class="info-value">{{ $ad->location }}</span>
                                                            </div>
                                                            <div class="info-row">
                                                                <span class="info-label">Price:</span>
                                                                <span class="info-value price">Rs. {{ number_format($ad->price) }}</span>
                                                            </div>
                                                            <div class="info-row">
                                                                <span class="info-label">Deleted:</span>
                                                                <span class="info-value">{{ $ad->deleted_at->format('M d, Y H:i') }}</span>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="ad-stats">
                                                            <div class="stat-item">
                                                                <i class="fa fa-heart"></i>
                                                                <span>{{ number_format($ad->total_likes ?? 0) }}</span>
                                                            </div>
                                                            <div class="stat-item">
                                                                <i class="fa fa-eye"></i>
                                                                <span>{{ number_format($ad->total_views ?? 0) }}</span>
                                                            </div>
                                                            <div class="stat-item">
                                                                <i class="fa fa-calendar"></i>
                                                                <span>{{ $ad->created_at->format('M d, Y') }}</span>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="ad-actions">
                                                            <form action="{{ route('restore-ad', $ad->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to restore this ad?')">
                                                                @csrf
                                                                <button type="submit" class="btn-restore">
                                                                    <i class="fa fa-undo"></i> Restore
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        
                                        @if($deletedAds->hasPages())
                                            <div class="pagination">
                                                {{ $deletedAds->links() }}
                                            </div>
                                        @endif
                                    @else
                                        <div class="no-ads">
                                            <p>No deleted ads found.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div id="topup-form" class="form-container">
                                <div class="topup-fields">
                                    <div class="topup-header">
                                        <h3><i class="fa fa-credit-card"></i> Payment Plans</h3>
                                        <p>Please pay the applicable amount and send the receipt along with the ad's phone
                                            number via Whatsapp to get your ad live.</p>
                                    </div>
                                    <div class="pricing-cards">
                                        <div class="pricing-card vip-premium">
                                            <div class="card-header">
                                                <i class="fa fa-crown"></i>
                                                <h4>VIP Ad</h4>
                                                <div class="price">Rs. {{$adType[0]->price}}</div>
                                            </div>
                                            <div class="card-features">
                                                <span><i class="fa fa-check"></i> Premium Placement</span>
                                                <span><i class="fa fa-check"></i> Extended Duration</span>
                                                <span><i class="fa fa-check"></i> Priority Support</span>
                                            </div>
                                        </div>
                                        <div class="pricing-card super-ad">
                                            <div class="card-header">
                                                <i class="fa fa-star"></i>
                                                <h4>Super Ad</h4>
                                                <div class="price">Rs. {{$adType[1]->price}}</div>
                                            </div>
                                            <div class="card-features">
                                                <span><i class="fa fa-check"></i> Enhanced Visibility</span>
                                                <span><i class="fa fa-check"></i> Better Ranking</span>
                                                <span><i class="fa fa-check"></i> Quick Approval</span>
                                            </div>
                                        </div>
                                        <div class="pricing-card vip-standard">
                                            <div class="card-header">
                                                <i class="fa fa-gem"></i>
                                                <h4>Normal Ad</h4>
                                                <div class="price">Free</div>
                                            </div>
                                            <div class="card-features">
                                                <span><i class="fa fa-check"></i> Standard VIP</span>
                                                <span><i class="fa fa-check"></i> Good Visibility</span>
                                                <span><i class="fa fa-check"></i> Regular Support</span>
                                            </div>
                                        </div>
                                        <div class="pricing-card verify-profile">
                                            <div class="card-header">
                                                <i class="fa fa-shield"></i>
                                                <h4>Verify Profile</h4>
                                                <div class="price">Rs. {{ number_format($setting->verify_profile_price ?? 500, 2) }}</div>
                                            </div>
                                            <div class="card-features">
                                                <span><i class="fa fa-check"></i> Profile Verification</span>
                                                <span><i class="fa fa-check"></i> Trust Badge</span>
                                                <span><i class="fa fa-check"></i> Enhanced Credibility</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                </section>
            </div>

            <script>
        function showForm(formId, btn) {
            // Hide all forms
            document.querySelectorAll(".form-container").forEach(form => form.classList.remove("active"));

            // Remove active from all buttons
            document.querySelectorAll(".my-ads,.new-ads,.btn-recover,.btn-topup").forEach(b => b.classList.remove("active"));

            // Show selected form
            document.getElementById(formId).classList.add("active");

            // Highlight clicked button
            btn.classList.add("active");
        }
        
        // Auto-select My Ads tab when page loads
        document.addEventListener("DOMContentLoaded", function() {
            // Get the My Ads button and form
            const myAdsBtn = document.querySelector('.my-ads');
            const myAdsForm = document.getElementById('my-ads-form');
            
            // Show My Ads form and highlight the button
            if (myAdsBtn && myAdsForm) {
                showForm('my-ads-form', myAdsBtn);
            }
            
            // Category selection for verification checkbox
            const categorySelect = document.querySelector('select[name="category_id"]');
            const verificationCheckbox = document.getElementById('verification-checkbox');
            
            if (categorySelect && verificationCheckbox) {
                categorySelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const selectedText = selectedOption.text.trim();
                    
                    if (selectedText === 'Live Cam') {
                        verificationCheckbox.style.display = 'block';
                    } else {
                        verificationCheckbox.style.display = 'none';
                        // Uncheck the verification checkbox when hiding
                        const profileVerificationCheckbox = document.getElementById('profile_verification');
                        if (profileVerificationCheckbox) {
                            profileVerificationCheckbox.checked = false;
                        }
                    }
                });
            }
        });

              document.addEventListener("DOMContentLoaded", () => {
        const menu = document.querySelector(".menu");
        const toggleBtn = document.querySelector(".menu-toggle");
        const icon = toggleBtn.querySelector("i");
      
        toggleBtn.addEventListener("click", () => {
          menu.classList.toggle("open");
      
          if (menu.classList.contains("open")) {
            // Change icon to cross
            icon.classList.remove("fa-bars");
            icon.classList.add("fa-times");
      
            // Disable body scroll
            document.body.classList.add("no-scroll");
          } else {
            // Back to hamburger
            icon.classList.remove("fa-times");
            icon.classList.add("fa-bars");
      
            // Enable body scroll
            document.body.classList.remove("no-scroll");
          }
        });
      });

      // Handle form submission to sync CKEditor content
      function handleFormSubmission() {
        if (window.descriptionEditor) {
          // Update the hidden textarea with CKEditor content
          document.getElementById('description-hidden').value = window.descriptionEditor.getData();
        }
        return true; // Allow form submission
      }

      // Initialize CKEditor
      document.addEventListener('DOMContentLoaded', function() {
        if (typeof ClassicEditor !== 'undefined') {
          ClassicEditor
            .create(document.querySelector('#description'), {
              toolbar: {
                items: [
                  'heading',
                  '|',
                  'bold',
                  'italic',
                  'underline',
                  '|',
                  'bulletedList',
                  'numberedList',
                  '|',
                  'outdent',
                  'indent',
                  '|',
                  'blockQuote',
                  'insertTable',
                  '|',
                  'undo',
                  'redo'
                ]
              },
              language: 'en',
              table: {
                contentToolbar: [
                  'tableColumn',
                  'tableRow',
                  'mergeTableCells'
                ]
              }
            })
            .then(editor => {
              window.descriptionEditor = editor;
              
              // Update hidden textarea when editor content changes
              editor.model.document.on('change:data', () => {
                document.getElementById('description-hidden').value = editor.getData();
              });
            })
            .catch(error => {
              console.error('Error initializing CKEditor:', error);
            });
        } else {
          console.error('CKEditor is not loaded');
        }
      });

      // Phone editing functionality
      let isPhoneEditing = false;
      
      function togglePhoneEdit() {
        const phoneInput = document.getElementById('phone_input');
        const countryCodeSelect = document.getElementById('country_code');
        const changePhoneBtn = document.getElementById('change_phone_btn');
        
        if (!isPhoneEditing) {
          // Enable editing
          phoneInput.disabled = false;
          countryCodeSelect.disabled = false;
          phoneInput.focus();
          changePhoneBtn.textContent = 'Save';
          changePhoneBtn.onclick = function() { savePhoneNumber(); return false; };
          isPhoneEditing = true;
        }
      }
      
      function savePhoneNumber() {
        const phoneInput = document.getElementById('phone_input');
        const countryCodeSelect = document.getElementById('country_code');
        const changePhoneBtn = document.getElementById('change_phone_btn');
        const newPhone = countryCodeSelect.value + phoneInput.value;
        
        // Validate phone number
        if (!phoneInput.value.trim()) {
          alert('Please enter a valid phone number');
          return;
        }

        if (!/^[7]/.test(phoneInput.value.trim())) {
          alert('Phone number must start with 7');
          return;
        }
        
        // Show loading state
        changePhoneBtn.textContent = 'Saving...';
        changePhoneBtn.style.pointerEvents = 'none';
        
        // Send AJAX request
        fetch('{{ route("update-phone") }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({
            phone: newPhone
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // Success - disable editing
            phoneInput.disabled = true;
            countryCodeSelect.disabled = true;
            changePhoneBtn.textContent = 'Change Phone';
            changePhoneBtn.onclick = function() { togglePhoneEdit(); return false; };
            isPhoneEditing = false;
            
            // Show success message
            showNotification('Phone number updated successfully!', 'success');
          } else {
            // Error
            showNotification(data.message || 'Failed to update phone number', 'error');
            changePhoneBtn.textContent = 'Save';
            changePhoneBtn.style.pointerEvents = 'auto';
          }
        })
        .catch(error => {
          console.error('Error:', error);
          showNotification('An error occurred while updating phone number', 'error');
          changePhoneBtn.textContent = 'Save';
          changePhoneBtn.style.pointerEvents = 'auto';
        });
      }
      
      // Notification function
      function showNotification(message, type) {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.textContent = message;
        notification.style.cssText = `
          position: fixed;
          top: 20px;
          right: 20px;
          padding: 15px 20px;
          border-radius: 8px;
          color: white;
          font-weight: 500;
          z-index: 10000;
          animation: slideIn 0.3s ease-out;
          ${type === 'success' ? 'background: linear-gradient(135deg, #28a745, #20c997);' : 'background: linear-gradient(135deg, #dc3545, #c82333);'}
        `;
        
        // Add animation styles
        const style = document.createElement('style');
        style.textContent = `
          @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
          }
        `;
        document.head.appendChild(style);
        
        document.body.appendChild(notification);
        
        // Remove notification after 3 seconds
        setTimeout(() => {
          notification.style.animation = 'slideIn 0.3s ease-out reverse';
          setTimeout(() => {
            if (notification.parentNode) {
              notification.parentNode.removeChild(notification);
            }
          }, 300);
        }, 3000);
      }
    </script>

@endsection