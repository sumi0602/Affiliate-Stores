<?php
include('../../layouts/header.php');
include('../../dashboard/list_all_user.php');
include( '../../config/connect.php' );
?>
<div class = 'container'>
    <h1>Add Affiliate</h1>
    <form action = 'process_referral.php' method = 'post'>
        <div class = 'form-group'>
            <label for = 'pwd'>Affiliate Name :</label>
            <input type = 'text' class = 'form-control' id = 'name' name = 'name'>
        </div>
        <div class = 'form-group'>
            <label for = 'email'>Affiliate Email:</label>
            <input type = 'email' class = 'form-control' id = 'email' name = 'email'>
        </div>
        <div class = 'form-group'>
            <label for = 'referrer_id'>Sponsor ( Parent Affiliate):</label>
            <select name = 'referrer_id' id = 'referrer_id' class = 'form-control'>
                <?php
                $result = getReferredAllList();
                if ( !empty( $result ) ) {?>
                    <option value="">None (Top Level)</option>
                    <?php
                    foreach ( $result as $res ) {?>
                        <option value = "<?php echo $res['UserID']?>">
                           Level <?php echo $res['Level']?> - <?php echo $res['Name']?>
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
        <button type = 'submit' class = 'btn btn-default'>Register</button>
    </form>
</div>