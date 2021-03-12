<?php

class Auth
{

    public function register($db, $email, $login, $password, $table,$type = null)
    {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $db->query("INSERT INTO $table SET email=?,login=?,password=?", [$email, $login, $password]);
        $user_id = $db->lastInsertId();

        if($type){
            $db->query("INSERT INTO payInfo SET id_user=?", [$user_id]);
        }

        return $user_id;

    }

    public function isValidInsertPaymentsInfos($db,$new_nb_donation,$id_ads,$id_user,$date){

        if (!empty($_POST['price']) && !empty($_POST['nameCard']) && !empty($_POST['cardNumber']) && !empty($_POST['expiration']) && !empty($_POST['CCV'])) {

            $paymensInfos = $db->query("UPDATE payInfo SET NameCard=? , NumberCard=? , Expiration=? , CCV=? WHERE id_user=?", [$_POST['nameCard'], $_POST['cardNumber'], $_POST['expiration'], $_POST['CCV'], $id_user]);
        
            $donation = $db->query("INSERT INTO donations (id_events, id_user, amount, Date) VALUES (?,?,?,?)", [$id_ads, $id_user, $_POST['price'], $date]);
        
            $early_nb_donation_ads = $db->query('SELECT * FROM advertisements  WHERE id = ?', [$id_ads])->fetch();
        
            $new_nb_donation_ads = floatval($early_nb_donation_ads->nb_Donation) + floatval($_POST['price']);
        
            $ads_nb_donation = $db->query("UPDATE advertisements SET nb_Donation=?  WHERE id=?", [$new_nb_donation_ads, $id_ads]);
        
            $nb_donation_user = $db->query("UPDATE users SET nb_donation=? WHERE id=?", [$new_nb_donation, $id_user]);

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