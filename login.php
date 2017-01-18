<?php
    include "includes/functions.php";
    $fbdata = $_POST['all'];
    $arr = json_decode($fbdata);

    try{
        $fbid = $arr->id;
        $stm = $dbh->query("SELECT id FROM users WHERE fbid = $fbid");
        $userid = $stm->fetch();
        $_SESSION['fbid'] = $fbid;
        $_SESSION['firstname'] = $arr->first_name;
        $_SESSION['lastname'] = $arr->last_name;

        if($userid != null)
        {
            $stm = $dbh->query("SELECT firstname, lastname FROM users WHERE id = $userid->id");
            $userfbdata = $stm->fetch();

            if(strcmp($userfbdata->firstname,$arr->first_name) != 0 ||  strcmp($userfbdata->lastname,$arr->last_name) !=0)
            {
                $sth = $dbh->prepare("UPDATE users SET firstname=?, lastname=? WHERE id=?");
                $update_went_ok = $sth->execute(array(
                    $arr->first_name,
                    $arr->last_name,
                    $userid->id));
            }
            $_SESSION['id'] = $userid->id;
            echo json_encode("logged");
        }
        else
        {
            try {
                $sth = $dbh->prepare("INSERT INTO users (fbid, firstname, lastname)
                              VALUES(?,?,?)");
                $sth->execute(array(
                    $_SESSION['fbid'],
                    $_SESSION['firstname'],
                    $_SESSION['lastname']
                ));
                $id = $dbh->lastInsertId('users_id_seq');
                $_SESSION['id'] = $id;
                echo json_encode("logged");
            }
            catch (Exception $e) {
                echo json_encode("error");
            }
        }
    }
    catch (Exception $e)
    {
        echo json_encode("error");
    }
?>