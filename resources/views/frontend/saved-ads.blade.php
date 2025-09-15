@extends('frontend.layouts.app')

@section('title', 'Saved Ads')

@section('content')

        <div class="menu">
          
          <button class="btnPublish" onclick="location.href='{{ route('how-to-publish') }}'">How to Publish Ads?</button>
          <div class="search">
              <input type="text" id="searchInput" placeholder="Search for Ads..." value="{{ request('q') }}">
              <button class="btnSearch" onclick="performSearch()">Search</button>
          </div>
                          <div class="savedButtons">
                    <button class="btnSaved" onclick="location.href='{{ route('saved-ads') }}'" style="background: linear-gradient(135deg, #007bff, #0056b3); color: white;"><i class="fa fa-heart" style="color: #ffffff; text-shadow: 0 0 3px #ffff;"></i>Saved Ads</button>
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
                  
                                     <!-- Saved Ads Header -->
                   <div class="category-header" style="padding: 15px 20px; margin-bottom: 20px; width: 60%; margin-left: auto; margin-right: auto; text-align: center;">
                       <h2 style="font-size: 1.5rem; margin: 0 0 8px 0;">Your Saved Ads</h2>
                       <a href="{{ route('home') }}" class="clear-filter" style="font-size: 0.9rem;">← Back to All Ads</a>
                   </div>
                  
                  <!-- Loading State -->
                  <div id="loadingState" class="loading-state" style="text-align: center; padding: 50px 20px;">
                      <div class="spinner" style="width: 40px; height: 40px; border: 4px solid #f3f3f3; border-top: 4px solid #E84393; border-radius: 50%; animation: spin 1s linear infinite; margin: 0 auto 20px;"></div>
                      <p>Loading your saved ads...</p>
                  </div>

                  <!-- Empty State -->
                  <div id="emptyState" class="empty-state" style="display: none; text-align: center; padding: 60px 20px; background: white; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); margin: 20px 0;">
                      <div class="empty-icon" style="margin-bottom: 20px;">
                          <i class="fa fa-heart" style="font-size: 48px; color: #E84393;"></i>
                      </div>
                      <h2 style="color: #333; margin-bottom: 10px; font-size: 1.8rem;">No Saved Ads Yet</h2>
                      <p style="color: #666; margin-bottom: 30px; font-size: 1.1rem;">You haven't saved any ads yet. Start browsing and save your favorite ads!</p>
                      <button class="browse-btn" onclick="location.href='{{ route('home') }}'" style="background: linear-gradient(135deg, #E84393, #fd79a8); color: white; border: none; padding: 12px 30px; border-radius: 25px; font-size: 1rem; font-weight: 600; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(232, 67, 147, 0.3);">
                          <i class="fa fa-search"></i>
                          Browse Ads
                      </button>
                  </div>
                  
                                     <div id="savedAdsContainer" class="ads-grid" style="display: none; width: 100%; flex-wrap: wrap; gap: 20px; padding: 20px; justify-content: flex-start;">
                       <!-- Saved ads will be loaded here dynamically -->
                   </div>

                  <!-- Pagination Section -->
                  <div class="pagination-container" id="paginationContainer" style="display: none;">
                      <div class="pagination-info">
                          <span>Showing <strong id="startRange">1</strong> to <strong id="endRange">8</strong> of <strong id="totalItems">0</strong> ads</span>
                      </div>
                      <div class="pagination-controls">
                          <button class="pagination-btn prev-btn" onclick="changePage('prev')" disabled>
                              <i class="fa fa-chevron-left"></i>
                              Previous
                          </button>
                          <div class="page-numbers" id="pageNumbers">
                              <!-- Page numbers will be generated dynamically -->
                          </div>
                          <button class="pagination-btn next-btn" onclick="changePage('next')" disabled>
                              Next
                              <i class="fa fa-chevron-right"></i>
                          </button>
                      </div>
                  </div>
                    
              </div>
          </section>
      </div>

