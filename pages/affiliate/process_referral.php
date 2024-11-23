<?php
include('../../layouts/header.php');
include( '../../config/connect.php' );

//Handle Form Submission
if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {

    $name = $_POST[ 'name' ];
    $email = $_POST[ 'email' ];
    $referrerId = isset( $_POST[ 'referrer_id' ] )  && !empty($_POST['referrer_id']) ? ( int ) $_POST[ 'referrer_id' ] : NULL;

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
  $level =1;
    //Validate referrer id if provided
    if ( $referrerId ) {
        $stmt = $conn->prepare( 'SELECT Level FROM users where UserID = ?' );
        $stmt->execute( [$referrerId ] );
        $result= $stmt->fetch(PDO::FETCH_ASSOC);
        if($result) {
            $level = $result['Level'] + 1;
        }
    }
    //Insert new user
    $sql = 'INSERT INTO users(Name,Email,ParentID,Level) VALUES(?, ?, ?,?)';
    $stmt = $conn->prepare( $sql );

    if ( $stmt->execute( [ $name, $email, $referrerId,$level] ) ) {
        $userId = $conn->lastInsertId();
        echo 'Affiliate Added Succesfully';
    } else {
        if ( $conn->errno === 1062 ) {
            echo 'Error: The email is already registered.';
        } else {
            echo 'Error: '.$conn->error;
        }

    }
}