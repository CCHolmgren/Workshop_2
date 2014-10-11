<?php
/**
 * Created by PhpStorm.
 * User: Chrille
 * Date: 2014-10-01
 * Time: 14:11
 */
class RemoveView {
    public function getRemoveView(User $user){
        $html = "
        <form method='post'>
            <input type='hidden' name='totallysure'>
            <input type='hidden' name='membernumber' value='$user->membernumber'>
            <input type='submit' value='Remove this user'>
        </form>
        ";
        return $html;
    }

    public function getRequestMethod(){
        return $_SERVER["REQUEST_METHOD"];
    }
    public function redirect(){
        header("Location: "."/Workshop2/user/");
        exit;
    }
    public function isSure(){
        return isset($_POST["totallysure"]);
    }
    public function getUserID(){
        return $_POST["membernumber"];
    }
}