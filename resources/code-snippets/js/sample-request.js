const params = new URLSearchParams({
    quantity: 10,
    locale: 'en_US',
    seed: 123
});

fetch(`https://lorumapi.ddev.site/api/faker/addresses?${params}`)
    .then(response => response.json())
    .then(data => console.log(data))
    .catch(error => console.error('Error:', error));
