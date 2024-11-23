<?php
include( 'dashboard/list_referral_report.php' );
?>

<div class = 'container'>
    <table class = 'table table-striped'>
        <h1>Affiliate Sales Journey</h1>
        <tr>
            <td colspan = '4'><a href = 'pages/sales/add_sale_form.php' class = 'btn btn-primary btn-md'>Add Sale</a></td>
        </tr>
        <tr>
            <th>Sale Processed By</th>
            <th>Total Commission</th>
            <th>Level Of Transaction</th>
            <th>Action</th>
        </tr>
        <tbody>
            <?php
            $result = generateAffiliateReport();
            foreach ($result as $res) { ?>
                <tr>
                <td><?php echo $res['Name'];?></td>
                <td><?php echo $res["commission_total"]; ?></td>
                <td><?php echo $res["Level"]; ?></td>
                <td><a href="pages/sales/view_transactions.php?id=<?php echo $res['SaleID'];?>">view transaction</a></td>
                </tr>
            <?php 
            }
            ?>
        </tbody>
    </table>
</div>