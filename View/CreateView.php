<?php
/**
 * Created by PhpStorm.
 * User: Chrille
 * Date: 2014-10-01
 * Time: 14:11
 */
class CreateView {
    public function getCreateView(){
        $html = '<form method="post">
                <input type="text" name="firstname" placeholder="Firstname">
                <input type="text" name="lastname" placeholder="Lastname">
                <input type="text" name="ssn" placeholder="Social security number">
                <input type="submit" value="Add">
                </form>';
        return $html;
    }
}