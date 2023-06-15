<?php
require_once '../includes/dbh.inc.php';
session_start();
$memberId = $_SESSION['Id'];
// Delete records from the "likes" table
$likesQuery = "DELETE FROM likes WHERE id_mb = :memberId";
$stmt = $pdo->prepare($likesQuery);
$stmt->bindParam(':memberId', $memberId);
$stmt->execute();

// Delete records from the "save" table
$savesQuery = "DELETE FROM save WHERE id_mb = :memberId";
$stmt = $pdo->prepare($savesQuery);
$stmt->bindParam(':memberId', $memberId);
$stmt->execute();

// Delete records from the "journal" table
$journalsQuery = "DELETE FROM journal WHERE id_mb = :memberId";
$stmt = $pdo->prepare($journalsQuery);
$stmt->bindParam(':memberId', $memberId);
$stmt->execute();

header("Location: ../myjournals.php");

?>