<?php
/*
** Title Function v1.0
** Title Function That Echo The Page Title In Case The Page 
** Has The $pageTitle variable And Echo A Default Title For Other Pages
*/
function getTitle() {
    global $pageTitle;
    if (isset($pageTitle)) {
        echo $pageTitle;
    }else{
        echo 'JENAN';
    }
}



/*
** Icon Function v1.0
** Icon Function That Echo The Page Icon In Case The Page 
** Has The $pageIcon variable And Echo A Default Icon For Other Pages
*/
function getIcon() {
    global $pageIcon;
    if (isset($pageIcon)) {
        echo $pageIcon;
    }else{
        echo 'logo.ico';
    }
}


/*
** Redirect Function v2.0
** Redirect Function  [ This Function accept parameters ]
** $theMsg = echo the Message [success | failure | warning ]
** $url = the link you want to redirect to
** $seconds = Seconds before redirecting 
*/
function redirectHome($theMsg, $url=null, $seconds = 3){
    if ($url == null) {
        $url = 'index.php';
        $link = 'Homepage';
    }else{
        if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']))
        {
            $url = $_SERVER['HTTP_REFERER'];
            $link = 'previous page';
        }else{
            $url = 'index.php';
            $link = 'Homepage';
        }
    }
    echo  $theMsg ;
    echo '<div class="alert alert-info">You will be redirected to '.$link.' after '.$seconds.' seconds.</div>';
    header("refresh:$seconds; url=$url");
    exit();
}

/*
** Get categories Function v1.0
** Function to get categories from database.
*/
function getCat(){
    global $conn ;
    $getCATstmt = $conn->prepare("SELECT * FROM categories ORDER BY ID ASC");
    $getCATstmt->execute();
    $cats = $getCATstmt->fetchAll();
    return $cats;
}


/*
** Check items Function v1.0
** Function to check items in the database [ This Function accept parameters ]
** $select = the item to select [example: user, item, category]
** $from = the table to select from [example: users, items, categories]
** $value = the value of select [example: Grizi, box, Legends]
*/
function checkItem($select, $from, $value){
    global $conn ;
    $statement = $conn->prepare("SELECT $select FROM $from WHERE $select = ?");
    $statement->execute(array($value));
    $count = $statement->rowCount();
    return $count ;
}

function checkItemEdit($select, $from, $value, $idColum, $id){
    global $conn ;
    $statement = $conn->prepare("SELECT `$select` FROM `$from` WHERE `$select` = ? AND `$idColum` != ? ");
    $statement->execute(array($value, $id));
    $count = $statement->rowCount();
    return $count ;
}

/*
** Count number of items Function v1.0
** Function to count number items rows.
** $item = the item to count
** $table = the table to count its items.
** 
*/
function countItems($item, $table, $options = null ){
    global $conn ;
    $stmt2 = $conn->prepare("SELECT COUNT($item) FROM $table WHERE $options");
    $stmt2->execute();
    return $stmt2->fetchColumn();

}




/*
** Get latest records Function v1.0
** Function to get latest items from database [ users, items, categories ].
** $select = the field to select. 
** $table = the table to choose from its items.
** $limit = number of items to get.
** $order = the descending order of the items.
*/
function getLatest($select, $table, $order, $limit = 5, $options=''){
    global $conn ;
    $getstmt = $conn->prepare("SELECT $select FROM $table $options ORDER BY $order DESC LIMIT $limit");
    $getstmt->execute();
    $rows = $getstmt->fetchAll();
    return $rows;
}
// function getLatestUsers($select, $table, $order, $limit = 5){
//     global $conn ;
//     $getstmt = $conn->prepare("SELECT $select FROM $table WHERE GroupID !=1 ORDER BY $order DESC LIMIT $limit");
//     $getstmt->execute();
//     $rows = $getstmt->fetchAll();
//     return $rows;
// }


function getRecord( $from, $info, $value){
    global $conn ;
    $statement = $conn->prepare("SELECT * FROM `$from` WHERE `$info` = ?");
    $statement->execute(array($value));
    $record = $statement -> fetch(PDO::FETCH_ASSOC);
    return $record;
}


function getRecords($from, $options = null){
    global $conn ;
    $statement = $conn->prepare("SELECT * FROM `$from` ".$options."");
    $statement->execute();
    $records = $statement -> fetchAll(PDO::FETCH_ASSOC);
    return $records;
}



function getSpecificRecord($cell, $from, $options = null){
    global $conn ;
    $statement = $conn->prepare("SELECT $cell FROM `$from` ".$options."");
    $statement->execute();
    $record = $statement -> fetch(PDO::FETCH_ASSOC);
    return $record;
}

function getMultiSpecificRecord($cell, $from, $options = null){
    global $conn ;
    $statement = $conn->prepare("SELECT $cell FROM `$from` ".$options."");
    $statement->execute();
    $record = $statement -> fetchAll(PDO::FETCH_ASSOC);
    return $record;
}

?>