<?php namespace memberspace\model\dao;

use memberspace\model\User;


class UserManager
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
     * Récupère tous les utilisateurs de la base
     * @return array de tous les user
     */
    public static function getAll()
    {
        $sQuery = 'select * from user';
        $aUsers = array();
        foreach (DBOperation::getAll($sQuery) as $aProduct) {
            $aUsers[] = self::convertToObject($aProduct);
        }
        return $aUsers;
    }

    /**
     * @param $iLimit
     * @return array de tous les users en nombre limité, rentré en paramètre
     */
    public static function getNumberLimit($iLimit)
    {
        $sQuery = 'select * from user order by registerdate desc limit ' . $iLimit . '';
        $aUsers = array();
        foreach (DBOperation::getAll($sQuery) as $aProduct) {
            $aUsers[] = self::convertToObject($aProduct);
        }
        return $aUsers;
    }

    /**
     * @param $iLimit
     * @return array d'utilisateurs choisis au hasard, en nombre limité, rentré en paramètre
     */
    public static function getRandomNumberLimit($iLimit)
    {
        $sQuery = 'select * from user order by rand() limit ' . $iLimit . '';
        $aUsers = array();
        foreach (DBOperation::getAll($sQuery) as $aProduct) {
            $aUsers[] = self::convertToObject($aProduct);
        }
        return $aUsers;
    }

    /**
     * Crée un nouvel utilisateur dans la base
     * @param User $oUser
     * @return bool si opération réussie
     */
    public static function subscribe(User $oUser)
    {

        $sQuery = "insert into user(email, gender, firstname, lastname, password, job, registerdate, avatar) ";
        $sQuery .= "values('{$oUser->getEmail()}','{$oUser->getGender()}','{$oUser->getFirstName()}','{$oUser->getLastName()}','{$oUser->getCryptedPassword()}'";
        $sQuery .= ",'{$oUser->getJob()}','{$oUser->getRegisterDate()}','{$oUser->getAvatar()}')";

        return DBOperation::exec($sQuery);
    }

    /**
     * Connecte un utilisateur en $_SESSION sur le site, en comparant son email et password rentrés dans le formulaire avec les champs de la base de données
     * @param User $oUser
     * @return bool si connection réussie
     */
    public static function connect(User $oUser)
    {
        $sQuery = "select * from user where email ='{$oUser->getEmail()}' and password = '{$oUser->getCryptedPassword()}' limit 1";
        $bResult = false !== DBOperation::getOne($sQuery);
        if ($bResult) { //si la requête a fonctionné
            $oLoggedUser = self::convertToObject(DBOperation::getOne($sQuery)); //les informations de l'utilisateur connecté sont récupérées
            $_SESSION['login'] = $oLoggedUser->getId(); //l'id de l'utilisateur connecté est mis dans le $_SESSION, donc disponible lors de sa session
        } else {
            unset($_SESSION['login']);  //sinon la case ['login'] est retirée -> l'utilisateur n'est plus considéré comme connecté
        }
        return $bResult;
    }

    /**
     * Déconnecte l'utilisateur avec une sécurité : l'objet de classe user en paramètre doit contenir en id la valeur dans $_SESSION['login']
     * @param User $oUser
     */
    public static function logout(User $oUser)
    {
        unset($_SESSION['login']);
    }

    /**
     * Récupère un utilisateur, selon son id passé en argument
     * @param User $oUser
     * @return User un seul
     */
    public static function get(User $oUser)
    {
        $sQuery = "select * from user where id ='{$oUser->getId()}' limit 1";

        return self::convertToObject(DBOperation::getOne($sQuery));
    }

    /**
     * Récupère le $_SESSION['login'] seulement si l'utilisateur est connecté, sinon renvoie null
     * @return User|null
     */
    public static function getCurrent()
    {
        if (!array_key_exists('login', $_SESSION)) {
            return null;
        }

        $oUser = new User();
        $oUser->setId($_SESSION['login']);

        return self::get($oUser);
    }

    /**
     * Utilisée avec le formulaire AJAX de recherche, cette fonction renvoie des résultats selon la string passée en argument (qui correspond à ce que l'utilisateur est entrain de taper)
     * @param $sSearch
     * @return array avec les utilisateurs correspondant à la recherche passée en argument (complétant la requête)
     */
    public static function search($sSearch)
    {
        $sQuery = "SELECT *";
        $sQuery .= " FROM user";
        $sQuery .= " WHERE email LIKE '%$sSearch%'";    //les informations vont être cherchées dans le champ email, si $sSearch est contenue dedans
        $sQuery .= " OR firstname LIKE '%$sSearch%'";
        $sQuery .= " OR lastname LIKE '%$sSearch%'";
        $sQuery .= " OR job LIKE '%$sSearch%'";

        $aUsers = array();
        foreach (DBOperation::getAll($sQuery) as $aUser) {
            $aUsers[] = self::convertToObject($aUser);
        }
        return $aUsers;
    }

    /**
     * Remplace la valeur de user.avatar par une nouvelle, passée en argument (dans l'objet User)
     * @param User $oUser
     * @return bool retourne true si l'opération a fonctionné
     */
    public static function setNewAvatar(User $oUser)
    {
        if($oUser->getAvatar()==''){
            $oUser->setAvatar('images/base_avatar.jpg');
        }
        $sQuery = "UPDATE user SET avatar = REPLACE(avatar, avatar, '" . $oUser->getAvatar() . "') WHERE id='" . $oUser->getId() . "'";
        return DBOperation::exec($sQuery);
    }
}