{{-- Collapse / expand arrow shared by the student and admin sidebars. --}}

<button type="button" class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
    <i class="bi bi-chevron-left"></i>
</button>

<script>
    document.getElementById('sidebarToggle').addEventListener('click', function () {
        const collapsed = document.documentElement.classList.toggle('sidebar-collapsed');

        try {
            localStorage.setItem('sidebarCollapsed', collapsed ? '1' : '0');
        } catch (e) {}
    });
</script>
