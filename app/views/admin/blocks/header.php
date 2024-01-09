<div class="bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
        <i class="fas fa-user-secret me-2"></i>CLOTHING
    </div>
    <div class="list-group list-group-flush my-3">
        <a href="/project_2/admin/dashboard" class="list-group-item list-group-item-action bg-transparent second-text fw-bold dashboard-click">
            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
        </a>
        <a href="/project_2/admin/analytics" class="list-group-item list-group-item-action bg-transparent second-text fw-bold analytics-click">
            <i class="fas fa-chart-line me-2"></i>Analytics
        </a>
        <a href="/project_2/admin/products" class="list-group-item list-group-item-action bg-transparent second-text fw-bold products-click">
            <i class="fas fa-gift me-2"></i>Products
        </a>
        <a href="/project_2/admin/coupons" class="list-group-item list-group-item-action bg-transparent second-text fw-bold products-click">
            <i class="bx bxs-discount me-2"></i>Coupon
        </a>
        <a href="/project_2/admin/orders" class="list-group-item list-group-item-action bg-transparent second-text fw-bold products-click">
        <i class='bx bxs-check-circle me-2'></i></i>Orders
        </a>
        <a href="/project_2/admin/map" class="list-group-item list-group-item-action bg-transparent second-text fw-bold map-click">
            <i class="fas fa-map-marker-alt me-2"></i>Map
        </a>
        <a href="/project_2/admin/logout" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold">
            <i class="fas fa-power-off me-2"></i>Logout
        </a>
    </div>

    <script>
        // Get the current URL
        var currentUrl = window.location.pathname;

        // Get all the elements with the class name 'list-group-item'
        var links = document.querySelectorAll('.list-group-item');

        // Function to handle the click event
        function handleClick(event) {
            // Remove the 'active' class from all links
            links.forEach(function(link) {
                link.classList.remove('active');
            });

            // Add the 'active' class to the clicked link
            event.target.classList.add('active');
        }

        // Add click event listeners to each link
        links.forEach(function(link) {
            // Compare the link's href with the current URL and set the 'active' class if they match
            if (link.getAttribute('href') === currentUrl) {
                link.classList.add('active');
            }

            link.addEventListener('click', handleClick);
        });
    </script>
</div>