<?php
/**
 * Created by PhpStorm.
 * User: Chrille
 * Date: 2014-10-01
 * Time: 14:11
 */

require_once("View.php");
class EditView extends View{
    public function getEditView(User $user){
        $html = "
        <form method='post'>
                <input type='text' name='firstname' value='{$user->firstname}'>
                <input type='text' name='lastname' value='{$user->lastname}'>
                <input type='text' name='ssn' value='{$user->ssn}'>
                <input type='submit' value='Change'>
                </form>
        ";
        return $html;
    }
}