@extends('frontend.layouts.app')

@section('title', $ad->title)

@section('content')

                <div class="menu">
                <button class="btnPublish" onclick="location.href='{{ route('how-to-publish') }}'">How to Publish Ads?</button>
                <div class="search">
                    <input type="text" placeholder="Search for Ads...">
                    <button class="btnSearch">Search</button>
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
                    <button class="btnDashboard" onclick="location.href='{{ route('dashboard') }}'"><i class="fa fa-dashboard" style="color: #ffff; text-shadow: 0 0 3px rgba(0,0,0,0.3);"></i>Dashboard</button>        
                </div>
                @endif
                <div class="quickLinks">
                    <h1>Quick Links</h1>
                    <div></div>
                    <ul class="menu-list">
                        <li onclick="location.href='{{ route('home') }}'" style="cursor: pointer;">
                          All Categories
                        </li>
                        @foreach($categories ?? [] as $item)
                            <li onclick="location.href='{{ route('category.show', $item->id) }}'" style="cursor: pointer;">
                                {{ $item->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div id="content">
                <div class="ad-detail-container">
                <!-- See New Ads Button with Zoom Effect -->
                <div class="see-new-ads-section">
                    <button class="see-new-ads-btn" onclick="location.href='{{ route('home') }}'">
                        <i class="fa fa-refresh"></i>
                        See New Ads
                    </button>
                </div>
                
                <!-- Ad Badge -->
                <div class="ad-badge-section">
                    <div class="ad-badge {{ $ad->effective_ad_type == 1 ? 'normal-ad' : ($ad->effective_ad_type == 2 ? 'super-ad' : 'vip-ad') }}">{{ $ad->effective_ad_type == 1 ? 'Normal' : ($ad->effective_ad_type == 2 ? 'Super' : 'VIP') }}</div>
                    
                    @if($ad->poster->is_verified)
                        <div class="verified-badge">
                            <i class="fa fa-check-circle"></i>
                            Verified
                        </div>
                    @endif
                    
                    @if($ad->category && strtolower($ad->category->name) === 'live cam')
                        <div class="live-cam-note">
                            <i class="fa fa-info-circle"></i>
                            <span>Cashback only available for 1000 amount or more.</span>
                        </div>
                    @endif
                </div>

                <!-- Ad Image with Magnifier -->
                <div class="ad-image-section">
                    <div class="ad-image-container">
                        <div class="magnifier-container">
                            <img src="{{ url('public/storage/' . $ad->image) }}" alt="Ad Image" class="ad-detail-image" id="adImage" />
                            <div class="magnifier" id="magnifier"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Ad Title -->
                <div class="ad-title-section">
                    <h1 class="ad-title">{{ $ad->title }}</h1>
                </div>
                
                <!-- Ad Location -->
                <div class="ad-location-section">
                    <p class="ad-location">
                        <i class="fa fa-map-marker"></i>
                        {{ $ad->location }}
                    </p>
                </div>
                
                <!-- Ad Category -->
                @if($ad->category)
                <div class="ad-category-section">
                    <p class="ad-category">
                        <i class="fa fa-folder"></i>
                        {{ $ad->category->name }}
                    </p>
                </div>
                @endif
                
                <!-- Action Buttons -->
                <div class="action-buttons-section">
                    <button class="action-btn like-btn" onclick="toggleLike()">
                        <i class="fa fa-heart" id="likeIcon" data-ad-id="{{ $ad->id }}"></i>
                        <span id="likeText">Like</span>
                    </button>
                    <button class="action-btn save-btn" onclick="toggleSavedAdDetail()">
                        <i class="fa fa-bookmark" id="saveIcon" data-ad-id="{{ $ad->id }}"></i>
                        Save
                    </button>
                    <button class="action-btn share-btn" onclick="shareAd()">
                        <i class="fa fa-share"></i>
                        Share
                    </button>
                </div>
                
                <!-- Price and Likes Row -->
                <div class="price-likes-section">
                    <div class="price-info">
                        <div class="price-icon">
                            <i class="fa fa-tag"></i>
                        </div>
                        <div class="price-content">
                            <span class="price-label">Price</span>
                            <span class="price-value">Rs. {{ number_format($ad->price) }}</span>
                        </div>
                    </div>
                    <div class="likes-info">
                        <div class="likes-icon">
                            <i class="fa fa-heart"></i>
                        </div>
                        <div class="likes-content">
                            <span class="likes-count">{{ $ad->total_likes }}</span>
                            <span class="likes-label">Likes</span>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Buttons -->
                <div class="contact-buttons-section">
                    <button class="contact-btn call-btn" onclick="makeCall('{{ $ad->poster->phone }}')">
                        <i class="fa fa-phone"></i>
                        Call {{ $ad->poster->phone }}
                    </button>
                    @if($ad->is_on_whatsapp)
                    <button class="contact-btn whatsapp-btn" onclick="openWhatsApp('{{ $ad->poster->phone }}')">
                        <i class="fa fa-whatsapp"></i>
                        WhatsApp {{ $ad->poster->phone }}
                    </button>
                    @endif
                    @if($ad->is_on_imo)
                    <button class="contact-btn imo-btn" onclick="openImo('{{ $ad->poster->phone }}')">
                        <i class="fa fa-comment"></i>
                        IMO {{ $ad->poster->phone }}
                    </button>
                    @endif
                    @if($ad->is_on_viber)
                    <button class="contact-btn viber-btn" onclick="openViber('{{ $ad->poster->phone }}')">
                        <i class="fa fa-phone-square"></i>
                        Viber {{ $ad->poster->phone }}
                    </button>
                    @endif
                </div>
                
                <!-- Ad Description -->
                <div class="ad-description-section">
                    <h3>Description</h3>
                    <p class="ad-description">
                        {!! $ad->description !!}
                    </p>
                </div>
                

                
                <!-- Contact Buttons -->
                <div class="contact-buttons-section">
                    <button class="contact-btn call-btn" onclick="makeCall('{{ $ad->poster->phone }}')">
                        <i class="fa fa-phone"></i>
                        Call {{ $ad->poster->phone }}
                    </button>
                    @if($ad->is_on_whatsapp)
                    <button class="contact-btn whatsapp-btn" onclick="openWhatsApp('{{ $ad->poster->phone }}')">
                        <i class="fa fa-whatsapp"></i>
                        WhatsApp {{ $ad->poster->phone }}
                    </button>
                    @endif
                    @if($ad->is_on_imo)
                    <button class="contact-btn imo-btn" onclick="openImo('{{ $ad->poster->phone }}')">
                        <i class="fa fa-comment"></i>
                        IMO {{ $ad->poster->phone }}
                    </button>
                    @endif
                    @if($ad->is_on_viber)
                    <button class="contact-btn viber-btn" onclick="openViber('{{ $ad->poster->phone }}')">
                        <i class="fa fa-phone-square"></i>
                        Viber {{ $ad->poster->phone }}
                    </button>
                    @endif
                </div>

                <!-- Admin Contact Section -->
                <div class="admin-contact-section">
                    <h3>Need Help?</h3>
                    <p class="admin-contact-text">Having issues with this ad? Contact our admin team for assistance.</p>
                    <button class="contact-btn admin-whatsapp-btn" onclick="openAdminWhatsApp()">
                        <i class="fa fa-whatsapp"></i>
                        Contact Admin
                    </button>
                </div>

            </div>


                    <!-- Disclaimer Section -->
        <section class="disclaimer-section">
            <div class="disclaimer-container">
                <div class="disclaimer-content">
                    <div class="disclaimer-sinhala">
                        <h3>අවවාදය / Disclaimer</h3>
                        <p>adzlk.com දැන්වීම් දැමීමේ පහසුව ලබාදෙන Classified Ads වෙබ් අඩවියක් වන අතර මෙහි පළවන දැන්වීම් සඳහා adzlk.com වෙබ් අඩවියට කිසිදු ආකාරයක සෘජු සම්බන්ධතාවයක් නොමැත. මෙම දැන්වීම් සඳහා වගකීම හා ගනුදෙනු පිළිබඳ වගකීම් කිසිසේත් adzlk.com භාර නොගනී.
ඔබ සේවාවක් සඳහා යන්නේ නම්, මුලින්ම මුදල් ගෙවීමෙන් වළකින්න. මුලින්ම පුද්ගලයා හමුවන්න. ගනුදෙනු පිළිබඳ වගකීම් adzlk.com භාර නොගනී.
CAM සේවාවන් සඳහා, විශ්වාසවන්ත සේවාවන් ලබාගැනීමට Verified දැන්වීම් පමණක් තෝරා ගැනීමට අපි උපදෙස් දෙමු.</p>
                    </div>
                    <div class="disclaimer-english">
                        <h3>English Translation</h3>
                        <p>adzlk.com is a Classified Ads website that provides an easy platform for posting advertisements. adzlk.com has no direct connection to the advertisements published here. adzlk.com does not take responsibility or liability for these advertisements or any transactions related to them.
If you are going for a service, please avoid making payments upfront. Meet the person first. adzlk.com does not take responsibility for any transactions.
For CAM services, we recommend choosing only Verified Ads to ensure reliable services.</p>
                    </div>
                </div>
            </div>
        </section>

<!-- Profile Verification Modal -->
<div id="verificationModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h2><i class="fa fa-exclamation-triangle"></i> Profile Not Verified</h2>
        </div>
        <div class="modal-body">
            <p>මෙම ගිණුම verify කර නොමැත.</p>
            <p>ඔබේ ආරක්ෂාව සඳහා, සජීවී කැමරා සේවාවන් සඳහා verify ගිණුම් භාවිතා කිරීමට අපි නිර්දේශ කරමු.</p>
        </div>
        <div class="modal-footer">
            <button class="modal-ok-btn" onclick="closeVerificationModal()">OK</button>
        </div>
    </div>
</div>

<script>
function makeCall(phoneNumber) {
    window.location.href = 'tel:' + phoneNumber;
}

function openWhatsApp(phoneNumber) {
    const message = 'Hi, I am interested in your ad. Can you provide more details?';
    const whatsappUrl = `https://wa.me/${phoneNumber.replace(/\D/g, '')}?text=${encodeURIComponent(message)}`;
    window.open(whatsappUrl, '_blank');
}

function openImo(phoneNumber) {
    const message = 'Hi, I am interested in your ad. Can you provide more details?';
    const imoUrl = `imo://chat?phone=${phoneNumber.replace(/\D/g, '')}&text=${encodeURIComponent(message)}`;
    window.open(imoUrl, '_blank');
}

function openViber(phoneNumber) {
    const message = 'Hi, I am interested in your ad. Can you provide more details?';
    const viberUrl = `viber://chat?number=${phoneNumber.replace(/\D/g, '')}&text=${encodeURIComponent(message)}`;
    window.open(viberUrl, '_blank');
}

function openAdminWhatsApp() {
    // Admin WhatsApp number from settings
    const adminPhoneNumber = '{{ $settings->subscribe_whatsapp_link ?? "1234567890" }}';
    const message = 'Hi Admin, I need help with an ad on your platform. Ad ID: {{ $ad->id }}';
    const whatsappUrl = `https://wa.me/${adminPhoneNumber.replace(/\D/g, '')}?text=${encodeURIComponent(message)}`;
    window.open(whatsappUrl, '_blank');
}

function toggleLike() {
    const likeIcon = document.getElementById('likeIcon');
    const likeText = document.getElementById('likeText');
    const adId = parseInt(likeIcon.getAttribute('data-ad-id'));
    
    // Check current like state from browser storage
    const likedAds = getLikedAds();
    const isLiked = likedAds.includes(adId);
    
    if (isLiked) {
        // If currently liked, unlike it
        updateLikeInDatabaseDetail(adId, 'unlike');
        likeIcon.classList.remove('liked');
        likeIcon.style.color = '#E84393';
        likeText.textContent = 'Like';
        removeLikedAd(adId);
    } else {
        // If not liked, like it
        updateLikeInDatabaseDetail(adId, 'like');
        likeIcon.classList.add('liked');
        likeIcon.style.color = '#007bff'; // Blue color for liked
        likeText.textContent = 'Liked';
        addLikedAd(adId);
    }
}

function toggleSavedAdDetail() {
    const saveIcon = document.getElementById('saveIcon');
    const adId = parseInt(saveIcon.getAttribute('data-ad-id'));
    const savedAds = getSavedAds();
    
    if (savedAds.includes(adId)) {
        // Remove from saved ads
        removeSavedAd(adId);
        saveIcon.classList.remove('saved');
        saveIcon.style.color = '#E84393';
        showNotification('Ad removed from saved ads', 'info');
    } else {
        // Add to saved ads
        addSavedAd(adId);
        saveIcon.classList.add('saved');
        saveIcon.style.color = '#007bff';
        showNotification('Ad saved successfully!', 'success');
    }
}

function updateLikeInDatabaseDetail(adId, action) {
    // Show loading state
    const likeIcon = document.getElementById('likeIcon');
    if (likeIcon) {
        likeIcon.style.opacity = '0.7';
    }
    
    // Get CSRF token safely
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    const headers = {
        'Content-Type': 'application/json'
    };
    
    if (csrfToken) {
        headers['X-CSRF-TOKEN'] = csrfToken.getAttribute('content');
    }
    
    fetch(`/ad/${adId}/toggle-like`, {
        method: 'POST',
        headers: headers
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update like count on the detail page
            const likesCountElement = document.querySelector('.likes-count');
            if (likesCountElement) {
                likesCountElement.textContent = data.total_likes;
            }
            
            showNotification(data.message, 'success');
        } else {
            showNotification('Error updating like count', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Error updating like count', 'error');
    })
    .finally(() => {
        // Remove loading state
        if (likeIcon) {
            likeIcon.style.opacity = '1';
        }
    });
}

// Saved Ads Functions (for browser storage)
function getSavedAds() {
    const savedAds = localStorage.getItem('savedAds');
    return savedAds ? JSON.parse(savedAds) : [];
}

function addSavedAd(adId) {
    const savedAds = getSavedAds();
    if (!savedAds.includes(adId)) {
        savedAds.push(adId);
        localStorage.setItem('savedAds', JSON.stringify(savedAds));
    }
}

function removeSavedAd(adId) {
    const savedAds = getSavedAds();
    const updatedAds = savedAds.filter(id => id !== adId);
    localStorage.setItem('savedAds', JSON.stringify(updatedAds));
}

// Liked Ads Functions (for browser storage - separate from saved ads)
function getLikedAds() {
    const likedAds = localStorage.getItem('likedAds');
    return likedAds ? JSON.parse(likedAds) : [];
}

function addLikedAd(adId) {
    const likedAds = getLikedAds();
    if (!likedAds.includes(adId)) {
        likedAds.push(adId);
        localStorage.setItem('likedAds', JSON.stringify(likedAds));
    }
}

function removeLikedAd(adId) {
    const likedAds = getLikedAds();
    const updatedAds = likedAds.filter(id => id !== adId);
    localStorage.setItem('likedAds', JSON.stringify(updatedAds));
}
function shareAd() {
    if (navigator.share) {
        navigator.share({
            title: @json($ad->title),
            text:  @json(Str::words($ad->description, 20, "...")),
            url: window.location.href
        });
    } else {
        // Fallback for browsers that don't support Web Share API
        const url = window.location.href;
        const text = '{{ $ad->title }}';
        
        if (navigator.clipboard) {
            navigator.clipboard.writeText(url).then(() => {
                alert('Link copied to clipboard!');
            });
        } else {
            // Fallback for older browsers
            const textArea = document.createElement('textarea');
            textArea.value = url;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            alert('Link copied to clipboard!');
        }
    }
}

// Saved Ads Functions
function getSavedAds() {
    const savedAds = localStorage.getItem('savedAds');
    return savedAds ? JSON.parse(savedAds) : [];
}

function addSavedAd(adId) {
    const savedAds = getSavedAds();
    if (!savedAds.includes(adId)) {
        savedAds.push(adId);
        localStorage.setItem('savedAds', JSON.stringify(savedAds));
    }
}

function removeSavedAd(adId) {
    const savedAds = getSavedAds();
    const updatedAds = savedAds.filter(id => id !== adId);
    localStorage.setItem('savedAds', JSON.stringify(updatedAds));
}

// Modal Functions
function showVerificationModal() {
    const modal = document.getElementById('verificationModal');
    if (modal) {
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }
}

function closeVerificationModal() {
    const modal = document.getElementById('verificationModal');
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto'; // Restore scrolling
    }
}

// Close modal when clicking outside of it
document.addEventListener('click', function(event) {
    const modal = document.getElementById('verificationModal');
    if (event.target === modal) {
        closeVerificationModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeVerificationModal();
    }
});

function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 12px 20px;
        border-radius: 8px;
        color: white;
        font-family: Inter, sans-serif;
        font-weight: 500;
        z-index: 10000;
        transform: translateX(100%);
        transition: transform 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    `;
    
    // Set background color based on type
    if (type === 'success') {
        notification.style.background = 'linear-gradient(135deg, #28a745, #20c997)';
    } else if (type === 'info') {
        notification.style.background = 'linear-gradient(135deg, #17a2b8, #6f42c1)';
    }
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// Initialize like and save button states on page load
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOMContentLoaded');
    console.log('DOM Content Loaded - Ad Detail Page');
    console.log('Current ad ID:', {{ $ad->id }});
    
    // Check if we should show the verification modal
    @if($ad->category && strtolower($ad->category->name) === 'live cam' && !$ad->poster->is_verified)
        // Show modal after a short delay to ensure page is fully loaded
        setTimeout(function() {
            showVerificationModal();
        }, 500);
    @endif
    
    const likedAds = getLikedAds();
    const savedAds = getSavedAds();
    const likeIcon = document.getElementById('likeIcon');
    const saveIcon = document.getElementById('saveIcon');
    
    console.log('Like icon found:', likeIcon);
    console.log('Save icon found:', saveIcon);
    console.log('Liked ads:', likedAds);
    console.log('Saved ads:', savedAds);
    
    if (likeIcon) {
        const adId = parseInt(likeIcon.getAttribute('data-ad-id'));
        const likeText = document.getElementById('likeText');
        if (likedAds.includes(adId)) {
            likeIcon.classList.add('liked');
            likeIcon.style.color = '#007bff'; // Blue color for liked
            likeText.textContent = 'Liked';
        } else {
            likeIcon.classList.remove('liked');
            likeIcon.style.color = '#E84393'; // Pink color for not liked
            likeText.textContent = 'Like';
        }
    }
    
    if (saveIcon) {
        const adId = parseInt(saveIcon.getAttribute('data-ad-id'));
        if (savedAds.includes(adId)) {
            saveIcon.classList.add('saved');
            saveIcon.style.color = '#007bff';
        } else {
            saveIcon.classList.remove('saved');
            saveIcon.style.color = '#E84393';
        }
    }
    
    // Magnifier functionality
    const adImage = document.getElementById('adImage');
    const magnifier = document.getElementById('magnifier');
    
    if (adImage && magnifier) {
        adImage.addEventListener('mousemove', function(e) {
            const rect = adImage.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const magnifierSize = 150;
            const magnifierImg = magnifier.querySelector('img');
            
            magnifier.style.display = 'block';
            magnifier.style.left = (e.clientX - magnifierSize / 2) + 'px';
            magnifier.style.top = (e.clientY - magnifierSize / 2) + 'px';
            
            if (magnifierImg) {
                const scaleX = 300 / rect.width;
                const scaleY = 300 / rect.height;
                
                magnifierImg.style.left = -x * scaleX + magnifierSize / 2 + 'px';
                magnifierImg.style.top = -y * scaleY + magnifierSize / 2 + 'px';
            }
        });
        
        adImage.addEventListener('mouseleave', function() {
            magnifier.style.display = 'none';
        });
    }
});
</script>

@endsection

<style>
/* Modal Styles */
.modal {
    position: fixed;
    z-index: 10000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-content {
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    max-width: 500px;
    width: 90%;
    max-height: 80vh;
    overflow-y: auto;
    animation: modalSlideIn 0.3s ease-out;
}

@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: translateY(-50px) scale(0.9);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.modal-header {
    padding: 20px 25px 15px;
    border-bottom: 1px solid #eee;
    background: linear-gradient(135deg, #ff6b6b, #ee5a52);
    color: white;
    border-radius: 12px 12px 0 0;
}

.modal-header h2 {
    margin: 0;
    font-size: 1.4rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
}

.modal-header i {
    font-size: 1.5rem;
}

.modal-body {
    padding: 25px;
    line-height: 1.6;
}

.modal-body p {
    margin: 0 0 15px 0;
    color: #555;
    font-size: 1rem;
}

.modal-body p:last-child {
    margin-bottom: 0;
    font-weight: 500;
    color: #333;
}

.modal-footer {
    padding: 15px 25px 25px;
    text-align: center;
    border-top: 1px solid #eee;
}

.modal-ok-btn {
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
}

.modal-ok-btn:hover {
    background: linear-gradient(135deg, #0056b3, #004085);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 123, 255, 0.4);
}

.modal-ok-btn:active {
    transform: translateY(0);
}

/* Responsive Design */
@media (max-width: 768px) {
    .modal-content {
        width: 95%;
        margin: 20px;
    }
    
    .modal-header {
        padding: 15px 20px 10px;
    }
    
    .modal-header h2 {
        font-size: 1.2rem;
    }
    
    .modal-body {
        padding: 20px;
    }
    
    .modal-footer {
        padding: 10px 20px 20px;
    }
}
</style>
