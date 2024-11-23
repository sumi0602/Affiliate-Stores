<?php
include('../../config/connect.php');
include('../../layouts/header.php');

if(isset($_POST['update']))
{
    $name = $_POST[ 'name' ];
    $email = $_POST[ 'email' ];
    $id = $_GET['id'];

    //Validate Input
    if ( empty( $name ) || empty( $email ) ) {
        die( 'Please fill in all required fields' );
    }

    //Check if email already exists
    $stmt =  $conn->prepare( 'SELECT COUNT(*) FROM users WHERE Email = ?' );
    $stmt->execute( [ $email ] );
    if ( $stmt->fetchColumn() > 0 ) {
        die( 'Email already exists.Please use a different email.' );
    }

    //Insert new user
    $sql = 'UPDATE users SET Name=?,Email=? WHERE UserID=?';
    $stmt = $conn->prepare( $sql );

    if ( $stmt->execute( [ $name, $email,$id ] ) ) {
        $userId = $conn->lastInsertId();
        echo 'User Updated Successfully';

    } else {
        if ( $conn->errno === 1062 ) {
            echo 'Error: The email is already registered.';
        } else {
            echo 'Error: '.$conn->error;
        }

    }
}
$id=$_GET['id'];
$ret = "select * from users where UserID=?";
$stmt = $conn->prepare($ret);
$stmt->execute([$id]);
$res = $stmt->fetchAll( PDO::FETCH_ASSOC );

foreach($res as $val) {
    $name = $val['Name'];
    $email = $val['Email'];
}
?>
<div class = 'container'>
    <h1>Affiliate User Edit Registration</h1>
    <form action = '' method = 'post'>
        <div class = 'form-group'>
            <label for = 'pwd'>Full Name :</label>
            <input type = 'text' class = 'form-control' id = 'name' name = 'name' value='<?php echo $name;?>'>
        </div>
        <div class = 'form-group'>
            <label for = 'email'>Email address:</label>
            <input type = 'email' class = 'form-control' id = 'email' name = 'email' value='<?php echo $email;?>'>
        </div>
        <div class = 'form-group'>
            <label for = 'referrer_id'>Referrer ID ( Parent User ID ):</label>
            <select name = 'referrer_id' id = 'referrer_id' class = 'form-control'>
                <?php
                  $referrerCheckSql = "SELECT UserID,Name,ParentID,Email FROM users WHERE UserID= ".$id;
                  $stmt = $conn->prepare( $referrerCheckSql );
                  $stmt->execute();
                $result =  $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ( !empty( $result ) ) {?>
                    <?php
                    foreach ( $result as $res ) {?>
                        <option value = "<?php echo $res['UserID']?>">
                            <?php echo $res[ 'UserID' ]?>
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
        <button type = 'submit' class = 'btn btn-default' name='update'>Register</button>
    </form>
</div>