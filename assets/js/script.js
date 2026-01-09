document.addEventListener('DOMContentLoaded', function () {
    // Tooltip initialization if using Bootstrap
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // Auto-hide alerts after 5 seconds
    const aletrts = document.querySelectorAll('.alert-dismissible');
    aletrts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
    // Admin Sidebar Toggle
    const sidebarToggle = document.getElementById('sidebarToggle');
    const adminSidebar = document.querySelector('.admin-sidebar');

    if (sidebarToggle && adminSidebar) {
        sidebarToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            adminSidebar.classList.toggle('show');
        });

        // Close sidebar when clicking outside
        document.addEventListener('click', function (e) {
            if (adminSidebar.classList.contains('show') &&
                !adminSidebar.contains(e.target) &&
                e.target !== sidebarToggle &&
                !sidebarToggle.contains(e.target)) {
                adminSidebar.classList.remove('show');
            }
        });
    }
});
