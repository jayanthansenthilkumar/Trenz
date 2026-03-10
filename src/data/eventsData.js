const eventsData = {
  appdev: {
    title: "App Dev Pro Challenge",
    headerTitle: "App Dev Pro Challenge 2026",
    image: "/images/appdev.avif",
    meta: [
      { icon: "ri-calendar-line", text: "April 30, 2026" },
      { icon: "ri-time-line", text: "09:00 AM - 4:00 PM" },
      { icon: "ri-user-line", text: "Individual/Team (max 2 members)" },
    ],
    rulesHTML: `
      <h3>Rules &amp; Guidelines</h3>
      <ul class="rules-list">
        <li><strong>Name of the Event:</strong> APP A THON</li>
        <li><strong>Event Overview:</strong> Participants will build a functional web application integrated with a database within the given time limit.</li>
        <li><strong>Participation Format:</strong>
          <div class="sub-points"><ul>
            <li>Team participation only — Maximum 2 members per team.</li>
            <li>Each team can submit only one project.</li>
          </ul></div>
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
        <li><strong>Judging Criteria:</strong>
          <div class="judging-criteria"><ul class="criteria-list">
            <li class="criteria-item">Functionality and Working Model - 40%</li>
            <li class="criteria-item">Database Design and Usage - 35%</li>
            <li class="criteria-item">Innovation and Creativity - 15%</li>
            <li class="criteria-item">Code Quality and Structure - 10%</li>
          </ul></div>
        </li>
      </ul>`,
  },
  webdesign: {
    title: "Web Weave",
    headerTitle: "Web Weave 2026",
    image: "/images/webdesign.jpg",
    meta: [
      { icon: "ri-calendar-line", text: "April 30, 2026" },
      { icon: "ri-time-line", text: "09:00 AM - 4:00 PM" },
      { icon: "ri-user-line", text: "Individual/Team (max 2 members)" },
    ],
    rulesHTML: `
      <h3>Rules &amp; Guidelines</h3>
      <ul class="rules-list">
        <li><strong>Name of the Event:</strong> Web Weave</li>
        <li><strong>Event Overview:</strong> Showcase your web development skills by creating responsive and innovative website designs.</li>
        <li><strong>Participation:</strong> Team participation — Maximum 2 members per team.</li>
        <li><strong>Duration:</strong> 3 hours for development + demonstration.</li>
        <li><strong>Judging Criteria:</strong>
          <div class="judging-criteria"><ul class="criteria-list">
            <li class="criteria-item">Design and Creativity - 35%</li>
            <li class="criteria-item">Responsiveness - 25%</li>
            <li class="criteria-item">Functionality - 25%</li>
            <li class="criteria-item">Code Quality - 15%</li>
          </ul></div>
        </li>
      </ul>`,
  },
  startup: {
    title: "NextGen Start",
    headerTitle: "NextGen Start 2026",
    image: "/images/startup.jpg",
    meta: [
      { icon: "ri-calendar-line", text: "April 30, 2026" },
      { icon: "ri-time-line", text: "09:00 AM - 4:00 PM" },
      { icon: "ri-user-line", text: "Individual/Team (max 3 members)" },
    ],
    rulesHTML: `
      <h3>Rules &amp; Guidelines</h3>
      <ul class="rules-list">
        <li><strong>Name of the Event:</strong> NextGen Start</li>
        <li><strong>Event Overview:</strong> Present your innovative startup ideas and business models to a panel of industry experts.</li>
        <li><strong>Participation:</strong> Team participation — Maximum 3 members per team.</li>
        <li><strong>Presentation:</strong> 10 minutes per team + 5 minutes Q&A.</li>
        <li><strong>Judging Criteria:</strong>
          <div class="judging-criteria"><ul class="criteria-list">
            <li class="criteria-item">Innovation - 30%</li>
            <li class="criteria-item">Business Model Viability - 30%</li>
            <li class="criteria-item">Presentation Skills - 20%</li>
            <li class="criteria-item">Market Research - 20%</li>
          </ul></div>
        </li>
      </ul>`,
  },
  debugging: {
    title: "Error : 404 NOT FOUND",
    headerTitle: "Error : 404 NOT FOUND 2026",
    image: "/images/coding.png",
    meta: [
      { icon: "ri-calendar-line", text: "April 30, 2026" },
      { icon: "ri-time-line", text: "09:00 AM - 12:00 PM" },
      { icon: "ri-user-line", text: "Individual" },
    ],
    rulesHTML: `
      <h3>Rules &amp; Guidelines</h3>
      <ul class="rules-list">
        <li><strong>Name of the Event:</strong> Error : 404 NOT FOUND</li>
        <li><strong>Event Overview:</strong> Test your debugging skills by finding and fixing errors in complex code snippets under time pressure.</li>
        <li><strong>Participation:</strong> Individual participation only.</li>
        <li><strong>Duration:</strong> 3 hours.</li>
        <li><strong>Judging Criteria:</strong>
          <div class="judging-criteria"><ul class="criteria-list">
            <li class="criteria-item">Accuracy of Fixes - 40%</li>
            <li class="criteria-item">Speed - 30%</li>
            <li class="criteria-item">Code Quality - 30%</li>
          </ul></div>
        </li>
      </ul>`,
  },
  coderewind: {
    title: "Code Rewind",
    headerTitle: "Code Rewind 2026",
    image: "/images/reverse.webp",
    meta: [
      { icon: "ri-calendar-line", text: "April 30, 2026" },
      { icon: "ri-time-line", text: "09:00 AM - 12:00 PM" },
      { icon: "ri-user-line", text: "Individual" },
    ],
    rulesHTML: `
      <h3>Rules &amp; Guidelines</h3>
      <ul class="rules-list">
        <li><strong>Name of the Event:</strong> Code Rewind</li>
        <li><strong>Event Overview:</strong> Compete in challenging algorithmic problems and real-world reverse-coding scenarios.</li>
        <li><strong>Participation:</strong> Individual participation only.</li>
        <li><strong>Duration:</strong> 3 hours.</li>
        <li><strong>Judging Criteria:</strong>
          <div class="judging-criteria"><ul class="criteria-list">
            <li class="criteria-item">Logic and Approach - 40%</li>
            <li class="criteria-item">Correctness - 35%</li>
            <li class="criteria-item">Code Efficiency - 25%</li>
          </ul></div>
        </li>
      </ul>`,
  },
  codequest: {
    title: "Code Quest",
    headerTitle: "Code Quest 2026",
    image: "/images/codehunt.png",
    meta: [
      { icon: "ri-calendar-line", text: "April 30, 2026" },
      { icon: "ri-time-line", text: "09:00 AM - 4:00 PM" },
      { icon: "ri-user-line", text: "Individual/Team (max 2 members)" },
    ],
    rulesHTML: `
      <h3>Rules &amp; Guidelines</h3>
      <ul class="rules-list">
        <li><strong>Name of the Event:</strong> Code Quest</li>
        <li><strong>Event Overview:</strong> A multi-round coding treasure hunt that tests problem-solving and technical skills.</li>
        <li><strong>Participation:</strong> Team participation — Maximum 2 members per team.</li>
        <li><strong>Duration:</strong> Multiple rounds throughout the day.</li>
        <li><strong>Judging Criteria:</strong>
          <div class="judging-criteria"><ul class="criteria-list">
            <li class="criteria-item">Problem Solving - 40%</li>
            <li class="criteria-item">Speed - 30%</li>
            <li class="criteria-item">Teamwork - 30%</li>
          </ul></div>
        </li>
      </ul>`,
  },
  resumebuilding: {
    title: "Build a Resume",
    headerTitle: "Build a Resume 2026",
    image: "/images/resume.png",
    meta: [
      { icon: "ri-calendar-line", text: "April 30, 2026" },
      { icon: "ri-time-line", text: "09:00 AM - 12:00 PM" },
      { icon: "ri-user-line", text: "Individual" },
    ],
    rulesHTML: `
      <h3>Rules &amp; Guidelines</h3>
      <ul class="rules-list">
        <li><strong>Name of the Event:</strong> Build a Resume</li>
        <li><strong>Event Overview:</strong> Create a professional resume that showcases your skills and experience effectively.</li>
        <li><strong>Participation:</strong> Individual participation only.</li>
        <li><strong>Duration:</strong> 2 hours.</li>
        <li><strong>Judging Criteria:</strong>
          <div class="judging-criteria"><ul class="criteria-list">
            <li class="criteria-item">Content Quality - 35%</li>
            <li class="criteria-item">Design and Layout - 30%</li>
            <li class="criteria-item">Professionalism - 20%</li>
            <li class="criteria-item">Creativity - 15%</li>
          </ul></div>
        </li>
      </ul>`,
  },
};

export default eventsData;
