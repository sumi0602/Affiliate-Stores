<?php

// Function to calculate payouts for an affiliate sale
function getReferredParentList() 
 {
    global $conn;
    $referrerCheckSql = 'SELECT UserID,Name,ParentID,Email FROM users Where ParentID IS NULL';
    $stmt = $conn->prepare( $referrerCheckSql );
    $stmt->execute();
    return $stmt->fetchAll( PDO::FETCH_ASSOC );

}
