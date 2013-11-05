<?php
    
    $uj = $_POST['new_one_p'];
    $kerdes = $_POST['new_question_p'];
    $current = $_POST['current_p'];
    $cData = $_POST['data_p'];

    
    if(isset($uj) && isset($kerdes) && isset($current) && isset($cData)){
        include 'inc/connection.php';
    
        $result = mysqli_query($connection, "SELECT MAX(`id`) FROM `barkoba`");
        $row = mysqli_fetch_row($result);
        $highest_id = $row[0];

        $id_old = $highest_id+1;
        $id_new = $highest_id+2;
        
        $sql = 'INSERT INTO `barkoba` (`id`, `data`, `left`, `right`, `parent`) VALUES (\''.$id_old.'\', \''.$cData.'\', \'-1\', \'-1\', \''.$current.'\');';
        mysqli_query($connection, $sql);
        
        $sql = 'INSERT INTO `barkoba` (`id`, `data`, `left`, `right`, `parent`) VALUES (\''.$id_new.'\', \''.$uj.'\', \'-1\', \'-1\', \''.$current.'\');';
        mysqli_query($connection, $sql);
        
        $sql = 'UPDATE `barkoba` SET `data` = \''.$kerdes.'\', `left` = \''.$id_new.'\', `right` = \''.$id_old.'\' WHERE `barkoba`.`id` = '.$current.' LIMIT 1;';
        mysqli_query($connection, $sql);
        
        include 'inc/connectionend.php';
    }
?>
