let selected = false; // Track if user has already chosen

// URLs for each card
var socket = io();
let urls = {
  M: 'https://www.quiz.com/',    // URL for card M
  K: 'https://www.quiz.com/',    // URL for card K
  C: 'https://www.quiz.com/',    // URL for card C
  E: 'https://www.quiz.com/'     // URL for card E
};

socket.on('linkUpdates', function(data) {
  alert("Hiii")
  urls.M = 'https://www.quiz.com/' + data.m;
  urls.K = 'https://www.quiz.com/' + data.k;
  urls.C = 'https://www.quiz.com/' + data.c;
  urls.E = 'https://www.quiz.com/' + data.e;

  console.log(urls, "Updated URLs");
});

console.log(urls, "URLSSSS")
function showPopup(message, card) {
  const popup = document.getElementById('popup');
  const popupMsg = document.getElementById('popup-message');
  popupMsg.textContent = message;

  popup.style.display = 'flex';

  const chooseBtn = document.getElementById('choose-btn');
  chooseBtn.onclick = () => {
    if (selected) return; // Prevent selecting again

    selected = true;

    // Get the letter of the card (M, K, C, E)
    const cardLetter = card.querySelector('img').alt; // Assuming alt is the letter for the card (M, K, etc.)

    // Open the URL immediatelys
  

    // Bring the card to the front and trigger the explosion effect after opening the URL
    card.classList.add('nuke');
    popup.style.display = 'none';
    // Disable other cards after the animation completes
    setTimeout(() => {
      // Disable all other cards
      document.querySelectorAll('.card').forEach(c => {
        if (c !== card) c.classList.add('disabled');
      });

      // Hide the popup
      
      const url = urls[cardLetter];
   
      if (url) {
        window.open(url, '_blank'); // Open the link in a new tab
      }
    }, 1500); // Duration of the explosion animation
  };
}

function closePopup() {
  document.getElementById('popup').style.display = 'none';
}

const cards = document.querySelectorAll('.card');

cards.forEach(card => {
  card.addEventListener('click', () => {
    if (selected) return; // Block clicks if already chosen

    card.classList.add('rotate');

    setTimeout(() => {
      card.classList.remove('rotate');
      var message = card.querySelector('img').alt; // Assuming alt contains the message or letter (M, K, C, E)
     
      if(message=='M')
      message ='Get a hint of a easy level questions. ';
      if(message=='K')
      message ='Get a hint of medium level questions';
      if(message=='C')
      message ='Get a hint of hard level questions';
      if(message=='E')
      message ='Get a hint of hard level questions';
      showPopup(message, card);
    }, 600);
  });
});

