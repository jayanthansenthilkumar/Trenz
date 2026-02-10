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
document.addEventListener("DOMContentLoaded", function () {
  // Event Data Configuration
  const eventsData = {
    appdev: {
      title: "App Dev Pro Challenge",
      headerTitle: "App Dev Pro Challenge 2025",
      image: "./assets/images/appdev.avif",
      meta: [
        { icon: "ri-calendar-line", text: "April 30, 2025" },
        { icon: "ri-time-line", text: "09:00 AM - 4:00 PM" },
        { icon: "ri-user-line", text: "Individual/Team (max 2 members)" },
      ],
      rulesHTML: `
                <h3>Rules & Guidelines</h3>
                <ul class="rules-list">
                    <li><strong>Name of the Event:</strong> APP A THON</li>
                    <li><strong>Event Overview:</strong> Participants will build a functional web application integrated with a database within the given time limit. The focus is on real-time problem-solving, effective database usage, and efficient coding practices.</li>
                    
                    <li><strong>Participation Format:</strong>
                        <div class="sub-points">
                            <ul>
                                <li>Team participation only — Maximum 2 members per team.</li>
                                <li>Each team can submit only one project.</li>
                            </ul>
                        </div>
                    </li>
                    
                    <li><strong>Event Structure:</strong>
                        <div class="sub-points">
                            <p><em>Development Phase:</em></p>
                            <ul>
                                <li>Teams can develop the web app based on their own topic.</li>
                                <li>3 hours will be provided to build a complete web app with database integration.</li>
                                
                            </ul>
                            <p><em>Demonstration Phase:</em></p>
                            <ul>
                                <li>Each team will briefly present their app to the judges (5–7 minutes).</li>
                            </ul>
                        </div>
                    </li>
                    
                    <li><strong>General Rules:</strong>
                        <div class="sub-points">
                            <ul>
                                <li>All apps must be developed from scratch during the event duration.</li>
                                <li>Design is not important, marks will be provided based on the functionalities of the web app.</li>
                                <li>Database integration is mandatory (e.g., MySQL, MongoDB, Firebase, PostgreSQL, etc.).</li>
                                <li>Any programming language, framework, or database technology can be used.</li>
                                <li>Use of online resources (documentation, libraries) is allowed. Pre-built projects/templates are not allowed.</li>
                                <li>Projects must be submitted within 3 hours. Late submissions will not be evaluated.</li>
                                <li>Teams must demonstrate the functionality of their web app live in front of the judges.</li>
                                <li>Respect towards organizers, judges, and fellow participants is expected at all times.</li>
                            </ul>
                        </div>
                    </li>
                    
                    <li><strong>Technical Requirements:</strong>
                        <div class="sub-points">
                            <ul>
                                <li>The app must run on a standard browser (e.g., Chrome, Firefox).</li>
                                <li>A working database backend must be demonstrated (insert, retrieve, update, delete operations).</li>
                                <li>Teams must submit their source code at the end of the event.</li>
                                <li>If hosting is not possible within the time, a local server demonstration is acceptable.</li>
                            </ul>
                        </div>
                    </li>
                    
                    <li><strong>Judging Criteria:</strong>
                        <div class="judging-criteria">
                            <ul class="criteria-list">
                                <li class="criteria-item">Functionality and Working Model - 40%</li>
                                <li class="criteria-item">Database Design and Usage - 35%</li>
                                <li class="criteria-item">Innovation and Creativity - 15%</li>
                                <li class="criteria-item">Code Quality and Structure - 10%</li>
                            </ul>
                        </div>
                    </li>
                    
                    <li><strong>Bonus Points:</strong>
                        <div class="sub-points">
                            <ul>
                                <li>Extra points for creative database structures (e.g., relational integrity, optimized queries).</li>
                                <li>Bonus for real-world applicability and scalability ideas.</li>
                            </ul>
                        </div>
                    </li>
                    
                    <li><strong>Important Notes:</strong>
                        <div class="sub-points">
                            <ul>
                                <li>Maintain frequent local saves/backups — no excuses for data loss.</li>
                                <li>Focus on creating, innovating, and learning.</li>
                                <li>Stay calm, collaborate effectively, and code smart!</li>
                                <li>Judges' decisions will be final and binding.</li>
                            </ul>
                        </div>
                    </li>
                </ul>
            `,
    },
    codequest: {
      title: "Code Quest",
      headerTitle: "Code Quest - Coding Treasure Hunt Challenge",
      image: "./assets/images/codehunt.png",
      meta: [
        { icon: "ri-calendar-line", text: "April 30, 2025" },
        { icon: "ri-time-line", text: "09:00 AM - 4:00 PM" },
        { icon: "ri-user-line", text: "Teams of 2 members" },
      ],
      rulesHTML: `
                <h3>Rules & Guidelines</h3>
                <ul class="rules-list">
                    <li><strong>Name of the Event:</strong> Code Quest</li>
                    
                    <li><strong>Event Overview:</strong> Code Quest is an exciting two-round event that blends the thrill of a treasure hunt with the depth of technical knowledge. Participants will first compete in a technical quiz that tests their coding logic, algorithmic thinking, and analytical skills. Qualifying teams will then move to a fast-paced treasure hunt where they decode clues, solve programming challenges, and race to the finish. It's the perfect combination of brainpower, teamwork, and tech-savvy adventure.</li>
                    
                    <li><strong>Participation Format:</strong>
                        <div class="sub-points">
                            <ul>
                                <li>Team Participation Only – Maximum of 2 members per team</li>
                                <li>All team members must be registered before the event begins</li>
                            </ul>
                        </div>
                    </li>
                    
                    <li><strong>Event Structure:</strong>
                        <div class="sub-points">
                            <div class="round-container">
                                <p class="round-title"><i class="ri-questionnaire-line"></i> Round 1: Technical Quiz</p>
                                <ul>
                                    <li>A written/online quiz focused on:
                                        <ul style="margin-top: 5px; margin-left: 20px;">
                                            <li>Coding logic</li>
                                            <li>Algorithmic thinking</li>
                                            <li>Programming puzzles</li>
                                            <li>Pattern recognition</li>
                                        </ul>
                                    </li>
                                    <li>Format: Multiple Choice Questions, Short Code Snippets, and Logical Riddles</li>
                                    <li>Duration: 30–45 minutes</li>
                                    <li>Top-performing teams will be shortlisted for the next round based on score and accuracy</li>
                                </ul>
                            </div>
                            
                            <div class="round-container">
                                <p class="round-title"><i class="ri-treasure-map-line"></i> Round 2: Coding Treasure Hunt</p>
                                <ul>
                                    <li>Qualified teams will proceed to a multi-stage treasure hunt</li>
                                    <li>Each stage involves solving code-based clues, logic challenges, or decoding encrypted tasks</li>
                                    <li>Correct answers will unlock the next clue or location</li>
                                    <li>Teams must complete all stages to reach the final treasure</li>
                                    <li>Duration: 1.5 to 2 hours</li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    
                    <li><strong>General Rules:</strong>
                        <div class="sub-points">
                            <ul>
                                <li>Teams must not collaborate with other teams</li>
                                <li>All clues and answers must be derived on the spot — no pre-coded templates allowed</li>
                                <li>Tampering with clues or other teams' progress will lead to disqualification</li>
                                <li>Judges' decisions are final and binding</li>
                            </ul>
                        </div>
                    </li>
                </ul>
            `,
    },
    coderewind: {
      title: "Code Rewind",
      headerTitle: "Code Rewind - Reverse Engineering Challenge",
      image: "./assets/images/reverse.webp",
      meta: [
        { icon: "ri-calendar-line", text: "April 30, 2025" },
        { icon: "ri-time-line", text: "9:00 AM - 2:00 PM" },
        { icon: "ri-user-line", text: "Individual/Team (max 2 members)" },
      ],
      rulesHTML: `
                <h3>Rules & Guidelines</h3>
                <ul class="rules-list">
                    <li><strong>Name of the Event:</strong> Code Rewind – Reverse Coding Challenge</li>
                    
                    <li><strong>Event Overview:</strong> Code Rewind is an exciting single-round reverse coding contest designed to test your logic deduction and analytical thinking. Participants are given only the input and output, and must reverse-engineer the hidden logic—true coding detective work!</li>
                    
                    <li><strong>Participation Format:</strong>
                        <div class="sub-points">
                            <ul>
                                <li>This is a team-based event</li>
                                <li>Teams can have 1 or 2 members</li>
                                <li>Solo participation is allowed, but not mandatory</li>
                            </ul>
                        </div>
                    </li>
                    
                    <li><strong>Event Structure:</strong>
                        <div class="sub-points">
                            <p class="section-title" style="margin-left:0;">Single Round with Three Levels</p>
                            <div class="round-container animated-item">
                                <p class="round-title"><i class="ri-code-s-slash-line"></i> Level 1: Easy</p>
                                <ul>
                                    <li>Introductory reverse coding problems</li>
                                </ul>
                            </div>
                            
                            <div class="round-container animated-item">
                                <p class="round-title"><i class="ri-braces-line"></i> Level 2: Medium</p>
                                <ul>
                                    <li>Intermediate complexity problems</li>
                                </ul>
                            </div>
                            
                            <div class="round-container animated-item">
                                <p class="round-title"><i class="ri-code-box-line"></i> Level 3: Hard</p>
                                <ul>
                                    <li>Advanced logical deduction challenges</li>
                                </ul>
                            </div>
                            
                            <p>Total Duration: 2 hours 30 minutes</p>
                            <p>Includes a surprise twist revealed during the contest!</p>
                        </div>
                    </li>
                    
                    <li><strong>Round Format:</strong>
                        <div class="sub-points">
                            <ul>
                                <li>Each question presents only sample inputs and outputs</li>
                                <li>Participants must deduce the logic and write code that reproduces the correct output for any valid input</li>
                                <li>Problems increase in complexity across the three levels</li>
                            </ul>
                        </div>
                    </li>
                    
                    <li><strong>Clarification on Tools and Rules:</strong>
                        <div class="sub-points">
                            <p class="section-title" style="margin-left:0;">Contest Rules</p>
                            <ul>
                                <li>Each team may consist of 1 or 2 members</li>
                                <li>Internet access is allowed for syntax/reference only</li>
                                <li>Use of unfair means (e.g., copying code or searching for direct solutions) will result in a fairness point deduction and may affect rankings</li>
                                <li>Code must work correctly for all possible valid test cases, not just the samples provided</li>
                            </ul>
                            
                            <div class="evaluation-criteria" style="margin-top:20px; padding:15px; background:rgba(67, 97, 238, 0.08); border-radius:8px;">
                                <strong>Evaluation:</strong>
                                <ul>
                                    <li>Number of Questions Solved</li>
                                    <li>Total Time Taken (faster teams win in case of a tie)</li>
                                </ul>
                            </div>
                            
                            <p class="section-title" style="margin-left:0;">Judging Notes</p>
                            <ul>
                                <li>Main focus is on correctness and logical accuracy</li>
                                <li>Efficiency and code clarity are secondary</li>
                                <li>The surprise twist during the round may influence final scores, so stay sharp!</li>
                            </ul>
                        </div>
                    </li>
                </ul>
            `,
    },
    debugging: {
      title: "ERROR : 404 NOT FOUND",
      headerTitle: "ERROR : 404 NOT FOUND - Bug Hunting Challenge",
      image: "./assets/images/coding.png",
      meta: [
        { icon: "ri-calendar-line", text: "April 30, 2025" },
        { icon: "ri-time-line", text: "9:00 AM - 4:00 PM" },
        { icon: "ri-user-line", text: "Individual/Team (max 2 members)" },
      ],
      rulesHTML: `
                <h3>Rules & Guidelines</h3>
                <ul class="rules-list">
                    <li><strong>Name of the Event:</strong> Error 404: Not Found</li>
                    
                    <li><strong>Total Duration:</strong> <span class="duration-icon"><i class="ri-time-line"></i></span>2 Hours
                        <div class="sub-points">
                            <ul>
                                <li>Round 1: Basic Round – 45 minutes</li>
                                <li>Break: 15 minutes</li>
                                <li>Round 2: Scenario-Based Round – 1 hour 30 minutes</li>
                            </ul>
                        </div>
                    </li>
                    
                    <li><strong>Participation Format:</strong>
                        <div class="sub-points">
                            <ul>
                                <li>Individual participation and Team participation (Maximum 2 members per team).</li>
                                <li>All participants will attempt both rounds.</li>
                                <li>There is no elimination between rounds.</li>
                            </ul>
                        </div>
                    </li>
                    
                    <li><strong>General Rules:</strong>
                        <div class="sub-points">
                            <ul>
                                <li>The competition will be conducted in two continuous rounds.</li>
                                <li>All participants must attempt both rounds within the given time limits.</li>
                                <li>Use of online resources is allowed only for documentation or syntax reference.</li>
                                <li>Any form of plagiarism, collaboration, or code sharing will result in disqualification.</li>
                                <li>Final decisions regarding results and disputes rest with the organizing team.</li>
                            </ul>
                        </div>
                    </li>
                    
                    <li><strong>Round Details:</strong>
                        <div class="sub-points">
                            <p class="round-title"><i class="ri-code-line"></i> Round 1: Basic Round</p>
                            <ul>
                                <li>A warm-up round designed to assess core programming knowledge and logical thinking.</li>
                            </ul>
                            
                            <p class="round-title"><i class="ri-terminal-box-line"></i> Round 2: Scenario-Based Round</p>
                            <ul>
                                <li>This round will test real-world problem-solving skills. Participants are expected to apply structured logic, handle edge cases, and write clean, effective code.</li>
                            </ul>
                        </div>
                    </li>
                    
                    <li><strong>Surprise Element!</strong>
                        <div class="sub-points">
                            <div class="surprise-element">
                                <ul>
                                    <li>A bonus twist or challenge will be revealed midway through the event — stay alert and be ready! It may offer extra points or fun tasks to spice things up.</li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    
                    <li><strong>Scoring & Results:</strong>
                        <div class="sub-points">
                            <ul>
                                <li>Final scores will be based on performance in both rounds.</li>
                                <li>In case of a tie, factors such as submission time and code quality may be considered.</li>
                                <li>Results will be announced after a complete evaluation by the organizing team.</li>
                            </ul>
                        </div>
                    </li>
                    
                    <li><strong>Important Notes:</strong>
                        <div class="sub-points">
                            <div class="important-notes">
                                <ul>
                                    <li>Participants are expected to manage time wisely across both rounds.</li>
                                    <li>Judges' decision will be final.</li>
                                    <li>Keep your code clean, readable, and well-commented for effective evaluation.</li>
                                    <li>Have fun, stay focused, and be ready for surprises!</li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            `,
    },
    resumebuilding: {
      title: "Build a Resume",
      headerTitle: "Built a Resume - Professional CV Competition",
      image: "./assets/images/resume.png",
      meta: [
        { icon: "ri-calendar-line", text: "April 30, 2025" },
        { icon: "ri-time-line", text: "09:00 AM - 04:00 PM" },
        { icon: "ri-user-line", text: "Individual Participation" },
      ],
      rulesHTML: `
                <h3>Rules & Guidelines</h3>
                <ul class="rules-list">
                    <li><strong>Name of the Event:</strong> Build a Resume</li>
                    
                    <li><strong>Event Overview:</strong> Build-A-Resume is a resume creation competition where participants will craft a professional resume on the spot using online tools. The competition is designed to test students' ability to present their skills and experiences effectively and professionally.</li>
                    
                    <li><strong>Participation Format:</strong>
                        <div class="sub-points">
                            <ul>
                                <li>Individual participation only</li>
                                <li>Resumes must be created during the event time using online or offline tools</li>
                            </ul>
                        </div>
                    </li>
                    
                    <li><strong>Event Structure:</strong>
                        <div class="sub-points">
                            <ul>
                                <li>Participants will be given a duration of 1.5 to 2 hours to create their resume from scratch</li>
                                <li>Resume can be created using online Platforms</li>
                                <li>At the end of the session, participants must export their resume in PDF format and submit it to the organizers</li>
                            </ul>
                        </div>
                    </li>
                    
                    <li><strong>Clarification on Tools and Rules:</strong>
                        <div class="sub-points">
                            <ul>
                                <li>Participants must be physically present at the event venue</li>
                                <li>Resume must be created during the event duration only</li>
                                <li>Pre-prepared or printed resumes are not allowed</li>
                                <li>Copying from sample resumes or using AI-generated content is prohibited</li>
                                <li>The resume must be created during the event timeframe</li>
                                <li>The resume should not exceed two page (for students/freshers) unless otherwise specified</li>
                                <li>File name format: FullName_Resume.pdf can be send to the email Id which will be shared in the venue</li>
                            </ul>
                        </div>
                    </li>
                </ul>
            `,
    },
    startup: {
      title: "Startup Pitch Competition",
      headerTitle: "Startup Pitch Challenge 2025",
      image: "./assets/images/startup.avif",
      meta: [
        { icon: "ri-calendar-line", text: "April 30, 2025" },
        { icon: "ri-time-line", text: "9:00 AM - 4:00 PM" },
        { icon: "ri-user-line", text: "Teams (1-4 members)" },
      ],
      rulesHTML: `
                <h3>Rules & Guidelines</h3>
                <ul class="rules-list">
                    <li>Name of the Event: <strong>NEXTGEN START-Start Up Ideas</strong></li>
                    <li><strong>Event Overview:</strong> Participants will ignite the spirit of innovation and entrepreneurship among young minds by showcasing cutting-edge startup ideas that can revolutionize industries and improve lives.</li>
                    <li>Participation Format: 
                        <div class="sub-points">
                            <ul>
                                <li>Team Participation – Maximum of (1-4) members per team.</li>
                                <li>All team members must be registered before the event begins.</li>
                            </ul>
                        </div>
                    </li>
                    <li>Event Structure:
                        <div class="sub-points">
                            <p class="round-title">Round 1: Idea Ignition round</p>
                            <ul>
                                <li>Present a startup idea using PowerPoint and explain its views based on your innovation and creativity.</li>
                            </ul>
                            <p class="round-title">Round 2: Concept Crystallization</p>
                            <ul>
                                <li>Based on their concepts delivered, situation based questions can be asked based on their ideas proposed.</li>
                            </ul>
                        </div>
                    </li>
                    <li>Judging Criteria:
                        <div class="judging-criteria">
                            <ul class="criteria-list">
                                <li class="criteria-item">Innovation</li>
                                <li class="criteria-item">Market potential</li>
                                <li class="criteria-item">Feasibility</li>
                                <li class="criteria-item">Presentation</li>
                                <li class="criteria-item">Communication</li>
                            </ul>
                        </div>
                    </li>
                    <li>General Rules:
                        <div class="sub-points">
                            <ul>
                                <li>Each team will have a specific time limit to explain their ideas.</li>
                                <li>Ideas must be realistically implementable with current or near-future technology.</li>
                                <li>Top-performing teams will be selected based on score and accuracy of two rounds.</li>
                            </ul>
                        </div>
                    </li>
                </ul>
            `,
    },
    webdesign: {
      title: "Web Weave Challenge",
      headerTitle: "Web Weave Challenge 2025",
      image: "./assets/images/webdesign.jpg",
      meta: [
        { icon: "ri-calendar-line", text: "April 30, 2025" },
        { icon: "ri-time-line", text: "09:00 AM - 4:00 PM" },
        { icon: "ri-user-line", text: "Individual/Team (max 2 members)" },
      ],
      rulesHTML: `
                <h3>Rules & Guidelines</h3>
                <ul class="rules-list">
                    <li><strong>Event Name:</strong> Web-Designing</li>
                    <li><strong>Overview:</strong> Unleash your creativity and technical prowess in this web design competition where innovation meets functionality. Teams will design a complete website based on a theme of their choice, within the allotted time.</li>
                    <li><strong>Team Format:</strong> 4 members per team</li>
                    <li><strong>Eligibility:</strong> Open to all departments</li>
                    <li><strong>Duration:</strong> 4 hours</li>
                    <li><strong>Theme:</strong> Choose your own theme <br>(e.g., Portfolio, E-commerce, Educational, Non-profit, etc.)</li>
                    <li><strong>Output Required:</strong> A complete static or dynamic website based on the selected theme</li>
                    <li><strong>Tools Allowed:</strong> 
                        <div class="tool-icons">
                            <span class="tool-icon"><i class="ri-code-s-slash-line"></i> Visual Studio Code</span>
                            <span class="tool-icon"><i class="ri-code-box-line"></i> Sublime Text</span>
                            <span class="tool-icon"><i class="ri-layout-line"></i> Figma</span>
                            <span class="tool-icon"><i class="ri-github-fill"></i> GitHub</span>
                        </div>
                    </li>
                    <li><strong>AI Assistance:</strong> AI-based tools (like ChatGPT, GitHub Copilot) are allowed for ideation and code suggestions</li>
                    <li><strong>Judging Criteria:</strong>
                        <div class="judging-criteria">
                            <ul class="criteria-list">
                                <li class="criteria-item">Creativity and Originality</li>
                                <li class="criteria-item">Responsiveness and Functionality</li>
                                <li class="criteria-item">Code Quality and Structure</li>
                                <li class="criteria-item">Aesthetic Design and User Experience</li>
                            </ul>
                        </div>
                    </li>
                </ul>
            `,
    },
  };

  // Helper function to get URL parameters
  function getQueryParam(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
  }

  // Main function to load event data
  function loadEventDetails() {
    const eventId = getQueryParam("id");
    const container = document.getElementById("event-container");
    const pageHeaderTitle = document.getElementById("page-header-title");

    if (eventId && eventsData[eventId]) {
      const data = eventsData[eventId];

      // Update Page Title
      document.title = `${data.title} - Trenz'25`;
      pageHeaderTitle.textContent = data.title;

      // Update Banner
      document.getElementById("event-banner").src = data.image;
      document.getElementById("event-banner").alt = data.title;

      // Update Header Title
      document.getElementById("event-title").textContent = data.headerTitle;

      // Update Meta Info
      const metaContainer = document.getElementById("event-meta");
      metaContainer.innerHTML = ""; // Clear existing

      data.meta.forEach((item) => {
        const metaDiv = document.createElement("div");
        metaDiv.className = "meta-item";
        metaDiv.innerHTML = `<i class="${item.icon}"></i><span>${item.text}</span>`;
        metaContainer.appendChild(metaDiv);
      });

      // Update Rules Content
      document.getElementById("event-details-content").innerHTML =
        data.rulesHTML;
    } else {
      // Handle 404 - Event Not Found
      document.title = "Event Not Found - Trenz'25";
      pageHeaderTitle.textContent = "Event Not Found";
      container.innerHTML = `
                <div class="event-info" style="text-align: center; padding: 50px;">
                    <i class="ri-error-warning-line" style="font-size: 4rem; color: #4361ee; margin-bottom: 20px;"></i>
                    <h2 class="event-title">Oops! Event Not Found</h2>
                    <p class="event-description">The event you are looking for does not exist or has been removed.</p>
                    <div class="event-actions">
                        <a href="index.html" class="register-btn">Back to Home</a>
                    </div>
                </div>
            `;
    }
  }

  // Initialize
  loadEventDetails();
});
