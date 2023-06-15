<?php
require_once './includes/dbh.inc.php';
session_start();
$adminId = $_SESSION['Id-adm'];

// Delete records from the "admins" table
$adminQuery = "DELETE FROM admin WHERE id_adm = :adminId";
$stmt = $pdo->prepare($adminQuery);
$stmt->bindParam(':adminId', $adminId);
$stmt->execute();
header("Location: ./admin-index.php");

?>