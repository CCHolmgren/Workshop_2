<?php
/**
 * Created by PhpStorm.
 * User: Chrille
 * Date: 2014-10-10
 * Time: 13:40
 */
require_once(__ROOT__."/Model/UserModel.php");
require_once(__ROOT__."/View/RemoveView.php");

class RemoveUserController {
    private $view;
    private $userList;

    public function __construct($view = null){
        $this->view = $view === null ? new RemoveView() : $view;
        $this->userList = new UserList();
    }
    public function getHTML(){
        $userRepository = new UserRepository();
        $user = $userRepository->getUserById($_GET["userid"]);

        if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["totallysure"])){
            $userRepository = new UserRepository();
            $user = $userRepository->getUserById($_POST["membernumber"]);
            $this->userList->removeUser($user);
            $this->userList->saveUsers();
            header("Location: "."/Workshop2/user/");
            exit;
        }
        return $this->view->getRemoveView($user);
    }
}