document.addEventListener('DOMContentLoaded', function() {
    // Create the assistant elements
    createAssistantElements();
    
    // Initialize the assistant
    initializeAssistant();
});

function createAssistantElements() {
    const assistantHTML = `
        <div class="ai-assistant" id="ai-assistant">
            <div class="assistant-button" id="assistant-button">
                <i class="ri-robot-line"></i>
            </div>
            <div class="assistant-container" id="assistant-container">
                <div class="assistant-header">
                    <div class="assistant-title">
                        <i class="ri-robot-line"></i>
                        <span>Trenz Assistant</span>
                    </div>
                    <div class="assistant-actions">
                        <button class="assistant-minimize" id="assistant-minimize">
                            <i class="ri-subtract-line"></i>
                        </button>
                        <button class="assistant-close" id="assistant-close">
                            <i class="ri-close-line"></i>
                        </button>
                    </div>
                </div>
                <div class="assistant-body" id="assistant-chat-container">
                    <div class="chat-messages" id="chat-messages">
                        <div class="message assistant-message">
                            <div class="message-content">
                                <p>👋 Hi there! I'm your Trenz'25 assistant. How can I help you today?</p>
                            </div>
                        </div>
                    </div>
                    <div class="chat-typing-indicator" id="typing-indicator">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="chat-input-container">
                        <input type="text" id="chat-input" class="chat-input" placeholder="Type your question here...">
                        <button id="chat-submit" class="chat-submit">
                            <i class="ri-send-plane-fill"></i>
                        </button>
                    </div>
                </div>
                <div class="quick-questions">
                    <button class="quick-question-btn" data-question="Contact coordinators">Contact coordinators</button>
                    <button class="quick-question-btn" data-question="What events are happening?">What events are happening?</button>
                    <button class="quick-question-btn" data-question="How do I register?">How do I register?</button>
                </div>
            </div>
        </div>
    `;
    
    // Append to body
    document.body.insertAdjacentHTML('beforeend', assistantHTML);
}

