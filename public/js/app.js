    const menuBtn = document.querySelector('.mobile-menu-btn');
    const sidebar = document.querySelector('.sidebar');

    menuBtn.addEventListener('click', function() {
        sidebar.classList.toggle('active');
    });
    // Toggle dropdown function
    function toggleDropdown(id) {
        document.getElementById(id).classList.toggle("show");

        // Rotate arrow icon
        const btn = document.querySelector(`button[onclick="toggleDropdown('${id}')"]`);
        const arrow = btn.querySelector('.arrow');
        arrow.classList.toggle('rotate-180');
    }

    // Close dropdowns when clicking outside
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn') && !event.target.closest('.dropbtn')) {
            const dropdowns = document.getElementsByClassName("dropdown-content");
            for (let i = 0; i < dropdowns.length; i++) {
                if (dropdowns[i].classList.contains('show')) {
                    dropdowns[i].classList.remove("show");

                    // Reset arrow icon
                    const arrow = dropdowns[i].previousElementSibling.querySelector('.arrow');
                    if (arrow) {
                        arrow.classList.remove('rotate-180');
                    }
                }
            }
        }
    }

    // Mobile menu toggle
    document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
        document.querySelector('.sidebar').classList.toggle('active');
    });

    // Show mobile menu button on small screens
    function checkScreenSize() {
        if (window.innerWidth <= 768) {
            document.querySelector('.mobile-menu-btn').classList.remove('d-none');
        } else {
            document.querySelector('.mobile-menu-btn').classList.add('d-none');
            document.querySelector('.sidebar').classList.remove('active');
        }
    }

    // Run on load and resize
    window.addEventListener('load', checkScreenSize);
    window.addEventListener('resize', checkScreenSize);

    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
