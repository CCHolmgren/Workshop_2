<?php
/**
 * Created by PhpStorm.
 * User: Chrille
 * Date: 2014-10-01
 * Time: 14:24
 */

require_once(__ROOT__."/Model/UserModel.php");
require_once(__ROOT__."/View/ListUsersView.php");
class ListUsersView {
    public function compactList(UserList $userlist){
        $users = $userlist->getUserList();
        if($users){
            $result = "<table>
                        <thead>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Membernumber</th>
                                <th>Amount of boats</th>
                                <th colspan='3'>Methods</th>
                            </tr>
                        </thead>
                        <tbody>";

            foreach($users as $user){
                $result .= $this->generateTableRow($user);
            }
            $result .="</tbody></table>";
            return $result;
        }
        return "<p>There seems to be no users added yet and as such the compact list is not available</p>";
    }
    public function generateTableRow(User $user, $method = "countUsersBoats", $getAllMethods = true, $printOutSSN = false){
        $result = "<tr>
                    <td>" . $user->firstname . "</td>
                    <td>" . $user->lastname . "</td>
                    <td>" . $user->membernumber . "</td>";
        if($method !== "")
            $result .= "<td>" . $user->$method() . "</td>";
        if($printOutSSN)
            $result .= "<td>" . $user->getSSN() . "</td>";
        if($getAllMethods){
            $result .= "
                    <td><a href=./change/?userid=" . $user->membernumber . ">Change</a></td>
                    <td><a href=./remove/?userid=" . $user->membernumber . ">Remove</a></td>
                    <td><a href=./lookat/?userid=" . $user->membernumber . ">Look at</a></td>";
        }
        $result .= "</tr>";
        return $result;
    }
    public function fullList(UserList $userss){
        $users = $userss->getUserList();
        if($users){
            $result = "";
            foreach($users as $user){
                $result .= $user->firstname . " " . $user->lastname . " " . $user->ssn . " " . $user->membernumber . " " . $this->boatListInfo($user) . "<a href='./boat/?userid={$user->membernumber}'>Ändra båtar</a><br>";
            }
            return $result;
        }
        return "<p>There seems to be no users added yet and as such the full list is not available</p>";
    }
    public function boatListInfo(User $user){
        $result = "";
        $result .= "<a href='/Workshop2/user/boat/?userid=$user->membernumber&method=add'>Add boat</a><br>";
        $result .= "<table>
                        <thead>
                            <tr>
                                <th>Length</th>
                                <th>Boattype</th>
                                <th colspan='2'></th>
                            </tr>
                        </thead>
                        <tbody>";
        foreach($user->boats as $key=>$boat){
            $result .= "<tr>";
            $result .= "<td>".$boat->length . "</td><td>" . $boat->boattype."</td>";

            $result .= "<td><a href='/Workshop2/user/boat/?userid=$user->membernumber&method=remove&length=$boat->length&boattype=$boat->boattype'>Remove boat</a></td>";
            $result .= "<td><a href='/Workshop2/user/boat/?userid=$user->membernumber&method=edit&length=$boat->length&boattype=$boat->boattype'>Change boat</a></td>";
            $result .= "</tr>";
        }
        $result .= "</tbody></table>";
        return $result;
    }
    public function getListUserView(User $user){
        $result = "<table>
                        <thead>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Membernumber</th>
                                <th>SSN</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>";

        $result .= $this->generateTableRow($user, "", false, true);
        $result .= "</tbody></table>";
        $result .= $this->boatListInfo($user);
        return $result;
    }
    public function getListAllUsersView(){
        $userRepository = new UserRepository();
        $allMembers = $userRepository->getAllUsers();

        $result = "";

        $result .= "<p><a href='./add/'>Add new user</a></p>";
        $result .= $this->compactList($allMembers);
        $result .= $this->fullList($allMembers);
        return $result;
    }

    public function getRequestMethod(){
        return $_SERVER["REQUEST_METHOD"];
    }
}