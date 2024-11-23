<?php
include( '../../config/connect.php' );

$commissionRates = [ 0.01, 0.02, 0.03, 0.05, 0.10 ];
// Function to calculate payouts for an affiliate sale

if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {

    $affiliateId = ( int ) $_POST[ 'affiliate_id' ];
    $amount = ( float ) $_POST[ 'amount' ];

    if ( $affiliateId <= 0 || $amount <= 0 ) {
        die( 'Invalid affiliate ID or sale amount' );
    }
    //Records the sale
    $stmt = $conn->prepare( 'INSERT INTO Sales(AffiliateID,Amount) VALUES(?, ?)' );
    $stmt->execute( [ $affiliateId, $amount ] );

    $saleId = $conn->lastInsertId();

    //Multi levels payout Logic
    $level = 1;
    $currentAffiliateId = $affiliateId;
    $stmt = $conn->prepare( 'SELECT Level FROM users where UserID = ?' );
    $stmt->execute( [ $currentAffiliateId ] );
    $result = $stmt->fetch( PDO::FETCH_ASSOC );
    $currentLevel = $result[ 'Level' ];

    $totalCommission = 0;
    if ( $currentLevel === 5 )
    {
        while( $currentAffiliateId && $level <= 5 ) {
            //calculate commission for this level
            $commission = $amount * ( $commissionRates[ $level - 1 ] );
            $stmt = $conn->prepare( 'INSERT INTO Payouts(SaleID, AffiliateID,Level,Amount) VALUES(?,?,?,?)' );
            $stmt->execute( [ $saleId, $currentAffiliateId, $level, $commission ] );

            $totalCommission += $commission;
            //fetch the referrer
            $stmt = $conn->prepare( 'SELECT ParentID FROM users WHERE UserID=?' );
            $stmt->execute( [ $currentAffiliateId ] );
            $currentAffiliateId = $stmt->fetchColumn();

            $level++;
        }
        //Add commission to referer balance
        $stmt = $conn->prepare( 'UPDATE sales SET CommissionEarned = ? WHERE SaleID= ?' );
        $stmt->execute( [ $totalCommission, $saleId ] );

        echo "Sale recorded successfully ! Total Comission Distributed: $totalCommission";
    } else {
        echo 'Sale recorded successfully';
    }
}

?>
