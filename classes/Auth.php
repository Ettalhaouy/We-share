<?php

class Auth
{

    public function register($db, $email, $login, $password, $rib,$table)
    {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $db->query("INSERT INTO $table SET email=?,login=?,password=?", [$email, $login, $password]);
        $id_org = $db->lastInsertId();

        $db->query("INSERT INTO payInfo SET RIB=?,id_org=?", [$rib,$id_org]);

        return $id_org;

    }

    public function isValidInsertPaymentsInfos($db,$id_ads,$date){

        if (!empty($_POST['price']) && !empty($_POST['nameCard']) && !empty($_POST['cardNumber']) && !empty($_POST['expiration']) && !empty($_POST['CCV'])) {

            $db->query("INSERT INTO donations (id_events, amount, Date) VALUES (?,?,?)", [$id_ads, $_POST['price'], $date]);
        
            $early_nb_donation_ads = $db->query('SELECT * FROM advertisements  WHERE id = ?', [$id_ads])->fetch();
        
            $new_nb_donation_ads = floatval($early_nb_donation_ads->nb_Donation) + floatval($_POST['price']);
        
            $db->query("UPDATE advertisements SET nb_Donation=?  WHERE id=?", [$new_nb_donation_ads, $id_ads]);
        
            return true;
        }else{
            return false;
        }

    }

    public function insertNewAnnounceData($db,$date,$session_id,$name_extension,$extensions_autorisation,$file_dest,$file_tmp_name){

        if (in_array($name_extension, $extensions_autorisation)) {
            if (move_uploaded_file($file_tmp_name, $file_dest)) {

                $insert = $db->query("INSERT INTO advertisements (title, photo, Description,date,id_organisaton)
                VALUES (?,?,?,?,?)", [$_POST['title'], $file_dest, $_POST['description'], $date, $session_id]);

                return true;
            }
        } 
        return false;
    }

    public function ModifyAnnounceData($db,$name_extension,$file_tmp_name,$file_dest,$extensions_autorisation,$date,$id){

        if (in_array($name_extension, $extensions_autorisation)) {
            if (move_uploaded_file($file_tmp_name, $file_dest)) {
                $insert = $db->query("UPDATE advertisements SET photo=?,date=? WHERE id=?", [$file_dest, $date, $id]);
                return true;
            }
        }
        return false;
    }

}