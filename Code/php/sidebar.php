  <link rel="stylesheet" href="../styles/sidebar.css">
  <button class="hamburger-btn" onclick="toggleSidebar()">
    <i class="fas fa-bars"></i>
  </button>

  <!-- sidebar -->
  <div class="sidebar">
    <button class="exit-btn" onclick="toggleSidebar()">
      <i class="fa-solid fa-xmark"></i>
    </button>
    <div class="sections">
      <div class="profile">
        <img src="../assets/logo.svg" alt="Profile Picture">
      </div>
      <hr>
      <div class="section">
        <h3>Plan</h3>
        <div class="sidebar_links">
          <div><a href="./planTasks.php">Home</a></div>
          <div><a href="./planProgresse.php">Progress </a></div>
          <div><a href="./planProgresse.php">Personal Goals </a></div>
        </div>
      </div>
      <div class="section">
        <h3>Journals</h3>
        <div class="sidebar_links">
          <div><a href="./journals.php">Public journals</a></div>
          <div><a href="./myjournals.php">My journals</a></div>
          <div><a href="./savedJournals.php">My favorites</a></div>
        </div>
      </div>

      <div class="section">
        <h3>Assistance </h3>
        <div class="sidebar_links">
          <div><a href="./therapists.php">Therapist Finder</a></div>
          <div><a href="articals.php">Mindful Reads </a></div>
        </div>
      </div>
      <hr>
      <div class="disconnect-link">
        <div class="btn-group dropup">
          <button  class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> Settings </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li> <a href="./profile.php">Profile</a></li>
            <li><a href="./disconnect.php">Disconnect</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <script src="../js/sidebar.js"></script>