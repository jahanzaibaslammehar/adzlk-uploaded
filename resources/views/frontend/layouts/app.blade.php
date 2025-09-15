<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo-1.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <title>Ad Listing</title>
</head>
<body>
<div id="wrapper">

    @include('frontend.inc.header')
    
    <main id="main">
        @yield('content')
    </main>

    @include('frontend.inc.footer')

</div>

<!-- Report Modal -->
<div id="reportModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Report Ad</h2>
        <form id="reportForm">
            <div class="form-group">
                <label for="reportReason">Reason for Report:</label>
                <select id="reportReason" name="reason" required>
                    <option value="">Select a reason</option>
                    <option value="inappropriate">Inappropriate Content</option>
                    <option value="spam">Spam or Misleading</option>
                    <option value="fake">Fake or Scam</option>
                    <option value="offensive">Offensive Language</option>
                    <option value="illegal">Illegal Activity</option>
                    <option value="duplicate">Duplicate Ad</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="reportDescription">Additional Details (Optional):</label>
                <textarea id="reportDescription" name="description" rows="4" placeholder="Please provide additional details about your report..."></textarea>
            </div>
            <div class="form-actions">
                <button type="button" onclick="closeModal()" class="btn-cancel">Cancel</button>
                <button type="submit" class="btn-submit">Submit Report</button>
            </div>
        </form>
    </div>
