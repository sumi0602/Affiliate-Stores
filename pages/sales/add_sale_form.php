<?php
include('../../layouts/header.php');
include( '../../config/connect.php' );
include('../../dashboard/list_all_user.php');
?>
<div class = 'container'>
    <h1>Record a Sale</h1>
    <form action = 'record_sale.php' method = 'post'>
        <div class = 'form-group'>
            <label for = 'amount'>Sale Amount:</label>
            <input type = 'number' class = 'form-control' id = 'amount' name = 'amount'>
        </div>
        <div class = 'form-group'>
            <label for = 'referrer_id'>Affiliate User ID:</label>
            <select name = 'affiliate_id' id = 'affiliate_id' class = 'form-control'>
                <?php
                $result = getReferredAllList();
                if ( !empty( $result ) ) {
                    foreach ( $result as $res ) { ?>
                        <option value = "<?php echo $res['UserID']?>">
                        <?php echo ($res['ParentID'] ? $res['UserID'] : $res['UserID'].'(Parent)')?>
                        </option>
                    <?php
                    }
                } else {
                    ?>
                    <option value = ''></option>
                    <?php

                }
                ?>
            </select>
        </div>
        <button type = 'submit'>Submit Sale</button>
    </form>
</div>
