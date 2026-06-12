    </div> <!-- Close content-body -->
</div> <!-- Close main-container -->

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const mainContainer = document.getElementById('mainContainer');

        if (menuToggle && sidebar && mainContainer) {
            menuToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                sidebar.classList.toggle('open');
                mainContainer.classList.toggle('sidebar-open');
            });

            document.addEventListener('click', (e) => {
                if (!sidebar.contains(e.target) && !menuToggle.contains(e.target) && sidebar.classList.contains('open')) {
                    sidebar.classList.remove('open');
                    mainContainer.classList.remove('sidebar-open');
                }
            });
        }
    });
</script>
