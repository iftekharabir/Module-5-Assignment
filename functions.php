<?php
include 'settings.php';
if(!function_exists('findUser')){
    function findUser($username, $allUsers='')
    {
        global $file_path;
        if(empty($allUsers)){
            $allUsers = getAllUser($file_path);
        }
        foreach ($allUsers as $user) {
            if ($user['email'] === $username) {
                return $user;
            }
        }
        return null;
    }
}
if(!function_exists('findUserKey')){
    function findUserKey($username, $allUsers=''){
        global $file_path;
        if(empty($allUsers)){
            $allUsers = getAllUser($file_path);
        }
        foreach ($allUsers as $key => $user) {
            if ($user['email'] === $username) {
                return $key;
            }
        }
        return null;
    
    }
}
if(!function_exists('getAllUser')){
    function getAllUser($file_path){
        
        $allUsers = file_exists($file_path) ? file_get_contents($file_path) : '';
        
        if(empty($allUsers)){
            return null;
        }else{
            $allUsers = json_decode($allUsers, true);
            return $allUsers;
        }
        
    }
}

if(!function_exists('getRolesList')){
    function getRolesList($selectedRole = ''){
        $roleArray = array('admin', 'modarator', 'editor', 'author');

        $rolesList = '';
        
        foreach ($roleArray as $role) {
            $selected = $selectedRole == $role ? 'selected' : '';
            $rolesList .= '<option' .$selectedRole. ' value="' . $role . '">' . ucfirst($role) . '</option>';
        }
        return $rolesList;
    }
}


?>