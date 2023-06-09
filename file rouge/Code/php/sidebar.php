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
    <img src="profile.jpg" alt="Profile Picture">
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
        <div><a href="./myjourrnals.php">My journals</a></div>
        <div><a href="./savedJournals.php">Saved & Liked journals</a></div>
      </div>
    </div>
    
    <div class="section">
      <h3>Assistance </h3>
      <div class="sidebar_links">
        <div><a href="./search.php">Find a Therapist</a></div>
        <div><a href="articals.php">Articals </a></div>
      </div>
    </div>    
    <div class="disconnect-link">
    <hr>
    <div>
      <a href="./disconnect.php"><i class="fas fa-sign-out-alt"></i>Disconnect</a>
    </div>
  </div>
  </div>
  </div>
  <script src="../js/sidebar.js"></script>