<!--Bootstrap CDN-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>

<script src="../../Public/Assets/Js/AdminPage.js"></script>

<!--Search functions disable-->
<script>
    // Prevent form submission if search field is empty
    const searchForm = document.getElementById('searchForm');
    const searchInput = document.getElementById('searchInput');

    searchForm.addEventListener('submit', function(event) {
        if (searchInput.value.trim() === "") {
            event.preventDefault();
        }
    });
</script>

<!--Show password-->
<script>
    // Reset the filter and reload the page without any query parameters
    function resetFilter() {
        window.location.href = window.location.pathname;
    }

    function togglePasswordVisibility(passwordFieldId, toggleIconId) {
        var passwordField = document.getElementById(passwordFieldId);
        var toggleIcon = document.getElementById(toggleIconId);
        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        }
    }
</script>
<!--Search functions disable list of applicants-->
<script>
    // JavaScript function to validate search input
    function validateSearch() {
        const searchInput = document.getElementById('searchInput').value.trim();
        if (searchInput === '') {
            alert('Please enter a search term before submitting.');
            return false; // Prevent form submission if search field is empty
        }
        return true; // Allow form submission if search field has content
    }
</script>