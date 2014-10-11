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
}