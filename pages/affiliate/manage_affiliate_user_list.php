<?php
include( 'dashboard/list_all_user.php' );
?>
<div class = 'col-md-12'>
    <table class = 'table table-striped'>
        <h1>Affiliate User List</h1>
        <tr>
            <td colspan = '4'><a href = 'pages/affiliate/referral_form.php' class = 'btn btn-primary btn-md'>Add Affliate User</a></td>
        </tr>
        <tr>
            <th>User Name</th>
            <th>Email</th>
            <th>Current Level</th>
            <th>Action</th>
        </tr>
        <tbody>
            <?php
            $result = getReferredAllList();
            foreach ( $result as $res ) { ?>
                <tr>
                    <td>
                        <?php echo $res[ 'Name' ];?>
                    </td>
                    <td>
                        <?php echo $res[ 'Email' ];?>
                    </td>
                    <td>
                       <?php echo 'Level'.$res['Level'];?>
                    </td>
                    <td>
                       <a href="pages/affiliate/edit_user.php?id=<?php echo $res['UserID'];?>">Edit</a> 
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>