<!-- Report Modal -->
<div id="reportModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Report Ad</h2>
            <span class="close" onclick="closeModal()">&times;</span>
        </div>
        <form id="reportForm">
            <div class="form-group">
                <label for="reason">Reason for Report:</label>
                <select id="reason" name="reason" required>
                    <option value="">Select a reason</option>
                    <option value="spam">Spam</option>
                    <option value="inappropriate">Inappropriate Content</option>
                    <option value="fake">Fake Information</option>
                    <option value="duplicate">Duplicate Ad</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description (Optional):</label>
                <textarea id="description" name="description" rows="4" placeholder="Please provide more details about your report..."></textarea>
            </div>
            <div class="form-actions">
                <button type="button" onclick="closeModal()" class="btn-cancel">Cancel</button>
                <button type="submit" class="btn-submit">Submit Report</button>
            </div>
        </form>
    </div>
</div>

<style>
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.browse-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(232, 67, 147, 0.4);
}
</style>

<script>
// Function to get saved ads from localStorage
function getSavedAds() {
    const savedAds = localStorage.getItem('savedAds');
    return savedAds ? JSON.parse(savedAds) : [];
}

// Function to get liked ads from localStorage
function getLikedAds() {
    const likedAds = localStorage.getItem('likedAds');
    return likedAds ? JSON.parse(likedAds) : [];
}

// Function to add liked ad
function addLikedAd(adId) {
    const likedAds = getLikedAds();
    if (!likedAds.includes(adId)) {
        likedAds.push(adId);
        localStorage.setItem('likedAds', JSON.stringify(likedAds));
    }
}

// Function to remove liked ad
function removeLikedAd(adId) {
    const likedAds = getLikedAds();
    const updatedAds = likedAds.filter(id => id !== adId);
    localStorage.setItem('likedAds', JSON.stringify(updatedAds));
}

// Function to add saved ad
function addSavedAd(adId) {
    const savedAds = getSavedAds();
    if (!savedAds.includes(adId)) {
        savedAds.push(adId);
        localStorage.setItem('savedAds', JSON.stringify(savedAds));
    }
}

// Function to remove saved ad
function removeSavedAd(adId) {
    const savedAds = getSavedAds();
    const updatedAds = savedAds.filter(id => id !== adId);
    localStorage.setItem('savedAds', JSON.stringify(updatedAds));
}

// Function to show notification
function showNotification(message, type = 'info') {
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
    
    if (type === 'success') {
        notification.style.background = 'linear-gradient(135deg, #28a745, #20c997)';
    } else if (type === 'info') {
        notification.style.background = 'linear-gradient(135deg, #17a2b8, #6f42c1)';
    }
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// Function to toggle like (copied from main page)
function toggleLike(adId, element) {
    const heartIcon = element.querySelector('.saved-heart-icon');
    const likedAds = getLikedAds();
    const isLiked = likedAds.includes(adId);
    
    if (isLiked) {
        updateLikeInDatabase(adId, 'unlike');
        heartIcon.classList.remove('saved');
        removeLikedAd(adId);
    } else {
        updateLikeInDatabase(adId, 'like');
        heartIcon.classList.add('saved');
        addLikedAd(adId);
    }
}

// Function to update like in database (copied from main page)
function updateLikeInDatabase(adId, action) {
    const heartIcon = document.querySelector(`[data-ad-id="${adId}"] .saved-heart-icon`);
    if (heartIcon) {
        heartIcon.style.opacity = '0.7';
    }
    
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
            const likesCountElement = document.querySelector(`[data-ad-id="${adId}"] .likes-count`);
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
        if (heartIcon) {
            heartIcon.style.opacity = '1';
        }
    });
}

