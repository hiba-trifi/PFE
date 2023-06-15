  <link rel="stylesheet" href="./styles/admin-sidebar.css">
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
        <img src="./assets/logo-admin.svg" alt="logo Picture">
      </div>
      <hr>
      <div class="section">
        <h3>Manage users</h3>
        <div class="sidebar_links">
          <div><a href="./admin-members.php">Members</a></div>
          <div><a href="./admin-admins.php">Admins </a></div>
        </div>
      </div>
      <div class="section">
        <h3>Journals</h3>
        <div class="sidebar_links">
          <div><a href="./journals.php">Manage journals</a></div>
        </div>
      </div>

      <div class="section">
        <h3>Plan </h3>
        <div class="sidebar_links">
          <div><a href="./therapists.php"> Manage plans</a></div>
        </div>
      </div>
      <hr>
      <div class="disconnect-link">
        <div class="btn-group dropup">
          <button  class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> Settings </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li> <a href="./admin-profile.php">Profile</a></li>
            <li><a href="./admin-disconnect.php">Disconnect</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <script src="../js/sidebar.js"></script>