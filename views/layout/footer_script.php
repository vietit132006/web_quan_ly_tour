<script>
    /* USER DROPDOWN */
    document.getElementById('user-button').addEventListener('click', (e) => {
        e.stopPropagation();
        document.getElementById('user-menu').classList.toggle('show');
    });
    document.addEventListener('click', () => {
        document.getElementById('user-menu').classList.remove('show');
    });

    /* SIDEBAR ACTIVE */
    document.querySelectorAll('.sidebar-link').forEach(link => {
        link.addEventListener('click', (e) => {
            document.querySelectorAll('.sidebar-link').forEach(l => {
                l.classList.remove('active', 'text-cyan-600', 'bg-cyan-50');
                l.classList.add('text-gray-700');
            });

            link.classList.add('active', 'text-cyan-600', 'bg-cyan-50');
            link.classList.remove('text-gray-700');
        });
    });
</script>

</body>

</html>