// Function to toggle report menu (copied from main page)
function toggleReportMenu(dotsElement, adId) {
    // Remove any existing dropdowns
    const existingDropdowns = document.querySelectorAll('.dropdown-menu');
    existingDropdowns.forEach(dropdown => dropdown.remove());
    
    // Check if this dropdown is already active
    const isActive = dotsElement.classList.contains('active');
    
    // Remove active class from all dots
    document.querySelectorAll('.dots').forEach(dot => dot.classList.remove('active'));
    
    if (!isActive) {
        dotsElement.classList.add('active');
        
        // Create dropdown menu
        const dropdownMenu = document.createElement('div');
        dropdownMenu.className = 'dropdown-menu';
        dropdownMenu.style.display = 'block';
        
        // Store adId globally for the report modal
        window.currentReportAdId = adId;
        
        // Create report button
        const reportButton = document.createElement('button');
        reportButton.className = 'dropdown-item';
        reportButton.textContent = 'Report';
        reportButton.addEventListener('click', function(e) {
            e.stopPropagation();
            openModal();
        });
        
        // Create save button
        const saveButton = document.createElement('button');
        saveButton.className = 'dropdown-item';
        const savedAds = getSavedAds();
        const isSaved = savedAds.includes(adId);
        saveButton.textContent = isSaved ? 'Unsave' : 'Save';
        saveButton.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleSavedAd(window.currentReportAdId, this);
            // Update button text after action
            setTimeout(() => {
                const updatedSavedAds = getSavedAds();
                const updatedIsSaved = updatedSavedAds.includes(window.currentReportAdId);
                this.textContent = updatedIsSaved ? 'Unsave' : 'Save';
            }, 100);
        });
        
        dropdownMenu.appendChild(reportButton);
        dropdownMenu.appendChild(saveButton);
        
        // Position dropdown
        dotsElement.style.position = 'relative';
        dotsElement.appendChild(dropdownMenu);
    }
}

// Function to toggle saved ad (copied from main page)
function toggleSavedAd(adId, element) {
    const savedAds = getSavedAds();
    if (savedAds.includes(adId)) {
        removeSavedAd(adId);
        showNotification('Ad removed from saved ads', 'info');
        // Remove the ad card from the page
        const adCard = document.querySelector(`[data-ad-id="${adId}"]`);
        if (adCard) {
            adCard.style.transform = 'scale(0.8)';
            adCard.style.opacity = '0';
            setTimeout(() => {
                adCard.remove();
                checkEmptyState();
            }, 300);
        }
    } else {
        addSavedAd(adId);
        showNotification('Ad saved successfully!', 'success');
    }
}

// Function to open report modal (copied from main page)
function openModal() {
    const modal = document.getElementById('reportModal');
    if (modal) {
        modal.style.display = 'block';
    }
}

// Function to close report modal (copied from main page)
function closeModal() {
    const modal = document.getElementById('reportModal');
    if (modal) {
        modal.style.display = 'none';
        // Reset form
        const form = document.getElementById('reportForm');
        if (form) {
            form.reset();
        }
        // Clear current ad ID
        window.currentReportAdId = null;
    }
}

// Function to check if we should show empty state
function checkEmptyState() {
    const savedAdsContainer = document.getElementById('savedAdsContainer');
    const emptyState = document.getElementById('emptyState');
    
    if (savedAdsContainer.children.length === 0) {
        savedAdsContainer.style.display = 'none';
        emptyState.style.display = 'block';
    }
}

// Pagination variables
let allSavedAds = [];
let currentPage = 1;
const itemsPerPage = 30;

// Function to load saved ads
async function loadSavedAds() {
    const loadingState = document.getElementById('loadingState');
    const emptyState = document.getElementById('emptyState');
    const savedAdsContainer = document.getElementById('savedAdsContainer');
    const paginationContainer = document.getElementById('paginationContainer');
    
    const savedAds = getSavedAds();
    
    // Hide loading state
    loadingState.style.display = 'none';
    
    if (savedAds.length === 0) {
        emptyState.style.display = 'block';
        paginationContainer.style.display = 'none';
        return;
    }
    
    savedAdsContainer.style.display = 'flex';
    savedAdsContainer.style.flexWrap = 'wrap';
    savedAdsContainer.style.gap = '20px';
    savedAdsContainer.style.padding = '20px';
    savedAdsContainer.style.justifyContent = 'flex-start';
    
    try {
        // Fetch all saved ads data from the server
        const response = await fetch('/api/saved-ads-data', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify({ adIds: savedAds })
        });
        
        if (response.ok) {
            allSavedAds = await response.json();
            currentPage = 1;
            displaySavedAdsPage();
        } else {
            throw new Error('Failed to fetch ads data');
        }
    } catch (error) {
        console.error('Error loading saved ads:', error);
        showNotification('Error loading saved ads', 'error');
        emptyState.style.display = 'block';
        paginationContainer.style.display = 'none';
    }
}

