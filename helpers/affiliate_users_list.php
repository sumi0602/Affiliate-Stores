<?php
function getAffiliateTree($userId)
 {
    global $conn;
    $stmt = $conn->prepare( "WITH RECURSIVE UserHierarchy AS 
    (SELECT UserID,ParentID,Name, 1 AS level 
    FROM users WHERE UserID= $userId
    UNION ALL 
    SELECT u.UserID,u.ParentID,u.Name,uh.Level + 1
      FROM users u
      INNER JOIN UserHierarchy uh ON u.ParentID = uh.UserID
    ) SELECT * FROM UserHierarchy" ) ;

    $stmt->execute();
    $affiliates = $stmt->fetchAll( PDO::FETCH_ASSOC );
    $data = [];
    foreach ( $affiliates as $affiliate ) {
        $data[] = [
            'UserID'=>$affiliate[ 'UserID' ],
            'Name'=>$affiliate[ 'Name' ],
            'ParentID'=>$affiliate[ 'ParentID' ]
        ];
    }
    return $data;
}

function displayAffiliateTree( $data ) {
    echo "<div class='container'><table class='table table-striped'><tr><th>Name</th><th>UserId</th><th>ParentId</th></tr>";
    foreach ( $data as $node ) {
        echo '<tr>';
        echo '<td>' . $node[ 'Name' ] .'</td>';
        echo '<td>' .  $node[ 'UserID' ].'</td>';
        echo '<td>' .  $node[ 'ParentID' ].'</td>';
        echo '</tr>';
    }
    echo '<table/></div>';
}
