<?php
// Function to calculate payouts for an affiliate sale

function getReferredList() 
{
    global $conn;
    $referrerCheckSql = 'SELECT UserID,Name,ParentID,Email FROM users WHERE ParentID IS NOT NULL';
    $stmt = $conn->prepare( $referrerCheckSql );
    $stmt->execute();
   return $stmt->fetchAll(PDO::FETCH_ASSOC);
    
}
