<?php
/**
 * Created by PhpStorm.
 * User: Chrille
 * Date: 2014-10-10
 * Time: 13:40
 */
require_once(__ROOT__."/Model/UserModel.php");
require_once(__ROOT__."/View/EditView.php");

class ChangeUserController {
    private $view;
    private $userList;

    public function __construct($view = null){
        $this->view = $view === null ? new EditView() : $view;
        $this->userList = new UserList();
    }
    public function getHTML(){
        if(isset($_GET["userid"]))
            $membernumber = $_GET["userid"];
        $userRepository = new UserRepository();

        $member = $userRepository->getUserById($membernumber);
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            //$tempUser = new User($_POST["firstname"],$_POST["lastname"],$_POST["ssn"],$member->membernumber);
            $member->firstname = $_POST["firstname"];
            $member->lastname = $_POST["lastname"];
            $member->ssn = $_POST["ssn"];
            $this->userList->editUser($member);
            $this->userList->saveUsers();
            header("Location: "."/Workshop2/user/");
            exit;
        }
        return $this->view->getEditView($member);
    }
}
