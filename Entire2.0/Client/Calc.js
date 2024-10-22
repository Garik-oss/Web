function createCalculatorCard() {
    const container = document.getElementById('cardsContainer');
    
    const card = document.createElement('div');
    card.className = 'card';

    // Create input fields and buttons
    const input1 = document.createElement('input');
    input1.type = 'number';
    input1.placeholder = 'Number 1';

    const input2 = document.createElement('input');
    input2.type = 'number';
    input2.placeholder = 'Number 2';

    const resultDisplay = document.createElement('div');
    resultDisplay.className = 'result';

    const operations = ['+', '-', '*', '/'];
    operations.forEach(op => {
        const button = document.createElement('button');
        button.innerText = op;
        button.onclick = function () {
            const num1 = parseFloat(input1.value);
            const num2 = parseFloat(input2.value);
            let result;

            switch (op) {
                case '+':
                    result = num1 + num2;
                    break;
                case '-':
                    result = num1 - num2;
                    break;
                case '*':
                    result = num1 * num2;
                    break;
                case '/':
                    result = num2 !== 0 ? num1 / num2 : 'Error (div by 0)';
                    break;
            }

            resultDisplay.innerText = `Result: ${result}`;
        };
        card.appendChild(button);
    });

    // Append elements to the card
    card.appendChild(input1);
    card.appendChild(input2);
    card.appendChild(resultDisplay);

    container.appendChild(card);
}

// Call the function to create the card
createCalculatorCard(); 