// Function to display saved ads with pagination
function displaySavedAdsPage() {
    const savedAdsContainer = document.getElementById('savedAdsContainer');
    const paginationContainer = document.getElementById('paginationContainer');
    
    // Calculate pagination
    const totalItems = allSavedAds.length;
    const totalPages = Math.ceil(totalItems / itemsPerPage);
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = Math.min(startIndex + itemsPerPage, totalItems);
    
    // Get current page ads
    const currentPageAds = allSavedAds.slice(startIndex, endIndex);
    
    // Clear container and add ads
    savedAdsContainer.innerHTML = '';
    currentPageAds.forEach(ad => {
        const adCard = createAdCard(ad);
        savedAdsContainer.appendChild(adCard);
    });
    
    // Set heart icon colors after ads are displayed
    setHeartIconColors();
    
    // Update pagination info
    updatePaginationInfo(startIndex + 1, endIndex, totalItems);
    
    // Show/hide pagination
    if (totalPages > 1) {
        paginationContainer.style.display = 'block';
        updatePaginationControls(currentPage, totalPages);
    } else {
        paginationContainer.style.display = 'none';
    }
}

// Function to update pagination info
function updatePaginationInfo(start, end, total) {
    document.getElementById('startRange').textContent = start;
    document.getElementById('endRange').textContent = end;
    document.getElementById('totalItems').textContent = total;
}

// Function to update pagination controls
function updatePaginationControls(currentPage, totalPages) {
    const pageNumbersContainer = document.getElementById('pageNumbers');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    
    // Update prev/next buttons
    prevBtn.disabled = currentPage === 1;
    nextBtn.disabled = currentPage === totalPages;
    
    // Generate page numbers
    pageNumbersContainer.innerHTML = '';
    
    const start = Math.max(1, currentPage - 2);
    const end = Math.min(totalPages, currentPage + 2);
    
    // First page
    if (start > 1) {
        const firstPageBtn = document.createElement('button');
        firstPageBtn.className = 'page-number';
        firstPageBtn.textContent = '1';
        firstPageBtn.onclick = () => goToPage(1);
        pageNumbersContainer.appendChild(firstPageBtn);
        
        if (start > 2) {
            const dots = document.createElement('span');
            dots.className = 'page-dots';
            dots.textContent = '...';
            pageNumbersContainer.appendChild(dots);
        }
    }
    
    // Page range
    for (let i = start; i <= end; i++) {
        const pageBtn = document.createElement('button');
        pageBtn.className = i === currentPage ? 'page-number active' : 'page-number';
        pageBtn.textContent = i;
        pageBtn.onclick = () => goToPage(i);
        pageNumbersContainer.appendChild(pageBtn);
    }
    
    // Last page
    if (end < totalPages) {
        if (end < totalPages - 1) {
            const dots = document.createElement('span');
            dots.className = 'page-dots';
            dots.textContent = '...';
            pageNumbersContainer.appendChild(dots);
        }
        
        const lastPageBtn = document.createElement('button');
        lastPageBtn.className = 'page-number';
        lastPageBtn.textContent = totalPages;
        lastPageBtn.onclick = () => goToPage(totalPages);
        pageNumbersContainer.appendChild(lastPageBtn);
    }
}

// Function to go to specific page
function goToPage(page) {
    currentPage = page;
    displaySavedAdsPage();
}

// Function to change page (prev/next)
function changePage(direction) {
    if (direction === 'prev' && currentPage > 1) {
        currentPage--;
    } else if (direction === 'next' && currentPage < Math.ceil(allSavedAds.length / itemsPerPage)) {
        currentPage++;
    }
    displaySavedAdsPage();
}

