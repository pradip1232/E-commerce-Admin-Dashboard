$(document).ready(function () {
    // Sidebar toggle
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // Handle responsive sidebar
    $(window).resize(function () {
        if ($(window).width() <= 768) {
            $('#sidebar').addClass('active');
        } else {
            $('#sidebar').removeClass('active');
        }
    });

    // Initialize DataTables if present
    if ($.fn.DataTable) {
        $('.datatable').DataTable({
            responsive: true
        });
    }

    // Handle notification dropdown
    $('#notificationDropdown').on('click', function(e) {
        e.preventDefault();
        $(this).next('.dropdown-menu').toggleClass('show');
    });

    // Close dropdowns when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.dropdown').length) {
            $('.dropdown-menu').removeClass('show');
        }
    });
}); 