<?php
require_once './includes/dbh.inc.php';
// error_reporting(E_ERROR | E_PARSE);
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/admin-dashboard.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/d12613abfd.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="jquery-3.6.4.min.js"></script>

    <title>Mental Health Website</title>
</head>

<body>
    <!-- sidebar -->
    <?php
    include './admin-sidebar.php'
    ?>
    <header>
        <div class="decription">
            <h1>Administration Dashboard</h1> 
         
        </div>
        <img src="./assets/dashboard.svg" alt=""> 
      

    </header>

    <main>

    <div class="state-cards">
            <div class="state-card">
                <i class="fas fa-users"></i>
                <h3>Total Members</h3>
                <?php
                $query = "SELECT COUNT(*) AS totalMembers FROM members";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
                $totalMembers = $stmt->fetchColumn();
                ?>
                <p><?php echo "$totalMembers " ?></p>
            </div>
            <div class="state-card">
                <i class="fas fa-book"></i>

                <h3> Total Journals</h3>
                <?php
                $query = "SELECT COUNT(*) AS totalJournals FROM journal";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
                $totalJournals = $stmt->fetchColumn();
                ?>
                <p><?php echo " $totalJournals" ?></p>
            </div>
        </div>

        <div class="table-card">
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                    <tr>
                        <th class="sortable">Full name</th>
                        <th class="sortable">Email</th>
                        <th class="sortable">Totale journals</th>
                        <th>Block user</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch users from the members table
                    $query = "SELECT * , COUNT(journal.id_jr) AS published_journals FROM members LEFT JOIN journal ON members.id_mb = journal.id_mb GROUP BY members.id_mb";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();
                    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Iterate through each user
                    foreach ($users as $user) {
                        $memberId = $user['id_mb'];
                        $name = $user['mb_name'];
                        $last_name = $user['mb_last_name'];
                        $email = $user['mb_email'];
                        $publishedJournals = $user['published_journals'];
                    ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="./assets/profile.jpg" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1"><?php echo " $name $last_name " ?> </p>

                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="text-muted mb-0"><?php echo "$email " ?></p>
                            </td>
                            <td>
                                <p class="fw-normal mb-1"><?php echo "$publishedJournals " ?> </p>

                            </td>
                            <td>

                                <form method="POST">
                                    <button type="button" class="btn btn-danger btn-sm btn-rounded" data-bs-toggle="modal" data-bs-target="#blockuser<?php echo $memberId; ?>">
                                        Block user
                                    </button>

                                    <!-- delete admin Modal -->
                                    <div class="modal fade" id="blockuser<?php echo $memberId; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="blockuserLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="blockuserLabel">Block user</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this admin? They will no longer have access to the dashboard.
                                                </div>
                                                <div class="modal-footer">
                                                    <form method="POST">
                                                        <input type="hidden" value="<?php echo $memberId; ?>" name="memberId">
                                                        <button type="submit" name="block" class="btn  modal-btn">Block user</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    if (isset($_POST['block'])) {
                                        $memberId = $_POST['memberId'];
                                        $query = "UPDATE members SET is_blocked= 0 WHERE id_mb = :memberId";
                                        $stmt = $pdo->prepare($query);
                                        $stmt->bindParam(':memberId', $memberId);
                                        $stmt->execute();
                                    }
                                    ?>
                                </form>







                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>

    </main>

    <script src="./js/admin-dashboard.js"></script>

</body>

</html>