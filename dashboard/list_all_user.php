<?php
// Function to calculate payouts for an affiliate sale

function getReferredAllList() 
{
    global $conn;
    $referrerCheckSql = 'SELECT UserID,Name,ParentID,Email,Level FROM users';
    $stmt = $conn->prepare( $referrerCheckSql );
    $stmt->execute();
   return $stmt->fetchAll(PDO::FETCH_ASSOC);
    
}
