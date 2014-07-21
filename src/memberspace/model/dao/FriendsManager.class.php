<?php namespace memberspace\model\dao;

use memberspace\model\User;

class FriendsManager
{

    /**
     * Convertit un tableau passé en argument en objet de classe User
     * @param $aUser
     * @return User l'objet
     */
    private static function convertToObject($aUser)
    {
        $oUser = new User();
        $oUser->setEmail($aUser['email']);
        $oUser->setPassword($aUser['password']);
        $oUser->setLastName($aUser['lastname']);
        $oUser->setFirstName($aUser['firstname']);
        $oUser->setAvatar($aUser['avatar']);
        $oUser->setGender($aUser['gender']);
        $oUser->setJob($aUser['job']);
        $oUser->setRegisterDate($aUser['registerdate']);
        $oUser->setId($aUser['id']);
        return $oUser;
    }

    /**
     * Récupère tous les utilisateurs amis avec celui connecté (passé en argument). la table friends est composée de deux clés primaires qui pointent vers la clé primaire user.id. Ainsi que des couples unique de relation peuvent être rentrés dans la base.
     * @param User $oUser
     * @return array de tous les utilisateurs de type User
     */
    public static function getAll(User $oUser)
    {
        $iUserId = $oUser->getId();
        $sQuery = 'select * from user u, friends f where (f.id1 = u.id AND f.id2="' . $iUserId . '") OR (f.id2 = u.id AND f.id1="' . $iUserId . '")';
        $aFriends = array();
        foreach (DBOperation::getAll($sQuery) as $aUser) {
            $aFriends[] = self::convertToObject($aUser);
        }
        return $aFriends;
    }

    /**
     * Etablit un nouveau lien entre deux utilisateurs
     * @param User $oUser
     * @return bool true si succès, sinon false
     */
    public static function newFriend(User $oUser)
    {
        if (array_key_exists('login', $_SESSION)) {
            $sLoggedMemberId = $_SESSION['login'];
            $sQuery = "insert into friends(id1,id2) values('".$sLoggedMemberId."','{$oUser->getId()}')";
            if (!DBOperation::exec($sQuery)) {
                return false;
            }
        }
        return true;
    }

} 