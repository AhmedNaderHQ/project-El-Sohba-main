<?php
    session_start();
    include '../../databaseconnect.php';
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $op = $_GET['op'];
        if($op == 'Search'){
            $query = $_GET['query'];
            $stmt = $conn->prepare("SELECT `Name`,`ID` FROM `items` WHERE  `Name` LIKE '%$query%'");
            $stmt -> execute();
            $count = $stmt->rowCount();
            if($count > 0){
                $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($items as $item){
                    $link = str_replace(' ', '-', $item['Name']);
                    ?>
                        <a href="product/<?=$link?>" style="color: black;">
                            <li class="list-group-item p-0">
                                            
                                <?php
                                    $stmt = $conn -> prepare("SELECT `Image-Name` FROM `items-images` WHERE `Item_ID` = ?");
                                    $stmt -> execute(array($item['ID']));
                                    $images = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                                    if(count($images) > 0){
                                        ?>
                                            <img style="width: 72px;" src="admin/uploads/images/items-images/<?=$images[0]['Image-Name']?>" class="card-img-top" alt="<?=$item['Name']?>">
                                        <?php
                                    }
                                ?>
                                <span style="font-size: 1.4rem;margin-left: 10px;"><?=$item['Name']?></span>
                            </li>
                        </a>
                    <?php
                }



                
            }
            else{
                ?>
                    <li class="list-group-item" style="color: black;">Sorry, we don't have any result.</li>
                <?php
            }
                
            

        }
        
    }

?>