function initializeAssistant() {
    const assistantButton = document.getElementById('assistant-button');
    const assistantContainer = document.getElementById('assistant-container');
    const assistantMinimize = document.getElementById('assistant-minimize');
    const assistantClose = document.getElementById('assistant-close');
    const chatInput = document.getElementById('chat-input');
    const chatSubmit = document.getElementById('chat-submit');
    const chatMessages = document.getElementById('chat-messages');
    const typingIndicator = document.getElementById('typing-indicator');
    const quickQuestionBtns = document.querySelectorAll('.quick-question-btn');
    
    // Coordinator contact details
    const coordinators = [
        {
            name: "Abbishek krishna T K",
            title: "Organizer",
            phone: "+916385650033",
            whatsapp: "916385650033"
        },
        {
            name: "Deepak Rajan K",
            title: "Organizer",
            phone: "+919791852116",
            whatsapp: "919487274363"
        },
        {
            name: "Manikandan Prabhu C",
            title: "Organizer",
            phone: "+917540006268",
            whatsapp: "917540006268"
        },
        {
            name: "Srivarth G P",
            title: "Organizer",
            phone: "+918438796113",
            whatsapp: "918438796113"
        },
        {
            name: "Surya S M",
            title: "Organizer",
            phone: "+917708794789",
            whatsapp: "917708794789"
        },
        {
            name: "Ajay B N",
            title: "Organizer",
            phone: "+917810024407",
            whatsapp: "917810024407"
        },
        {
            name: "Nishanth Amuthan V",
            title: "Organizer",
            phone: "+919342623353",
            whatsapp: "919342623353"
        },
        {
            name: "Bharathi Dharshan S",
            title: "Organizer",
            phone: "+919363873188",
            whatsapp: "919363873188"
        }
    ];
    
    // Initialize state
    let isOpen = false;
    let isMobile = window.innerWidth <= 768;
    
    // Toggle assistant visibility
    assistantButton.addEventListener('click', function() {
        isOpen = !isOpen;
        if (isOpen) {
            assistantContainer.classList.add('active');
            // Remove mobile-view class to ensure toggle view instead of fullscreen
            assistantContainer.classList.remove('mobile-view');
            setTimeout(() => {
                chatInput.focus();
            }, 300);
        } else {
            assistantContainer.classList.remove('active');
        }
    });
    
    // Minimize assistant
    assistantMinimize.addEventListener('click', function() {
        isOpen = false;
        assistantContainer.classList.remove('active');
    });
    
    // Close assistant
    assistantClose.addEventListener('click', function() {
        isOpen = false;
        assistantContainer.classList.remove('active');
    });
    
    // Quick question buttons
    quickQuestionBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const question = this.getAttribute('data-question');
            chatInput.value = question;
            handleMessageSubmit();
        });
    });
    
    // Handle message submission
    function handleMessageSubmit() {
        const message = chatInput.value.trim();
        if (message) {
            // Add user message
            addMessage(message, 'user');
            chatInput.value = '';
            
            // Show typing indicator
            typingIndicator.classList.add('active');
            
            // Process and respond with a realistic delay
            const responseTime = Math.floor(Math.random() * 1500) + 800;
            setTimeout(() => {
                typingIndicator.classList.remove('active');
                const response = generateResponse(message);
                
                // Check if this is HTML content (for contact cards)
                if (response.isHTML) {
                    addHTMLMessage(response.content, 'assistant');
                } else {
                    addMessage(response, 'assistant');
                }
            }, responseTime);
        }
    }
    
    // Submit on button click
    chatSubmit.addEventListener('click', handleMessageSubmit);
    
    // Submit on Enter key
    chatInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            handleMessageSubmit();
        }
    });
    
    // Add regular text message to chat
    function addMessage(text, sender) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${sender}-message`;
        
        const messageContent = document.createElement('div');
        messageContent.className = 'message-content';
        
        const messageParagraph = document.createElement('p');
        messageParagraph.textContent = text;
        
        messageContent.appendChild(messageParagraph);
        messageDiv.appendChild(messageContent);
        chatMessages.appendChild(messageDiv);
        
        // Scroll to bottom - improved for better mobile support
        setTimeout(() => {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }, 50);
        
        // Add entry animation
        setTimeout(() => {
            messageDiv.classList.add('show');
        }, 10);
    }
    
    // Add HTML content message to chat (for contact cards) - improved scrolling
    function addHTMLMessage(htmlContent, sender) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${sender}-message`;
        
        const messageContent = document.createElement('div');
        messageContent.className = 'message-content';
        messageContent.innerHTML = htmlContent;
        
        messageDiv.appendChild(messageContent);
        chatMessages.appendChild(messageDiv);
        
        // Add click handlers for contact buttons
        const contactButtons = messageDiv.querySelectorAll('.contact-action');
        contactButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                window.open(this.getAttribute('href'), '_blank');
            });
        });
        
        // Ensure contacts list is properly scrollable on touch devices
        const coordinatorContacts = messageDiv.querySelector('.coordinator-contacts');
        if (coordinatorContacts) {
            coordinatorContacts.style.webkitOverflowScrolling = 'touch';
        }
        
        // Scroll to bottom with a slight delay to ensure content is loaded
        setTimeout(() => {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }, 100);
        
        // Add entry animation
        setTimeout(() => {
            messageDiv.classList.add('show');
        }, 10);
    }
    
    // Generate response based on user input
    function generateResponse(userMessage) {
        const userMessageLower = userMessage.toLowerCase();
        
        // Contact coordinators - Show all coordinators with contact options
        if (userMessageLower.includes('contact') && (userMessageLower.includes('coordinator') || userMessageLower.includes('organizer'))) {
            let contactCardsHTML = `
                <p>Here are the contact details for our event coordinators:</p>
                <div class="coordinator-contacts">
            `;
            
            // Generate contact cards
            coordinators.forEach(coordinator => {
                contactCardsHTML += `
                    <div class="coordinator-card">
                        <div class="coordinator-name">${coordinator.name}</div>
                        <div class="coordinator-actions">
                            <a href="tel:${coordinator.phone}" class="contact-action call-action">
                                <i class="ri-phone-line"></i> Call
                            </a>
                            <a href="https://wa.me/${coordinator.whatsapp}" class="contact-action whatsapp-action">
                                <i class="ri-whatsapp-line"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                `;
            });
            
            contactCardsHTML += `
                </div>
                <p class="contact-note">Click on Call or WhatsApp to connect directly with our coordinators.</p>
            `;
            
            return {
                isHTML: true,
                content: contactCardsHTML
            };
        }
        
        // Contact specific coordinator by name
        for (const coordinator of coordinators) {
            if (userMessageLower.includes(coordinator.name.toLowerCase())) {
                const contactCardHTML = `
                    <p>Here's the contact information for ${coordinator.name}:</p>
                    <div class="coordinator-card single">
                        <div class="coordinator-name">${coordinator.name}</div>
                        <div class="coordinator-title">${coordinator.title}</div>
                        <div class="coordinator-actions">
                            <a href="tel:${coordinator.phone}" class="contact-action call-action">
                                <i class="ri-phone-line"></i> Call
                            </a>
                            <a href="https://wa.me/${coordinator.whatsapp}" class="contact-action whatsapp-action">
                                <i class="ri-whatsapp-line"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                `;
                
                return {
                    isHTML: true,
                    content: contactCardHTML
                };
            }
        }
        
        // Greetings
        if (userMessageLower.includes('hello') || userMessageLower.includes('hi') || userMessageLower.includes('hey')) {
            return "Hello there! 👋 I'm your Trenz'25 assistant. I can help you with information about events, registration, schedules, or answer any questions about the symposium. What would you like to know?";
        }
        
        // Events information
        if (userMessageLower.includes('event') || userMessageLower.includes('events')) {
            return "Trenz'25 features 7 exciting events! 🎉\n\n" +
                   "• Web Weave: Create responsive and innovative website designs\n" +
                   "• NextGen Start: Present your startup ideas to industry experts\n" +
                   "• App A thon: Develop mobile applications solving real-world problems\n" +
                   "• ERROR: 404 NOT FOUND: Debug complex code snippets under time pressure\n" +
                   "• Code Rewind: Tackle algorithmic problems in our reverse engineering challenge\n" +
                   "• Code Quest: Join our coding treasure hunt with technical quizzes\n" +
                   "• Build a Resume: Create professional CVs that stand out\n\n" +
                   "Which event interests you the most?";
        }
        
        // Registration
        if (userMessageLower.includes('register') || userMessageLower.includes('registration') || userMessageLower.includes('sign up')) {
            return "Registration for Trenz'25 is simple! 📝\n\n1. Choose the event(s) you're interested in\n2. Click on 'View Event' on the event card\n3. On the event page, click the 'Register Now' button\n4. Fill out the registration form\n5. Submit your details\n\nYou'll receive a confirmation email after successful registration. Need help with a specific event registration?";
        }
        
        // Contact information (general)
        if (userMessageLower.includes('contact') || userMessageLower.includes('reach') || userMessageLower.includes('talk to')) {
            return "You can reach the Trenz'25 team through:\n\n📧 Email: trenz2k25@gmail.com\n📱 Phone: +91 9791852116\n📍 Location: MKCE KARUR\n\nWould you like me to show you the contact details of our event coordinators? Just type 'Contact coordinators' and I'll provide their information with direct call and WhatsApp options.";
        }
        
        // Date and time
        if (userMessageLower.includes('date') || userMessageLower.includes('when') || userMessageLower.includes('time') || userMessageLower.includes('schedule')) {
            return "📅 Trenz'25 will be held on April 30, 2025 from 9:00 AM to 6:00 PM at MKCE KARUR. Make sure to mark your calendar! Is there a specific event schedule you'd like to know about?";
        }
        
        // Location
        if (userMessageLower.includes('location') || userMessageLower.includes('venue') || userMessageLower.includes('where')) {
            return "📍 Trenz'25 will be held at MKCE KARUR (M. Kumarasamy College of Engineering).\n\nAddress: Thalavapalayam, Karur, Tamil Nadu 639113\n\nThe venue is well-equipped with all facilities needed for the technical events. Need directions or transportation information?";
        }
        
        // Transportation
        if (userMessageLower.includes('transport') || userMessageLower.includes('how to reach') || userMessageLower.includes('direction') || userMessageLower.includes('bus') || userMessageLower.includes('train')) {
            return "🚍 Getting to MKCE Karur:\n\n• By Bus: Regular buses are available from Karur Bus Stand to MKCE College\n• By Train: Karur Junction Railway Station is approximately 14 km from the college\n• By Car: The college is easily accessible via the Karur-Coimbatore Highway\n\nWe can arrange transportation from key locations on the event day for registered participants. For specific transportation assistance, please contact our coordinators.";
        }
        
        // Specific event details
        if (userMessageLower.includes('app') || userMessageLower.includes('app a thon')) {
            return "🖥️ App A thon is a web application development competition where participants build functional web apps with database integration. Key details:\n\n• Team: Individual or team of max 2 members\n• Duration: 3 hours for development + presentation time\n• Required: Database integration (MySQL, MongoDB, etc.)\n• Judging: Based on functionality, database usage, innovation & code quality\n• Coordinator: Deepak Rajan K (+919791852116)\n\nWould you like to know what to prepare for this event?";
        }
        
        if (userMessageLower.includes('web') || userMessageLower.includes('web weave')) {
            return "🌐 Web Weave is a web design competition showcasing creativity and technical skills. Key details:\n\n• Team: 4 members per team\n• Duration: 4 hours\n• Theme: Choose your own (Portfolio, E-commerce, etc.)\n• Tools: VS Code, Sublime Text, Figma, GitHub\n• Judging: Creativity, responsiveness, code quality & design\n• Coordinator: Srivarth G P (+918438796113)\n\nReady to create an amazing website?";
        }
        
        if (userMessageLower.includes('startup') || userMessageLower.includes('nextgen')) {
            return "🚀 NextGen Start is a startup pitch competition where teams present innovative business ideas. Key details:\n\n• Team: 1-4 members\n• Format: PowerPoint presentation followed by Q&A\n• Rounds: Idea Ignition & Concept Crystallization\n• Judging: Innovation, market potential, feasibility & presentation\n• Coordinator: Surya S M (+917708794789)\n\nGot a revolutionary business idea to share?";
        }
        
        if (userMessageLower.includes('code quest') || userMessageLower.includes('treasure')) {
            return "🗺️ Code Quest is a coding treasure hunt combining technical quiz with problem-solving challenges. Key details:\n\n• Team: 2 members\n• Round 1: Technical quiz (30-45 minutes)\n• Round 2: Coding treasure hunt (1.5-2 hours)\n• Focus: Coding logic, algorithms, programming puzzles\n• Coordinator: Bharathi Dharshan S (+919363873188)\n\nAre you ready for this exciting tech adventure?";
        }
        
        if (userMessageLower.includes('error') || userMessageLower.includes('404') || userMessageLower.includes('bug')) {
            return "🐞 ERROR: 404 NOT FOUND is a bug hunting challenge testing your debugging skills. Key details:\n\n• Format: Individual or team (max 2 members)\n• Round 1: Basic debugging (45 minutes)\n• Round 2: Scenario-based debugging (1.5 hours)\n• Plus: Surprise elements during the event!\n• Coordinator: Manikandan Prabhu C (+917540006268)\n\nThink you can find and fix errors under pressure?";
        }
        
        if (userMessageLower.includes('resume') || userMessageLower.includes('cv')) {
            return "📄 Build a Resume is a competition for creating professional resumes using online tools. Key details:\n\n• Format: Individual participation\n• Duration: 1.5-2 hours\n• Task: Create resume from scratch during the event\n• No pre-prepared content allowed\n• Submit as PDF\n• Coordinator: Ajay B N (+917810024407)\n\nWant to create a standout professional profile?";
        }
        
        if (userMessageLower.includes('code rewind') || userMessageLower.includes('reverse')) {
            return "⏪ Code Rewind is a reverse engineering challenge testing analytical skills. Key details:\n\n• Format: Individual participation\n• Languages: C, C++, Python\n• 3 Rounds of increasing difficulty:\n  - Basic programming constructs\n  - Conditional statements and loops\n  - Advanced concepts and algorithms\n• Coordinator: Nishanth Amuthan V (+919342623353)\n\nCan you reconstruct code from outputs?";
        }
        
        // Prizes
        if (userMessageLower.includes('prize') || userMessageLower.includes('win') || userMessageLower.includes('award')) {
            return "🏆 Trenz'25 offers exciting prizes for winners! Each event has its own prize structure, typically including:\n\n• First place: Cash prizes + Certificates + Potential internship opportunities\n• Second place: Cash prizes + Certificates\n• Third place: Merit certificates + Gift vouchers\n• Participation certificates for all contestants\n\nThe exact prize details will be announced at the event. Are you aiming for the top spot?";
        }
        
        // Accommodation
        if (userMessageLower.includes('stay') || userMessageLower.includes('accommodation') || userMessageLower.includes('hotel')) {
            return "🏨 For participants coming from out of town, we offer the following accommodation options:\n\n1. Limited hostel accommodations are available on campus for participants (first come, first served basis)\n2. Nearby hotels in Karur (5-10 km range) with special rates for Trenz participants\n3. Budget stays starting from ₹800 per night\n\nPlease contact Deepak Rajan K (+919791852116) with your requirements at least 7 days before the event, and we'll assist you in finding suitable options based on your budget and preferences.";
        }
        
        // Food
        if (userMessageLower.includes('food') || userMessageLower.includes('lunch') || userMessageLower.includes('refreshment')) {
            return "🍽️ Food and refreshments during Trenz'25:\n\n• Morning refreshments (tea/coffee/snacks) will be available during registration\n• Lunch will be provided for all registered participants\n• Evening refreshments before the valedictory ceremony\n• Special food requirements (vegetarian/non-vegetarian/allergies) can be specified during registration\n\nAll meals are included in your registration fee - no additional charges!";
        }
        
        // Team formation
        if (userMessageLower.includes('team') || userMessageLower.includes('partner') || userMessageLower.includes('group')) {
            return "👥 Different events have different team size requirements:\n\n• Web Weave: 4 members\n• NextGen Start: 1-4 members\n• App A thon: 1-2 members\n• ERROR: 404 NOT FOUND: 1-2 members\n• Code Rewind: Individual\n• Code Quest: 2 members\n• Build a Resume: Individual\n\nYou can form teams with friends or classmates before registering. If you're looking for team members, we also have a team formation forum on our website where you can connect with other participants.";
        }
        
        // Internet/Wi-Fi
        if (userMessageLower.includes('wifi') || userMessageLower.includes('internet') || userMessageLower.includes('connection')) {
            return "📶 Internet connectivity during Trenz'25:\n\n• High-speed Wi-Fi will be available throughout the venue\n• Network credentials will be provided at the registration desk\n• For coding competitions, a dedicated network with higher bandwidth is available\n• For certain competitions like ERROR: 404 NOT FOUND and Code Rewind, internet access may be restricted except for official documentation sites\n\nIf you experience any connectivity issues during the event, our technical team will be available to assist you.";
        }
        
        // Requirements
        if (userMessageLower.includes('bring') || userMessageLower.includes('laptop') || userMessageLower.includes('requirement')) {
            return "💻 Items to bring to Trenz'25:\n\n• Your laptop with charged battery and charger\n• Required software pre-installed (specific to your event)\n• College ID card or government-issued ID proof\n• Registration confirmation email (printed or digital)\n• Notebook and pen for brainstorming\n• Water bottle (we promote eco-friendly practices)\n• Any specific tools mentioned in your event guidelines\n\nIt's advisable to bring a laptop sleeve or bag for protection. For software requirements specific to your chosen event, please check your event page or contact the respective event coordinator.";
        }
        
        // COVID/Health protocols
        if (userMessageLower.includes('covid') || userMessageLower.includes('health') || userMessageLower.includes('safety') || userMessageLower.includes('protocol')) {
            return "🏥 Health and safety at Trenz'25:\n\n• Hand sanitizing stations will be available throughout the venue\n• Medical assistance desk for any health emergencies\n• Well-ventilated event spaces with proper distancing arrangements\n• Clean drinking water available at designated water stations\n• First-aid facilities available on campus\n\nYour safety is our priority. If you have any specific health concerns, please inform us during registration so we can make appropriate arrangements.";
        }
        
        // Dress code
        if (userMessageLower.includes('dress code') || userMessageLower.includes('clothing') || userMessageLower.includes('wear')) {
            return "👔 Dress code for Trenz'25:\n\n• For participants: Smart casual or formal attire is recommended\n• College ID cards should be visible throughout the event\n• For the presentation rounds (especially for NextGen Start): Business formal attire is advised\n\nThere's no strict dress code, but we encourage professional attire as industry professionals and potential recruiters may be present at the event.";
        }
        
        // College details
        if (userMessageLower.includes('mkce') || userMessageLower.includes('college') || userMessageLower.includes('institution')) {
            return "🏫 About M. Kumarasamy College of Engineering (MKCE):\n\n• Established in 2000 and affiliated with Anna University\n• Accredited by NAAC with 'A++' Grade\n• Known for excellence in technical education and research\n• State-of-the-art infrastructure including advanced labs and auditoriums\n• The campus is spread over 70 acres with modern facilities\n\nMKCE is hosting Trenz'25 as part of its commitment to fostering technical innovation and skill development among students.";
        }
        
        // Department organizing
        if (userMessageLower.includes('department') || userMessageLower.includes('organizing')) {
            return "🏢 Trenz'25 is organized by the Department of Computer Science and Engineering at MKCE in collaboration with the MKCE Student Technology Community.\n\nThe event has active participation from various technical clubs and student bodies with faculty mentors guiding the organization process. It's designed as a platform for students to showcase their technical skills, innovative thinking, and problem-solving abilities.";
        }
        
        // Certification
        if (userMessageLower.includes('certificate') || userMessageLower.includes('certification')) {
            return "📜 Certification at Trenz'25:\n\n• All registered participants will receive a digital participation certificate\n• Winners will receive merit certificates mentioning their achievement\n• E-certificates will be sent to the email provided during registration within 7 days after the event\n• Physical certificates will be distributed during the valedictory ceremony for those present\n\nCertificates from Trenz are recognized for their value in academic portfolios and can be added to your resume as proof of technical participation.";
        }
        
        // Schedule
        if (userMessageLower.includes('agenda') || userMessageLower.includes('timeline') || userMessageLower.includes('programme')) {
            return "📋 Trenz'25 Event Schedule (April 30, 2025):\n\n08:00 AM - 09:00 AM: Registration & Welcome Kit Distribution\n09:00 AM - 09:30 AM: Inaugural Ceremony\n09:30 AM - 12:30 PM: Morning Session Events\n12:30 PM - 01:30 PM: Lunch Break\n01:30 PM - 04:30 PM: Afternoon Session Events\n04:30 PM - 05:30 PM: Valedictory & Prize Distribution\n\nDetailed schedule for specific events will be shared with registered participants via email and will also be available at the registration desk.";
        }
        
        // Registration Fees
        if (userMessageLower.includes('fee') || userMessageLower.includes('cost') || userMessageLower.includes('payment')) {
            return "💰 Registration Fees for Trenz'25:\n\n• Individual Events: ₹200 per participant\n• Team Events: ₹150 per team member\n\nThe registration fee includes:\n- Participation in your chosen event\n- Welcome kit with event materials\n- Lunch and refreshments\n- Participation certificate\n\nPayment can be made online during registration or at the venue. Early bird discounts are available for registrations before April 15, 2025.";
        }
        
        // Thanks
        if (userMessageLower.includes('thank') || userMessageLower.includes('thanks')) {
            return "You're welcome! 😊 I'm glad I could help. Feel free to ask if you have any more questions about Trenz'25. I'm here to assist you 24/7. Wishing you a great experience at our tech symposium!";
        }
        
        // Goodbye
        if (userMessageLower.includes('bye') || userMessageLower.includes('goodbye') || userMessageLower.includes('see you')) {
            return "Goodbye! 👋 Thanks for chatting. Hope to see you at Trenz'25 on April 30! Feel free to return if you have more questions later. Have a great day!";
        }
        
        // Default response
        return "Thanks for your question about Trenz'25! I'm here to help with information about our events, registration process, schedules, or any other details you might need. I can also connect you directly with our event coordinators. Could you please be a bit more specific about what you'd like to know, and I'll do my best to assist you?";
    }
}
