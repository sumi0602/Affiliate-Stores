<?php
include( '../../config/connect.php' );
include('../../layouts/header.php');

global $conn;

if(isset($_GET['id'])) {
    $id=intval($_GET['id']);
}
?>
<div class = 'container'>
    <h1>Transaction View</h1>
    <?php
        global $conn;
        $sql = "SELECT payouts.Level,Amount,AffiliateID,Name from payouts JOIN users ON users.UserID = payouts.AffiliateID WHERE SaleID =?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $transactions = $stmt->fetchAll( PDO::FETCH_ASSOC );

        echo "<div class='container'><table class='table table-striped'><tr><th>Name</th><th>Level</th><th>Amount</th></tr>";
        foreach ( $transactions as $transaction ) {
            echo '<tr>';
            echo '<td>' . $transaction[ 'Name' ] .'</td>';
            echo '<td>' . $transaction[ 'Level' ] .'</td>';
            echo '<td>' .  $transaction[ 'Amount' ].'</td>';
            echo '</tr>';
        }
        echo '<table/></div>';
    
    ?>
</div>
