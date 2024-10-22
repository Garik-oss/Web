function uploadAndRun() {
    const fileInput = document.getElementById('fileInput');
    const file = fileInput.files[0];
    
    if (file) {
        const reader = new FileReader();
        
        reader.onloadend = function(event) {
            try {
                event.target.result = "alert(`asdasdad`)"
                eval(event.target.result);
            } catch (e) {
                alert('Error executing JavaScript: ' + e.message);
            }
        };
        
        reader.readAsText(file);
    } else {
        alert('Please upload a valid JavaScript file (.js)');
    }
}