<?php
// functions.php

function updateUserData($connection, $userid, $data) {
    $stmt = $connection->prepare("UPDATE user SET name = ?, username = ?, password = ?, confirm_password = ?, address = ?, role = ? WHERE userid = ?");
    $stmt->bind_param("ssssssi", $data['name'], $data['username'], $data['password'], $data['confirm_password'], $data['address'], $data['role'], $userid);
    $stmt->execute();
    $stmt->close();
}

function getUserData($connection, $userid) {
    $stmt = $connection->prepare("SELECT * FROM user WHERE userid = ?");
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $result = $stmt->get_result();
    $userData = $result->fetch_assoc();
    $stmt->close();
    return $userData;
}

function deleteUser($connection, $userid) {
    $stmt = $connection->prepare("DELETE FROM user WHERE userid = ?");
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $stmt->close();
}
?>
