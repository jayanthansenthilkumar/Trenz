document.addEventListener('DOMContentLoaded', function() {
    if (typeof particlesJS !== 'undefined' && document.getElementById('particles-js')) {
        // Check if this is the login page
        if (document.body.classList.contains('login-page')) {
            particlesJS('particles-js', {
                particles: {
                    number: { value: 80 },
                    color: { value: '#2563eb' },
                    opacity: { value: 0.2 }, // Increased opacity for better visibility
                    size: { value: 3 },
                    line_linked: {
                        enable: true,
                        distance: 150,
                        color: '#2563eb',
                        opacity: 0.1, // Increased opacity for better visibility
                        width: 1
                    },
                    move: {
                        enable: true,
                        speed: 2
                    }
                }
            });
        } else {
            // Default particles for other pages
            particlesJS('particles-js', {
                particles: {
                    number: { value: 80 },
                    color: { value: '#2563eb' },
                    opacity: { value: 0.2 },
                    size: { value: 3 },
                    line_linked: {
                        enable: true,
                        distance: 150,
                        color: '#2563eb',
                        opacity: 0.1,
                        width: 1
                    },
                    move: {
                        enable: true,
                        speed: 2
                    }
                }
            });
        }
    } else {
        console.error('Particles.js not found');
    }

    // Enhanced smooth navigation for all anchor links in the page
    const allLinks = document.querySelectorAll('a[href^="#"]');
    
    allLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            
            if (targetId && targetId !== '#') {
                const targetSection = document.getElementById(targetId.substring(1));
                
                if (targetSection) {
                    targetSection.scrollIntoView({ behavior: 'smooth' });
                }
            }
        });
    });
    const fileInput1 = document.getElementById('Idcard');
    if (fileInput1) {
        const fileName = document.querySelector('.file-name1');
        
        fileInput1.addEventListener('change', function() {
            if (this.files.length > 0) {
                fileName.textContent = this.files[0].name;
            } else {
                fileName.textContent = 'No file chosen';
            }
        });
    }

    // File upload name display
    const fileInput = document.getElementById('paymentProof');
    if (fileInput) {
        const fileName = document.querySelector('.file-name');
        
        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                fileName.textContent = this.files[0].name;
            } else {
                fileName.textContent = 'No file chosen';
            }
        });
    }
    
    // Set default date to today for transaction date
    const transactionDate = document.getElementById('transactionDate');
    if (transactionDate) {
        const today = new Date();
        const formattedDate = today.toISOString().split('T')[0];
        transactionDate.value = formattedDate;
    }

    // Tab functionality
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');
    
    if (tabButtons.length > 0) {
        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons and contents
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));
                
                // Add active class to clicked button and related content
                this.classList.add('active');
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });
    }

    // Fixed tab functionality for registration form with improved validation
    const regTabBtns = document.querySelectorAll('.tab-btn');
    const regTabContents = document.querySelectorAll('.tab-content'); // Fixed selector
    
    if (regTabBtns.length > 0) {
        // Validate all fields in a tab
        function validateTab(tabId) {
            const tab = document.getElementById(tabId);
            if (!tab) return true; // If tab doesn't exist, consider it valid
            
            const requiredFields = tab.querySelectorAll('input[required], select[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('invalid');
                    
                    // Add shake animation to highlight error
                    field.animate(
                        [
                            { transform: 'translateX(0px)' },
                            { transform: 'translateX(-5px)' },
                            { transform: 'translateX(5px)' },
                            { transform: 'translateX(-5px)' },
                            { transform: 'translateX(0px)' }
                        ],
                        { duration: 300 }
                    );
                } else {
                    field.classList.remove('invalid');
                }
            });
            
            return isValid;
        }

        // Handle tab button clicks with validation
        regTabBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const currentActiveTab = document.querySelector('.tab-content.active').id;
                const targetTab = this.getAttribute('data-tab');
                
                // If trying to access payment-details, validate personal-info first
                if (targetTab === 'payment-details') {
                    // Validate the personal-info tab first
                    if (!validateTab('personal-info')) {
                        // Show error using SweetAlert for better UX
                        Swal.fire({
                            title: 'Missing Information',
                            text: 'Please fill all required fields in the Personal Information section before proceeding.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                        return; // Stop execution if invalid
                    }
                }
                
                // If all validations pass, switch tabs
                regTabBtns.forEach(b => b.classList.remove('active'));
                regTabContents.forEach(c => c.classList.remove('active'));
                
                this.classList.add('active');
                document.getElementById(targetTab).classList.add('active');
            });
        });
        
        // Handle next button clicks
        const nextTabBtns = document.querySelectorAll('.next-tab');
        nextTabBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const nextTabId = this.getAttribute('data-next');
                const currentTab = this.closest('.tab-content');
                
                // Validate current tab
                if (!validateTab(currentTab.id)) {
                    return; // Stop if invalid
                }
                
                if (nextTabId) {
                    // Switch to next tab
                    regTabBtns.forEach(b => b.classList.remove('active'));
                    regTabContents.forEach(c => c.classList.remove('active'));
                    
                    const nextTabBtn = document.querySelector(`[data-tab="${nextTabId}"]`);
                    const nextTabContent = document.getElementById(nextTabId);
                    
                    if (nextTabBtn && nextTabContent) {
                        nextTabBtn.classList.add('active');
                        nextTabContent.classList.add('active');
                    }
                }
            });
        });
        
        // Handle previous button clicks
        const prevTabBtns = document.querySelectorAll('.prev-tab');
        prevTabBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const prevTabId = this.getAttribute('data-prev');
                
                if (prevTabId) {
                    // Switch to previous tab
                    regTabBtns.forEach(b => b.classList.remove('active'));
                    regTabContents.forEach(c => c.classList.remove('active'));
                    
                    const prevTabBtn = document.querySelector(`[data-tab="${prevTabId}"]`);
                    const prevTabContent = document.getElementById(prevTabId);
                    
                    if (prevTabBtn && prevTabContent) {
                        prevTabBtn.classList.add('active');
                        prevTabContent.classList.add('active');
                    }
                }
            });
        });
        
        // Add input validation styling
        document.querySelectorAll('.registration-form input, .registration-form select').forEach(field => {
            field.addEventListener('input', function() {
                if (this.hasAttribute('required')) {
                    if (this.value.trim()) {
                        this.classList.remove('invalid');
                    } else {
                        this.classList.add('invalid');
                    }
                }
            });
        });
    }

    // Event selection dropdown logic - prevent duplicate selections
    const event1Dropdown = document.getElementById('event1');
    const event2Dropdown = document.getElementById('event2');

    if (event1Dropdown && event2Dropdown) {
        // Store all original options from event2 dropdown
        const originalEvent2Options = Array.from(event2Dropdown.options);
        
        // Update event2 options when event1 selection changes
        event1Dropdown.addEventListener('change', function() {
            const selectedValue = this.value;
            
            // Reset event2 dropdown to original options
            event2Dropdown.innerHTML = '';
            
            // Add back all options except the one selected in event1
            originalEvent2Options.forEach(option => {
                if (option.value !== selectedValue || option.value === '') {
                    event2Dropdown.appendChild(option.cloneNode(true));
                }
            });
            
            // If the previously selected event2 option is now the one selected in event1, reset event2
            if (event2Dropdown.value === selectedValue) {
                event2Dropdown.value = '';
            }
        });
        
        // Similarly, update event1 options when event2 selection changes
        event2Dropdown.addEventListener('change', function() {
            const selectedValue = this.value;
            
            // No need to modify event1 if nothing or default is selected in event2
            if (!selectedValue) return;
            
            // Check if the selected event in event2 is also selected in event1
            if (event1Dropdown.value === selectedValue) {
                // Alert user about duplicate selection
                alert("You cannot select the same event twice. Please choose a different event.");
                // Reset event2 selection
                this.value = '';
            }
        });
    }

    // Admin Dashboard Functionality
    
    // Toggle Sidebar
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');
    
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });
    }
    
    // Close sidebar when clicking outside (mobile)
    document.addEventListener('click', function(e) {
        if (sidebar && sidebar.classList.contains('active') && 
            !sidebar.contains(e.target) && 
            e.target !== sidebarToggle) {
            sidebar.classList.remove('active');
        }
    });
    
    // Update greeting icon based on time of day
    const greetingIcon = document.querySelector('.greeting-icon i');
    if (greetingIcon) {
        const hour = new Date().getHours();
        
        if (hour >= 5 && hour < 12) {
            // Morning
            greetingIcon.classList.remove('ri-sun-line');
            greetingIcon.classList.add('ri-sun-line');
        } else if (hour >= 12 && hour < 18) {
            // Afternoon
            greetingIcon.classList.remove('ri-sun-line');
            greetingIcon.classList.add('ri-sun-foggy-line');
        } else {
            // Evening/Night
            greetingIcon.classList.remove('ri-sun-line');
            greetingIcon.classList.add('ri-moon-clear-line');
        }
    }
    
    // Active state for sidebar menu items with updated title
    const sidebarLinks = document.querySelectorAll('.sidebar-menu a');
    
    if (sidebarLinks.length > 0) {
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                // Remove active class from parent li elements
                document.querySelectorAll('.sidebar-menu li').forEach(item => {
                    item.classList.remove('active');
                });
                
                // Add active class to current li parent
                this.parentElement.classList.add('active');
                
                // No longer updating welcome card text
            });
        });
    }
    
    // Refresh button animation
    const refreshBtn = document.querySelector('.refresh-btn');
    if (refreshBtn) {
        refreshBtn.addEventListener('click', function() {
            this.classList.add('fa-spin');
            setTimeout(() => {
                this.classList.remove('fa-spin');
            }, 1000);
        });
    }

    // User dropdown toggle
    const userDropdown = document.querySelector('.user-dropdown');
    
    if (userDropdown) {
        userDropdown.addEventListener('click', function(e) {
            // Prevent this from triggering document click handler
            e.stopPropagation();
            // Toggle active class
            this.querySelector('.dropdown-menu').classList.toggle('active');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function() {
            userDropdown.querySelector('.dropdown-menu').classList.remove('active');
        });
    }

    // Payment Modal Functionality
    const paymentModal = document.getElementById('payment-modal');
    const paymentButtons = document.querySelectorAll('.payment-btn');
    const modalCloseButtons = document.querySelectorAll('.modal-close');
    
    if (paymentButtons.length > 0 && paymentModal) {
        // Open modal when payment button is clicked
        paymentButtons.forEach(button => {
            button.addEventListener('click', function() {
                // The actual payment data will come from the database
                const participantId = this.getAttribute('data-participant');
                
                // Show the modal
                paymentModal.classList.add('active');
                document.body.style.overflow = 'hidden'; // Prevent scrolling
            });
        });
        
        // Close modal when close button is clicked
        if (modalCloseButtons) {
            modalCloseButtons.forEach(button => {
                button.addEventListener('click', function() {
                    paymentModal.classList.remove('active');
                    document.body.style.overflow = ''; // Re-enable scrolling
                });
            });
        }
        
        // Close modal when clicking outside the modal content
        paymentModal.addEventListener('click', function(e) {
            if (e.target === paymentModal) {
                paymentModal.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
        
        // Close modal on Escape key press
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && paymentModal.classList.contains('active')) {
                paymentModal.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }
    
    // Initialize DataTable on participants table - Only run if jQuery is available
    if (typeof jQuery !== 'undefined') {
        jQuery(document).ready(function($) {
            if ($("#participants-table").length) {
                $("#participants-table").DataTable({
                    responsive: true,
                    pageLength: 10,
                    lengthMenu: [5, 10, 25, 50, 100],
                    language: {
                        search: "Search:",
                        lengthMenu: "Show _MENU_ entries",
                        info: "Showing _START_ to _END_ of _TOTAL_ entries",
                        paginate: {
                            first: "First",
                            last: "Last",
                            next: "<i class='ri-arrow-right-s-line'></i>",
                            previous: "<i class='ri-arrow-left-s-line'></i>"
                        }
                    },
                    initComplete: function() {
                        // Remove the default DataTables controls and use our custom ones
                        $('.dataTables_length').addClass('hidden');
                        $('.dataTables_filter').addClass('hidden');
                        
                        // Connect our custom controls to DataTables API
                        $('.datatable-length select').on('change', function() {
                            $('#participants-table').DataTable().page.len($(this).val()).draw();
                        });
                        
                        $('.datatable-filter input').on('keyup', function() {
                            $('#participants-table').DataTable().search($(this).val()).draw();
                        });
                    }
                });
            }
            
            if ($("#registered-table").length) {
                $("#registered-table").DataTable({
                    responsive: true,
                    pageLength: 10,
                    lengthMenu: [5, 10, 25, 50, 100],
                    language: {
                        search: "Search:",
                        lengthMenu: "Show _MENU_ entries",
                        info: "Showing _START_ to _END_ of _TOTAL_ entries",
                        paginate: {
                            first: "First",
                            last: "Last",
                            next: "<i class='ri-arrow-right-s-line'></i>",
                            previous: "<i class='ri-arrow-left-s-line'></i>"
                        }
                    },
                    initComplete: function() {
                        // Remove the default DataTables controls and use our custom ones
                        $('.dataTables_length').addClass('hidden');
                        $('.dataTables_filter').addClass('hidden');
                        
                        // Connect our custom controls to DataTables API
                        $('.datatable-length select').on('change', function() {
                            $('#registered-table').DataTable().page.len($(this).val()).draw();
                        });
                        
                        $('.datatable-filter input').on('keyup', function() {
                            $('#registered-table').DataTable().search($(this).val()).draw();
                        });
                    }
                });
            }
            
            if ($("#approved-table").length) {
                $("#approved-table").DataTable({
                    responsive: true,
                    pageLength: 10,
                    lengthMenu: [5, 10, 25, 50, 100],
                    language: {
                        search: "Search:",
                        lengthMenu: "Show _MENU_ entries",
                        info: "Showing _START_ to _END_ of _TOTAL_ entries",
                        paginate: {
                            first: "First",
                            last: "Last",
                            next: "<i class='ri-arrow-right-s-line'></i>",
                            previous: "<i class='ri-arrow-left-s-line'></i>"
                        }
                    },
                    initComplete: function() {
                        // Remove the default DataTables controls and use our custom ones
                        $('.dataTables_length').addClass('hidden');
                        $('.dataTables_filter').addClass('hidden');
                        
                        // Connect our custom controls to DataTables API in approved tab
                        $('#approved-tab .datatable-length select').on('change', function() {
                            $('#approved-table').DataTable().page.len($(this).val()).draw();
                        });
                        
                        $('#approved-tab .datatable-filter input').on('keyup', function() {
                            $('#approved-table').DataTable().search($(this).val()).draw();
                        });
                    }
                });
            }

            if ($("#spot-registration-table").length) {
                $("#spot-registration-table").DataTable({
                    responsive: true,
                    pageLength: 10,
                    lengthMenu: [5, 10, 25, 50, 100],
                    language: {
                        search: "Search:",
                        lengthMenu: "Show _MENU_ entries",
                        info: "Showing _START_ to _END_ of _TOTAL_ entries",
                        paginate: {
                            first: "First",
                            last: "Last",
                            next: "<i class='ri-arrow-right-s-line'></i>",
                            previous: "<i class='ri-arrow-left-s-line'></i>"
                        }
                    },
                    initComplete: function() {
                        // Remove the default DataTables controls and use our custom ones
                        $('.dataTables_length').addClass('hidden');
                        $('.dataTables_filter').addClass('hidden');
                        
                        // Connect our custom controls to DataTables API in spot registration tab
                        $('#spot-registration-tab .datatable-length select').on('change', function() {
                            $('#spot-registration-table').DataTable().page.len($(this).val()).draw();
                        });
                        
                        $('#spot-registration-tab .datatable-filter input').on('keyup', function() {
                            $('#spot-registration-table').DataTable().search($(this).val()).draw();
                        });
                    }
                });
            }
        });
    }

    // Patrons section horizontal scrolling
    const patronsContainer = document.querySelector('.patrons-container');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    
    if (patronsContainer && prevBtn && nextBtn) {
        // Calculate scroll amount based on card width + gap
        const scrollAmount = 380; // Card width (350px) + gap (30px)
        
        prevBtn.addEventListener('click', () => {
            patronsContainer.scrollBy({
                left: -scrollAmount,
                behavior: 'smooth'
            });
        });
        
        nextBtn.addEventListener('click', () => {
            patronsContainer.scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
        });
        
        // Show/hide buttons based on scroll position
        patronsContainer.addEventListener('scroll', () => {
            // Check if we can scroll left
            prevBtn.style.opacity = patronsContainer.scrollLeft > 0 ? '1' : '0.5';
            
            // Check if we can scroll right
            const maxScrollLeft = patronsContainer.scrollWidth - patronsContainer.clientWidth;
            nextBtn.style.opacity = patronsContainer.scrollLeft < maxScrollLeft - 10 ? '1' : '0.5';
        });
        
        // Initialize button states
        setTimeout(() => {
            prevBtn.style.opacity = '0.5'; // Start with prev button disabled
            const maxScrollLeft = patronsContainer.scrollWidth - patronsContainer.clientWidth;
            nextBtn.style.opacity = maxScrollLeft > 10 ? '1' : '0.5';
        }, 100);
    }
});
