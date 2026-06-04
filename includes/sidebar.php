<div class="sidebar">
    <h2>StudySprint</h2>

    <a href="dashboard.php">Dashboard</a>
    <a href="calendar.php">Agenda</a>
    <a href="projects.php">Projecten</a>

    <button onclick="logoutPopup()">Uitloggen</button>
</div>

<script>
function logoutPopup() {
    if(confirm('Weet je zeker dat je wilt uitloggen?')) {
        window.location.href = 'includes/logout.php';
    }
}
</script>