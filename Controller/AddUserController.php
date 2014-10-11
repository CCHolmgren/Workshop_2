<?php
/**
 * Created by PhpStorm.
 * User: Chrille
 * Date: 2014-10-10
 * Time: 12:52
 */
require_once(__ROOT__."/Model/UserModel.php");
require_once(__ROOT__."/View/CreateView.php");

class AddUserController {
    private $view;
    private $userList;

    public function __construct($view = null){
        $this->view = $view === null ? new CreateView() : $view;
        $this->userList = new UserList();
    }
    public function getHTML(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $tempUser = new User($_POST["firstname"],$_POST["lastname"],$_POST["ssn"]);
            $this->userList->addUser($tempUser);
            $this->userList->saveUsers();
            header("Location: "."/Workshop2/user/");
            exit;
        }
        return $this->view->getCreateView();
    }
}