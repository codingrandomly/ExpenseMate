    </div>

<!-- Footer -->
<footer class="text-center text-white mt-5 mb-4">
    <p class="small opacity-75">
        ExpenseMate &copy; 2024 - Educational Expense Tracker
    </p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Dark mode toggle with Cookies (UNIT-II)
    function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');
        const isDark = document.body.classList.contains('dark-mode');
        document.cookie = "darkMode=" + isDark + "; path=/; max-age=" + (60*60*24*365);
    }

    // Load dark mode preference from cookie
    window.addEventListener('load', function() {
        if (document.cookie.includes('darkMode=true')) {
            document.body.classList.add('dark-mode');
        }
    });
</script>

</body>
</html>
