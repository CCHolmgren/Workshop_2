<?php
/**
 * Created by PhpStorm.
 * User: Chrille
 * Date: 2014-10-11
 * Time: 13:45
 */
require_once("ListUsersView.php");
require_once("View.php");

class BoatView extends View{
    private $listusersview;
    public function __construct(){
        $this->listusersview = new ListUsersView();
    }
    public function getMethod(){
        if(isset($_GET["method"]))
            return $_GET["method"];
        return "";
    }
    public function getUserID(){
        if(isset($_GET["userid"]))
            return $_GET["userid"];
        return "";
    }
    public function getLength(){
        return $_POST["length"];
    }
    public function getBoattype(){
        return $_POST["boattype"];
    }
    public function getLengthGET(){
        return $_GET["length"];
    }
    public function getBoattypeGET(){
        return $_GET["boattype"];
    }
    public function getOldLength(){
        return $_GET["oldlength"];
    }
    public function getOldBoattype(){
        return $_GET["oldboattype"];
    }
    public function getAddView(){
        $html = "
        <form method='post'>
        <input type='text' name='length'>
        <input type='text' name='boattype'>
        <input type='submit' value='Add boat'>
        </form>
                ";
        return $html;
    }

    public function getEditView(){
        $html = "
        <form method='post'>
        <label for='length'>Length</label>
        <input type='text' name='length'>
        <label for='boattype'>Boattype</label>
        <input type='text' name='boattype'>
        <input type='submit' value='Edit boat'>
        </form>
        ";
        return $html;
    }

    public function getRemoveView(){
        $html = "
        <form method='post'>
        <input type='hidden' name='length' value='{$this->getLengthGET()}'>
        <input type='hidden' name='boattype' value='{$this->getBoattypeGET()}'>
        <input type='submit' value='Remove'>
        </form>
        ";
        return $html;
    }

    public function getDefaultView(){
        $html = "Hello you are in the default view. Here I should maybe use the boatListInfo in the ListUsersView so that I do not have to do things again. Maybe?";
        return $html;
    }
}