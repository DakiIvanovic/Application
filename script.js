function showNextCard() {
    var currentCard = document.querySelector('.card.active');
    var nextCard = currentCard.nextElementSibling;
  
    currentCard.classList.remove('active');
    nextCard.classList.add('active');
  }
  
  function showPreviousCard() {
    var currentCard = document.querySelector('.card.active');
    var previousCard = currentCard.previousElementSibling;
  
    currentCard.classList.remove('active');
    previousCard.classList.add('active');
  }
  
  var currentCardIndex = 0;
  var cards = document.querySelectorAll('.card');
  var currentVideoIndex = 0;
  var videos = ["video/php_video.mp4", "video/laravel_video.mp4"];
  
  function showNextCard() {
    hideCurrentCard();
    currentCardIndex++;
    if (currentCardIndex >= cards.length) {
      currentCardIndex = 0;
    }
    showCurrentCard();
  }
  
  function showPreviousCard() {
    hideCurrentCard();
    currentCardIndex--;
    if (currentCardIndex < 0) {
      currentCardIndex = cards.length - 1;
    }
    showCurrentCard();
  }
  
  function hideCurrentCard() {
    cards[currentCardIndex].classList.remove('active');
  }
  
  function showCurrentCard() {
    cards[currentCardIndex].classList.add('active');
    updateVideoButtons();
  }
  
  function showNextVideo() {
    currentVideoIndex++;
    if (currentVideoIndex >= videos.length) {
      currentVideoIndex = 0;
    }
    updateVideoButtons();
  }
  
  function showPreviousVideo() {
    currentVideoIndex--;
    if (currentVideoIndex < 0) {
      currentVideoIndex = videos.length - 1;
    }
    updateVideoButtons();
  }
  
  function updateVideoButtons() {
    var nextBtn = document.getElementById('nextVideoBtn');
    var prevBtn = document.getElementById('prevVideoBtn');
    var videoFrame = document.getElementById('video-frame');
  
    videoFrame.src = videos[currentVideoIndex];
  
    if (currentVideoIndex === 0) {
      nextBtn.style.display = 'inline-block';
      prevBtn.style.display = 'none';
    } else if (currentVideoIndex === videos.length - 1) {
      nextBtn.style.display = 'none';
      prevBtn.style.display = 'inline-block';
    } else {
      nextBtn.style.display = 'inline-block';
      prevBtn.style.display = 'inline-block';
    }
  }
  
  // Inicijalno prikaži prvu karticu i prvi video
  showCurrentCard();

  document.addEventListener('DOMContentLoaded', function () {
    const chatCircle = document.getElementById('chat-circle');
    const chatBox = document.querySelector('.chat-box');
    const chatBoxToggle = document.querySelector('.chat-box-toggle');
    const userMessageInput = document.getElementById('user-message');
    const sendMessageButton = document.getElementById('send-message');
    const chatBoxBody = document.querySelector('.chat-box-body');

    chatCircle.addEventListener('click', function () {
        chatBox.style.display = 'block';
    });

    chatBoxToggle.addEventListener('click', function () {
        chatBox.style.display = 'none';
    });

    sendMessageButton.addEventListener('click', function () {
        const userMessage = userMessageInput.value;

        // Dodajte korisnikovu poruku u prozor
        appendMessage('user', userMessage);

        // Ovde možete implementirati slanje poruke na server i čekati odgovor
        // Na primer, putem AJAX poziva ka PHP skripti

        // Simulacija odgovora od strane admina nakon nekog vremena
        setTimeout(function () {
            const adminResponse = "Hvala na poruci! Odmah ćemo vam odgovoriti.";
            appendMessage('admin', adminResponse);
        }, 1000);

        // Skloni poruke dobrodošlice nakon prvog klika
        const welcomeMessages = document.querySelectorAll('.chat-box-message');
        welcomeMessages.forEach(message => {
            message.style.display = 'none';
        });

        // Očisti input polje nakon slanja poruke
        userMessageInput.value = '';
    });

    function appendMessage(sender, message) {
        const messageElement = document.createElement('div');
        messageElement.classList.add('chat-box-message', sender === 'admin' ? 'admin-message' : 'user-message');
        messageElement.innerHTML = `<span>${message}</span>`;
        chatBoxBody.appendChild(messageElement);

        // Skrolovanje na dno div-a kako bi prikazao najnovije poruke
        chatBoxBody.scrollTop = chatBoxBody.scrollHeight;
    }
});

