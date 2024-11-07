document.getElementById('contact-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission
    alert('Thank you for contacting us, ' + document.getElementById('name').value + '!');
    this.reset(); // Reset the form fields
});