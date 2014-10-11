<?php
/**
 * Created by PhpStorm.
 * User: Chrille
 * Date: 2014-10-11
 * Time: 12:12
 */
require_once(__ROOT__."/Model/UserModel.php");
require_once(__ROOT__."/View/BoatView.php");

class BoatController {
    private $view;
    private $userList;

    public function __construct(BoatView $view = null){
        $this->userList = new UserList();
        $this->view = $view === null ? new BoatView() : $view;
    }
    public function getHTML(){
        $userid = $this->view->getUserID();
        $member = $this->userList->getUserById($userid);

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            if($this->view->getMethod() === "add"){
                $tempBoat = new Boat($_POST["length"],$_POST["boattype"]);

                $member->addBoat($tempBoat);
            }
            if($this->view->getMethod() === "edit"){
                $oldBoat = new Boat($_POST["oldLength"], $_POST["oldBoattype"]);
                $newBoat = new Boat($_POST["length"], $_POST["boattype"]);

                $member->editBoat($oldBoat, $newBoat);
            }
            if($this->view->getMethod() === "remove"){
                $tempBoat = new Boat($_POST["length"], $_POST["boattype"]);

                $member->removeBoat($tempBoat);
            }
            $this->userList->saveUsers();
            header("Location: "."/Workshop2/user/");
            exit;
        }
        switch($this->view->getMethod()){
            case "add":
                return $this->view->getAddView();
            case "edit":
                return $this->view->getEditView();
            case "remove":
                return $this->view->getRemoveView();
            default:
                return $this->view->getDefaultView();
        }
    }
}