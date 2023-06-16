<?php
require_once './includes/dbh.inc.php';
error_reporting(E_ERROR | E_PARSE);
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

<div class="table-card">
    <h2>Journals List</h2>

    <table class="table align-middle my-5 bg-white">
        <thead class="bg-light">
            <tr>
                <th class="sortable">Journal Name</th>
                <th class="sortable">Likes</th>
                <th class="sortable">Saves</th>
                <th class="sortable">Author</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch journals from the journal table with state = "published"
            $query = "SELECT j.*, CONCAT(m.mb_name, ' ', m.mb_last_name) AS author_name
            FROM journal AS j
            INNER JOIN members AS m ON j.id_mb = m.id_mb
            WHERE j.jr_state = 'published'";
  
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $journals = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Iterate through each journal
            foreach ($journals as $journal) {
                $journalId = $journal['jr_id'];
                $journalName = $journal['jr_name'];
                $likes = $journal['jr_likes'];
                $saves = $journal['jr_saves'];
                $authorName = $journal['author_name'];
                $isApproved = $journal['is_prooved'];
            ?>
                <tr>
                    <td>
                        <?php echo $journalName; ?>
                    </td>
                    <td>
                        <?php echo $likes; ?>
                    </td>
                    <td>
                        <?php echo $saves; ?>
                    </td>
                    <td>
                        <?php echo $authorName; ?>
                    </td>
                    <td>
                        <?php if ($isApproved == 1) { ?>
                            <form method="POST">
                                <input type="hidden" value="<?php echo $journalId; ?>" name="journalId">
                                <button type="submit" name="unapprove" class="btn btn-danger btn-sm btn-rounded">Unapprove</button>
                            </form>
                        <?php } else { ?>
                            <form method="POST">
                                <input type="hidden" value="<?php echo $journalId; ?>" name="journalId">
                                <button type="submit" name="approve" class="btn btn-primary btn-sm btn-rounded">Approve</button>
                            </form>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>

            <?php
            if (isset($_POST['unapprove'])) {
                $journalId = $_POST['journalId'];
                $query = "UPDATE journal SET is_prooved = 0 WHERE jr_id = :journalId";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':journalId', $journalId);
                $stmt->execute();
            }

            if (isset($_POST['approve'])) {
                $journalId = $_POST['journalId'];
                $query = "UPDATE journal SET is_prooved = 1 WHERE jr_id = :journalId";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':journalId', $journalId);
                $stmt->execute();
            }
            ?>
        </tbody>
    </table>
</div>




    </main>

    <script src="./js/admin-dashboard.js"></script>

</body>

</html>