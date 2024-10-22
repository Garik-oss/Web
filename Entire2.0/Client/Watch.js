function createWatchCard() {
    const container = document.getElementById('cardsContainer');
    // Create card element
    const card = document.createElement('div');
    card.className = 'card';

    // Create elements for time and date
    const timeDisplay = document.createElement('div');
    timeDisplay.className = 'time';

    const dateDisplay = document.createElement('div');
    dateDisplay.className = 'date';

    // Function to update the time and date
    function updateTime() {
        const now = new Date();
        timeDisplay.innerText = now.toLocaleTimeString();
        dateDisplay.innerText = now.toLocaleDateString();
    }

    // Initial time update
    updateTime();

    // Update time every second
    setInterval(updateTime, 1000);

    // Append elements to the card
    card.appendChild(timeDisplay);
    card.appendChild(dateDisplay);

    container.appendChild(card);
}

// Call the function to create the watch card
createWatchCard();