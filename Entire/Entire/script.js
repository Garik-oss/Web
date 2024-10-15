const apiKey = '2wHAShsvDx1Uzb/GpMAE/A==aqO2VqP0vTuDaKiT';

document.getElementById('createCard').addEventListener('click', () => {
    const apiName = document.getElementById('apiName').value;
    const apiEndpoint = document.getElementById('apiEndpoint').value;

    if (!apiName || !apiEndpoint) {
        alert('Please fill in both fields.');
        return;
    }

    // Create a new card to display API info
    const card = document.createElement('div');
    card.className = 'card-display card col-sm-12 col-md-4';
    
    const nameElement = document.createElement('h2');
    nameElement.textContent = apiName;

    const linkElement = document.createElement('p');
    linkElement.textContent = apiEndpoint;

    const fetchButton = document.createElement('button');
    fetchButton.textContent = 'Fetch Data';
    
    fetchButton.addEventListener('click', () => {
	// Show loading message
        const loadingMessage = document.createElement('p');
        loadingMessage.className = 'loading';
        loadingMessage.textContent = 'Loading...';
        card.appendChild(loadingMessage);
        fetch(apiEndpoint, {
            method: 'GET',
            headers: {
                'X-Api-Key': apiKey,
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            // Clear previous output
            const existingOutput = card.querySelector('.data-output');
            if (existingOutput) {
                existingOutput.remove();
            }
			loadingMessage.remove(); // Remove loading message
            const output = document.createElement('div');
            output.className = 'data-output';

            formatData(data, output);
            card.appendChild(output);
        })
        .catch(error => {
            const errorMessage = document.createElement('p');
            errorMessage.textContent = 'Error: ' + error.message;
            card.appendChild(errorMessage);
        });
    });

    // Append elements to the card
    card.appendChild(nameElement);
    card.appendChild(linkElement);
    card.appendChild(fetchButton);
    
    // Add the card to the cards container
    document.getElementById('cardsContainer').appendChild(card);

    // Clear input fields
    document.getElementById('apiName').value = '';
    document.getElementById('apiEndpoint').value = '';
});

function formatData(data, output) {
    for (const key in data) {
        if (Array.isArray(data[key])) {
            data[key].forEach(item => {
                if (typeof item === 'object') {
                    for (const subKey in item) {
                        const field = document.createElement('p');
                        field.textContent = `${subKey.replace(/_/g, ' ')}: ${item[subKey]}`;
                        output.appendChild(field);
                    }
                } else {
                    const field = document.createElement('p');
                    field.textContent = `${key.replace(/_/g, ' ')}: ${item}`;
                    output.appendChild(field);
                }
            });
        } else if (typeof data[key] === 'object') {
            for (const subKey in data[key]) {
                const field = document.createElement('p');
                field.textContent = `${subKey.replace(/_/g, ' ')}: ${data[key][subKey]}`;
                output.appendChild(field);
            }
        } else {
            const field = document.createElement('p');
            field.textContent = `${key.replace(/_/g, ' ')}: ${data[key]}`;
            output.appendChild(field);
        }
    }
}