</div>
<script>
      // Define toggleReportMenu function globally
      function toggleReportMenu(dotsElement, adId) {
        console.log('toggleReportMenu called with adId:', adId);
        
        // Store the ad ID globally for the report
        window.currentReportAdId = adId;
        
        // Close all other dropdowns first
        document.querySelectorAll('.dots').forEach(dot => {
          if (dot !== dotsElement) {
            dot.classList.remove('active');
            // Hide other dropdown menus
            const dropdownMenu = dot.parentElement.querySelector('.dropdown-menu');
            if (dropdownMenu) {
              dropdownMenu.style.display = 'none';
            }
            // Hide legacy report buttons
            const reportButton = dot.parentElement.querySelector('.btnreport');
            if (reportButton) {
              reportButton.style.display = 'none';
            }
          }
        });
        
        // Toggle current dropdown
        const isActive = dotsElement.classList.contains('active');
        dotsElement.classList.toggle('active');
        
        // Prevent immediate closure by stopping event propagation
        event.stopPropagation();
        
        // Show/hide current dropdown menu
        const dropdownMenu = dotsElement.parentElement.querySelector('.dropdown-menu');
        const reportButton = dotsElement.parentElement.querySelector('.btnreport');
        console.log('Dropdown menu found:', dropdownMenu, 'Report button found:', reportButton);
        
        if (dropdownMenu) {
          if (dotsElement.classList.contains('active')) {
            dropdownMenu.style.display = 'block';
            console.log('Dropdown menu should be visible now');
          } else {
            dropdownMenu.style.display = 'none';
            console.log('Dropdown menu hidden');
          }
        } else if (reportButton) {
          // Handle legacy single report button
          if (dotsElement.classList.contains('active')) {
            reportButton.style.display = 'block';
            console.log('Report button should be visible now');
          } else {
            reportButton.style.display = 'none';
            console.log('Report button hidden');
          }
        } else {
          console.log('No report button found, creating dropdown menu...');
          // Create dropdown menu with both Report and Save buttons
          const meta = dotsElement.closest('.meta');
          if (meta) {
            // Create dropdown container
            const dropdownMenu = document.createElement('div');
            dropdownMenu.className = 'dropdown-menu';
            dropdownMenu.style.cssText = `
              display: block;
              position: absolute;
              top: 100%;
              right: 0;
              background: #fff;
              border: 1px solid #E0E0E0;
              border-radius: 8px;
              box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
              z-index: 1000;
              min-width: 120px;
              margin-top: 5px;
              overflow: hidden;
            `;
            
            // Create Report button
            const reportButton = document.createElement('button');
            reportButton.className = 'dropdown-item';
            reportButton.textContent = 'Report';
            reportButton.addEventListener('click', function(e) {
              e.stopPropagation();
              openModal();
            });
            reportButton.style.cssText = `
              display: block;
              width: 100%;
              padding: 10px 15px;
              background: #fff;
              border: none;
              color: #757575;
              font-family: Inter, sans-serif;
              font-size: 14px;
              text-align: left;
              cursor: pointer;
              transition: all 0.3s ease;
              border-bottom: 1px solid #f0f0f0;
            `;
            
            // Create Save button
            const saveButton = document.createElement('button');
            saveButton.className = 'dropdown-item';
            
            // Set button text based on saved state
            const savedAds = getSavedAds();
            const isSaved = savedAds.includes(window.currentReportAdId);
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
            saveButton.style.cssText = `
              display: block;
              width: 100%;
              padding: 10px 15px;
              background: #fff;
              border: none;
              color: #757575;
              font-family: Inter, sans-serif;
              font-size: 14px;
              text-align: left;
              cursor: pointer;
              transition: all 0.3s ease;
            `;
            
            // Add hover effects
            reportButton.addEventListener('mouseenter', function() {
              this.style.backgroundColor = '#f8f9fa';
            });
            reportButton.addEventListener('mouseleave', function() {
              this.style.backgroundColor = '#fff';
            });
            
            saveButton.addEventListener('mouseenter', function() {
              this.style.backgroundColor = '#f8f9fa';
            });
            saveButton.addEventListener('mouseleave', function() {
              this.style.backgroundColor = '#fff';
            });
            
            // Append buttons to dropdown
            dropdownMenu.appendChild(reportButton);
            dropdownMenu.appendChild(saveButton);
            meta.appendChild(dropdownMenu);
            
            console.log('Dropdown menu created with Report and Save buttons');
          }
        }
        
        // Debug: Check if the function is being called
        console.log('Toggle function called, active state:', dotsElement.classList.contains('active'));
      }
      
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
      function openModal() {
        document.getElementById("reportModal").style.display = "flex";
        console.log('Opening modal with currentReportAdId:', window.currentReportAdId);
      }
      
      function closeModal() {
        document.getElementById("reportModal").style.display = "none";
        // Reset form
        document.getElementById("reportForm").reset();
        // Clear current ad ID
        window.currentReportAdId = null;
      }
      
      // Close when clicking outside modal content
      window.onclick = function(event) {
        const modal = document.getElementById("reportModal");
        if (event.target === modal) {
          closeModal();
        }
        
        // Close dropdown menus when clicking outside
        const dropdownMenus = document.querySelectorAll('.dropdown-menu');
        const dotsElements = document.querySelectorAll('.dots');
        
        dropdownMenus.forEach((dropdown, index) => {
          const dotsElement = dotsElements[index];
          if (dotsElement && !dotsElement.contains(event.target) && !dropdown.contains(event.target)) {
            dotsElement.classList.remove('active');
            dropdown.style.display = 'none';
          }
        });
      }
      
      // Function to close all dropdown menus
      function closeAllDropdowns() {
        document.querySelectorAll('.dots').forEach(dot => {
          dot.classList.remove('active');
          const dropdownMenu = dot.parentElement.querySelector('.dropdown-menu');
          if (dropdownMenu) {
            dropdownMenu.style.display = 'none';
          }
          const reportButton = dot.parentElement.querySelector('.btnreport');
          if (reportButton) {
            reportButton.style.display = 'none';
          }
        });
      }

      // Handle report form submission
      document.addEventListener('DOMContentLoaded', function() {
        // Add global event listeners for closing dropdowns
        document.addEventListener('click', function(event) {
          // Small delay to prevent immediate closure when opening dropdown
          setTimeout(() => {
            // Close dropdowns when clicking outside
            const dropdownMenus = document.querySelectorAll('.dropdown-menu');
            const dotsElements = document.querySelectorAll('.dots');
            
            let clickedInsideDropdown = false;
            dropdownMenus.forEach((dropdown, index) => {
              const dotsElement = dotsElements[index];
              if (dotsElement && (dotsElement.contains(event.target) || dropdown.contains(event.target))) {
                clickedInsideDropdown = true;
              }
            });
            
            if (!clickedInsideDropdown) {
              closeAllDropdowns();
            }
          }, 10);
        });

        // Close dropdowns on escape key
        document.addEventListener('keydown', function(event) {
          if (event.key === 'Escape') {
            closeAllDropdowns();
          }
        });

        // Close dropdowns when window loses focus
        window.addEventListener('blur', function() {
          closeAllDropdowns();
        });

        const reportForm = document.getElementById('reportForm');
        if (reportForm) {
          reportForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const reason = document.getElementById('reportReason').value;
            const description = document.getElementById('reportDescription').value;
            
            if (!reason) {
              showNotification('Please select a reason for the report', 'error');
              return;
            }
            
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (!csrfToken) {
              console.error('CSRF token not found');
              showNotification('Security token not found. Please refresh the page and try again.', 'error');
              return;
            }

            // Check if we have a valid ad ID
            if (!window.currentReportAdId) {
              console.error('No ad ID found for report');
              showNotification('Error: Could not identify the ad. Please try again.', 'error');
              return;
            }

            // Prepare request data
            const requestData = {
              ad_id: window.currentReportAdId,
              reason: reason,
              description: description
            };

            console.log('Submitting report with data:', requestData);

            // Send report to backend
            fetch('/report', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                'Accept': 'application/json'
              },
              body: JSON.stringify(requestData)
            })
            .then(response => {
              console.log('Response status:', response.status);
              if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
              }
              return response.json();
            })
            .then(data => {
              console.log('Response data:', data);
              if (data.success) {
                showNotification(data.message, 'success');
                closeModal();
              } else {
                showNotification(data.message || 'Report submission failed', 'error');
              }
            })
            .catch(error => {
              console.error('Error submitting report:', error);
              showNotification('Error submitting report. Please try again.', 'error');
            });
            
            // Close the report dropdown
            const activeDots = document.querySelector('.dots.active');
            if (activeDots) {
              activeDots.classList.remove('active');
              const dropdownMenu = activeDots.parentElement.querySelector('.dropdown-menu');
              if (dropdownMenu) {
                dropdownMenu.style.display = 'none';
              }
              const reportButton = activeDots.parentElement.querySelector('.btnreport');
              if (reportButton) {
                reportButton.style.display = 'none';
              }
            }
          });
        }
      });
      
      // Pagination functionality
      let currentPage = 1;
      const itemsPerPage = 8;
      const totalItems = 24;
      const totalPages = Math.ceil(totalItems / itemsPerPage);
      
      function updatePaginationInfo() {
        const startRange = (currentPage - 1) * itemsPerPage + 1;
        const endRange = Math.min(currentPage * itemsPerPage, totalItems);
        
        document.getElementById('startRange').textContent = startRange;
        document.getElementById('endRange').textContent = endRange;
        document.getElementById('totalItems').textContent = totalItems;
      }
      
      function updatePaginationButtons() {
        const prevBtn = document.querySelector('.prev-btn');
        const nextBtn = document.querySelector('.next-btn');
        
        // Update Previous button
        prevBtn.disabled = currentPage === 1;
        if (currentPage === 1) {
          prevBtn.classList.add('disabled');
        } else {
          prevBtn.classList.remove('disabled');
        }
        
        // Update Next button
        nextBtn.disabled = currentPage === totalPages;
        if (currentPage === totalPages) {
          nextBtn.classList.add('disabled');
        } else {
          nextBtn.classList.remove('disabled');
        }
      }
      
      function updatePageNumbers() {
        const pageNumbers = document.querySelector('.page-numbers');
        pageNumbers.innerHTML = '';
        
        // Always show first page
        const firstPage = document.createElement('button');
        firstPage.className = `page-number ${currentPage === 1 ? 'active' : ''}`;
        firstPage.onclick = () => goToPage(1);
        firstPage.textContent = '1';
        pageNumbers.appendChild(firstPage);
        
        // Show pages around current page
        const startPage = Math.max(2, currentPage - 1);
        const endPage = Math.min(totalPages - 1, currentPage + 1);
        
        if (startPage > 2) {
          const dots1 = document.createElement('span');
          dots1.className = 'page-dots';
          dots1.textContent = '...';
          pageNumbers.appendChild(dots1);
        }
        
        for (let i = startPage; i <= endPage; i++) {
          const pageBtn = document.createElement('button');
          pageBtn.className = `page-number ${currentPage === i ? 'active' : ''}`;
          pageBtn.onclick = () => goToPage(i);
          pageBtn.textContent = i;
          pageNumbers.appendChild(pageBtn);
        }
        
        if (endPage < totalPages - 1) {
          const dots2 = document.createElement('span');
          dots2.className = 'page-dots';
          dots2.textContent = '...';
          pageNumbers.appendChild(dots2);
        }
        
        // Always show last page if there are more than 1 page
        if (totalPages > 1) {
          const lastPage = document.createElement('button');
          lastPage.className = `page-number ${currentPage === totalPages ? 'active' : ''}`;
          lastPage.onclick = () => goToPage(totalPages);
          lastPage.textContent = totalPages;
          pageNumbers.appendChild(lastPage);
        }
      }
      
      function changePage(direction) {
        if (direction === 'prev' && currentPage > 1) {
          currentPage--;
        } else if (direction === 'next' && currentPage < totalPages) {
          currentPage++;
        }
        
        updatePaginationInfo();
        updatePaginationButtons();
        updatePageNumbers();
        
        // Scroll to top of ads section
        document.querySelector('.ads-grid').scrollIntoView({ behavior: 'smooth' });
      }
      
      function goToPage(page) {
        if (page >= 1 && page <= totalPages) {
          currentPage = page;
          updatePaginationInfo();
          updatePaginationButtons();
          updatePageNumbers();
          
          // Scroll to top of ads section
          document.querySelector('.ads-grid').scrollIntoView({ behavior: 'smooth' });
        }
      }
      
      // Initialize pagination
      document.addEventListener("DOMContentLoaded", function() {
        updatePaginationInfo();
        updatePaginationButtons();
        updatePageNumbers();
        
              // Make all ad cards clickable (only if they don't have onclick attribute)
      const adCards = document.querySelectorAll('.ad-card');
      adCards.forEach(card => {
        // Add event listener to prevent clicks on interactive elements from triggering card navigation
        card.addEventListener('click', function(e) {
          // Don't redirect if clicking on report button, dots, or like container
          if (e.target.closest('.btnreport') || e.target.closest('.dots') || e.target.closest('.like-container')) {
            e.stopPropagation();
            return;
          }
        });
      });
      

      
      // Add click handlers to all dots and create report buttons
      document.addEventListener("DOMContentLoaded", function() {
        console.log('DOMContentLoaded - creating report buttons');
        const allDots = document.querySelectorAll('.dots');
        console.log('Found dots elements:', allDots.length);
        
        allDots.forEach((dots, index) => {
          // Check if report button exists, if not create one
          const meta = dots.closest('.meta');
          console.log(`Dots ${index}: meta element found:`, !!meta);
          
          if (meta && !meta.querySelector('.btnreport')) {
            const reportButton = document.createElement('button');
            reportButton.className = 'btnreport';
            reportButton.setAttribute('onclick', 'event.stopPropagation(); openModal()');
            reportButton.textContent = 'Report';
            reportButton.style.cssText = `
              display: none;
              position: absolute;
              top: 100%;
              right: 0;
              background: #fff;
              border: 1px solid #E0E0E0;
              border-radius: 8px;
              box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
              z-index: 1000;
              min-width: 120px;
              padding: 10px 15px;
              margin-top: 5px;
              color: #757575;
              font-family: Inter, sans-serif;
              font-size: 14px;
              text-align: left;
              cursor: pointer;
              transition: all 0.3s ease;
              border: none;
            `;
            meta.appendChild(reportButton);
            console.log(`Report button created for dots ${index}`);
          } else {
            console.log(`Report button already exists for dots ${index}`);
          }
        });
      });
      
      // Close dropdowns when clicking outside
      document.addEventListener('click', function(e) {
        if (!e.target.closest('.dots')) {
          document.querySelectorAll('.dots').forEach(dot => {
            dot.classList.remove('active');
            // Hide all report buttons
            const reportButton = dot.parentElement.querySelector('.btnreport');
            if (reportButton) {
              reportButton.style.display = 'none';
            }
          });
        }
      });
      });
      
      // Heart Icon Functionality - Only handles likes in database
      function toggleLike(adId, element) {
        const heartIcon = element.querySelector('.saved-heart-icon');
        
        // Check current like state from browser storage
        const likedAds = getLikedAds();
        const isLiked = likedAds.includes(adId);
        
        if (isLiked) {
          // If currently liked, unlike it
          updateLikeInDatabase(adId, 'unlike');
          heartIcon.classList.remove('saved');
          removeLikedAd(adId);
        } else {
          // If not liked, like it
          updateLikeInDatabase(adId, 'like');
          heartIcon.classList.add('saved');
          addLikedAd(adId);
        }
      }
      
      // Save Button Functionality - Only handles browser storage
      function toggleSavedAd(adId, element) {
        const savedAds = getSavedAds();
        
        if (savedAds.includes(adId)) {
          // Remove from saved ads
          removeSavedAd(adId);
          showNotification('Ad removed from saved ads', 'info');
        } else {
          // Add to saved ads
          addSavedAd(adId);
          showNotification('Ad saved successfully!', 'success');
        }
      }
      
      function updateLikeInDatabase(adId, action) {
        // Show loading state
        const heartIcon = document.querySelector(`[data-ad-id="${adId}"]`);
        if (heartIcon) {
          heartIcon.style.opacity = '0.7';
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
            // Update like count on the page
            document.querySelectorAll(`[data-ad-id="${adId}"]`).forEach(icon => {
              const container = icon.closest('.like-container');
              if (container) {
                const countElement = container.querySelector('.likes-count');
                if (countElement) {
                  countElement.textContent = data.total_likes;
                }
              }
            });
            
            // Update like count in ad detail page if exists
            const detailLikesCount = document.querySelector('.likes-count');
            if (detailLikesCount && window.location.pathname.includes(`/ad/${adId}`)) {
              detailLikesCount.textContent = data.total_likes;
            }
            
            // Don't show notification for like/unlike actions to avoid spam
            // showNotification(data.message, 'success');
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
          if (heartIcon) {
            heartIcon.style.opacity = '1';
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
        } else if (type === 'error') {
          notification.style.background = 'linear-gradient(135deg, #dc3545, #c82333)';
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
      
      // Function to open WhatsApp with phone number
      function openWhatsApp(phoneNumber) {
        // Remove any non-digit characters from the phone number
        const cleanNumber = phoneNumber.replace(/\D/g, '');
        
        // If the number doesn't start with country code, assume it's a local number
        // You can modify this logic based on your needs
        let formattedNumber = cleanNumber;
        
        // If it's a 10-digit number, assume it's US/Canada and add +1
        if (cleanNumber.length === 10) {
          formattedNumber = '1' + cleanNumber;
        }
        // If it's an 11-digit number starting with 1, it's already formatted
        else if (cleanNumber.length === 11 && cleanNumber.startsWith('1')) {
          formattedNumber = cleanNumber;
        }
        // If it's a 12-digit number starting with 91, it's Indian number
        else if (cleanNumber.length === 12 && cleanNumber.startsWith('91')) {
          formattedNumber = cleanNumber;
        }
        // If it's a 13-digit number starting with 91, it's Indian number with +91
        else if (cleanNumber.length === 13 && cleanNumber.startsWith('91')) {
          formattedNumber = cleanNumber.substring(1);
        }
        
        // Create WhatsApp Web URL
        const whatsappUrl = `https://wa.me/${formattedNumber}`;
        
        // Open WhatsApp Web in a new tab
        window.open(whatsappUrl, '_blank');
      }
      
      // Function to perform search
      function performSearch() {
        const searchInput = document.getElementById('searchInput');
        const query = searchInput.value.trim();
        
        if (query) {
          window.location.href = '/search?q=' + encodeURIComponent(query);
        }
      }
      
      // Initialize heart icons and save buttons on page load
      document.addEventListener('DOMContentLoaded', function() {
        const likedAds = getLikedAds();
        const savedAds = getSavedAds();
        const heartIcons = document.querySelectorAll('.saved-heart-icon');
        
        // Set heart icon appearance based on liked ads storage
        heartIcons.forEach(icon => {
          const adId = parseInt(icon.getAttribute('data-ad-id'));
          if (likedAds.includes(adId)) {
            icon.classList.add('saved'); // Blue heart for liked ads
          } else {
            icon.classList.remove('saved'); // Red heart for unliked ads
          }
        });
        
        // Add enter key support for search
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
          searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
              performSearch();
            }
          });
        }
      });
      
      </script>
      
      @yield('scripts')
</body>
</html>