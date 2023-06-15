<?php
require_once '../includes/dbh.inc.php';
session_start();
$memberId = $_SESSION['Id'];
// Delete records from the "likes" table
$likesQuery = "DELETE FROM likes WHERE id_mb = :memberId";
$stmt = $pdo->prepare($likesQuery);
$stmt->bindParam(':memberId', $memberId);
$stmt->execute();

// Delete records from the "saves" table
$savesQuery = "DELETE FROM save WHERE id_mb = :memberId";
$stmt = $pdo->prepare($savesQuery);
$stmt->bindParam(':memberId', $memberId);
$stmt->execute();

// Delete records from the "goals" table
$goalsQuery = "DELETE FROM goal WHERE id_mb = :memberId";
$stmt = $pdo->prepare($goalsQuery);
$stmt->bindParam(':memberId', $memberId);
$stmt->execute();

// Delete records from the "journals" table
$journalsQuery = "DELETE FROM journal WHERE id_mb = :memberId";
$stmt = $pdo->prepare($journalsQuery);
$stmt->bindParam(':memberId', $memberId);
$stmt->execute();

// Delete records from the "members" table
$membersQuery = "DELETE FROM members WHERE id_mb = :memberId";
$stmt = $pdo->prepare($membersQuery);
$stmt->bindParam(':memberId', $memberId);
$stmt->execute();
header("Location: ../index.php");

?>