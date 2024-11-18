function searchHospitals() {
    const city = document.getElementById('city').value;

    if (city === '') {
        alert('Please enter a city name');
        return;
    }

    // Making AJAX request to search.php
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'search.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        const results = document.getElementById('results');
        results.innerHTML = this.responseText;
    };
    xhr.send('city=' + city);
}
