<?php

// Function to calculate payouts for an affiliate sale
function generateAffiliateReport() 
{
    global $conn;
    $sql = "SELECT u.name as Name,s.Amount as amount,s.CommissionEarned as commission_total,COUNT(p.Level) AS Level,s.SaleID
    FROM sales s
    LEFT JOIN payouts p on p.SaleID = s.SaleID
    LEFT JOIN users u on u.UserID = p.AffiliateID
    WHERE s.CommissionEarned>0
    GROUP BY s.SaleID
    ";
    $stmt = $conn->prepare( $sql );
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    
}