// Function to create ad card (exact same as main page)
function createAdCard(ad) {
    const card = document.createElement('div');
            card.className = `ad-card ${ad.effective_ad_type == 2 ? 'yellow' : (ad.effective_ad_type == 3 ? 'blue' : 'normal')}`;
    card.setAttribute('data-ad-id', ad.id);
    card.onclick = () => window.location.href = `/ad/${ad.id}`;
    card.style.cursor = 'pointer';
    
    const imageUrl = ad.image ? `/storage/${ad.image}` : '/images/default-ad.jpg';
            const adTypeName = ad.effective_ad_type == 1 ? 'Normal' : (ad.effective_ad_type == 2 ? 'Super' : 'VIP');
        const badgeClass = ad.effective_ad_type == 1 ? 'badge-normal' : (ad.effective_ad_type == 2 ? 'badge-super' : 'badge-vip');
    const verifiedBadge = ad.poster && ad.poster.is_verified ? '<span class="verified-badge"><i class="fa fa-check-circle"></i> Verified</span>' : '';
    
    // Format the date
    const createdDate = new Date(ad.created_at);
    const timeAgo = getTimeAgo(createdDate);
    
    card.innerHTML = `
        <div class="badge ${badgeClass}">${adTypeName}</div>
        <div class="ad-content">
            <div class="img">
                <img src="${ad.thumbnail ? `/storage/${ad.thumbnail}` : imageUrl}" alt="Ad Image" onerror="this.src='${imageUrl}'" />
            </div>
            <div class="details">
                <h3>${ad.title}</h3>
                <span class="ago">${timeAgo}</span>
                <p>${ad.description.length > 200 ? ad.description.substring(0, 200) + '...' : ad.description}</p>
                <div class="meta">
                    <div class="views">
                        <span class="like-container" onclick="event.stopPropagation(); toggleLike(${ad.id}, this)">
                            <i class="fa fa-heart saved-heart-icon" data-ad-id="${ad.id}"></i>
                            <span class="likes-count">${ad.total_likes}</span> Likes
                        </span>
                        <span>${ad.total_views || 0} Views</span>
                        ${verifiedBadge}
                    </div>
                    <div class="dots" onclick="event.stopPropagation(); toggleReportMenu(this, ${ad.id})">
                        <i class="fa fa-ellipsis-h"></i>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    return card;
}

// Function to format time ago
function getTimeAgo(date) {
    const now = new Date();
    const diffInSeconds = Math.floor((now - date) / 1000);
    
    if (diffInSeconds < 60) {
        return 'just now';
    } else if (diffInSeconds < 3600) {
        const minutes = Math.floor(diffInSeconds / 60);
        return `${minutes} minute${minutes > 1 ? 's' : ''} ago`;
    } else if (diffInSeconds < 86400) {
        const hours = Math.floor(diffInSeconds / 3600);
        return `${hours} hour${hours > 1 ? 's' : ''} ago`;
    } else if (diffInSeconds < 2592000) {
        const days = Math.floor(diffInSeconds / 86400);
        return `${days} day${days > 1 ? 's' : ''} ago`;
    } else if (diffInSeconds < 31536000) {
        const months = Math.floor(diffInSeconds / 2592000);
        return `${months} month${months > 1 ? 's' : ''} ago`;
    } else {
        const years = Math.floor(diffInSeconds / 31536000);
        return `${years} year${years > 1 ? 's' : ''} ago`;
    }
}

// Function to set heart icon colors after ads are loaded
function setHeartIconColors() {
    const likedAds = getLikedAds();
    const heartIcons = document.querySelectorAll('.saved-heart-icon');
    
    heartIcons.forEach(icon => {
        const adId = parseInt(icon.getAttribute('data-ad-id'));
        if (likedAds.includes(adId)) {
            icon.classList.add('saved');
        } else {
            icon.classList.remove('saved');
        }
    });
}

// Initialize page when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    loadSavedAds();
    
    // Add report form submission handler
    const reportForm = document.getElementById('reportForm');
    if (reportForm) {
        reportForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = {
                ad_id: window.currentReportAdId,
                reason: formData.get('reason'),
                description: formData.get('description')
            };
            
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            const headers = {
                'Content-Type': 'application/json'
            };
            
            if (csrfToken) {
                headers['X-CSRF-TOKEN'] = csrfToken.getAttribute('content');
            }
            
            fetch('/report', {
                method: 'POST',
                headers: headers,
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Report submitted successfully', 'success');
                    closeModal();
                } else {
                    showNotification(data.message || 'Error submitting report', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error submitting report', 'error');
            });
        });
    }
    
    // Add global event listeners for dropdowns
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dots')) {
            closeAllDropdowns();
        }
    });
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeAllDropdowns();
        }
    });
    
    window.addEventListener('blur', function() {
        closeAllDropdowns();
    });
});

// Function to close all dropdowns
function closeAllDropdowns() {
    const dropdowns = document.querySelectorAll('.dropdown-menu');
    dropdowns.forEach(dropdown => dropdown.remove());
    document.querySelectorAll('.dots').forEach(dot => dot.classList.remove('active'));
}
</script>
@endsection
