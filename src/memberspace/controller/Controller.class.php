<?php namespace memberspace\controller;


use memberspace\model\User;
use memberspace\model\dao\UserManager;
use memberspace\model\dao\FriendsManager;

class Controller
{
    /**
     * Fonction lancée une fois à la création d'un object Controller. Ici : dans index.php Lance la fonction privée exec()
     */
    public function __construct()
    {
        $this->exec();
    }

    /**
     * Fonction principale : affiche (require) la page en fonction de $_GET['page'] (donc de l'url)
     */
    private function exec()
    {
        $sPage = 'home';    //par défaut la page est 'home'
        if (array_key_exists('page', $_GET)) {  //s'il existe ?page= dans l'url, $sPage prend sa valeur
            $sPage = $_GET['page'];
        }

        if (!array_key_exists('type', $_GET)) { //condition nécessaire au bon fonctionnement du moteur de recherche car la page ne doit afficher que du Json. On empêche l'affichage du reste.
            require ROOT . 'src/memberspace/view/layouts/site.header.layout.php';   //récupère le header
        }


        $sFunction = 'handle' . ucfirst($sPage);    //va être utilisé pour appeler les fonctions privées du nom de handlePage(). ucfirst met la première lettre de $sPage en majuscule
        if (method_exists($this, $sFunction)) {     //si une fonction du type handlePage() existe, alors elle est exécutée
            $this->$sFunction();
        } else {
            $this->handleHome();                    //sinon c'est home qui est exécuté
        }

        if (!array_key_exists('type', $_GET)) {
            require ROOT . 'src/memberspace/view/layouts/site.footer.layout.php';
        }
    }

    /**
     * Affiche et gère les objets nécessaires sur la page d'accueil
     */
    private function handleHome()
    {
        if (array_key_exists('addfriend', $_POST)) {    //si l'utilisateur clique sur "Ajouter en ami", la fonction addFriend() est lancée
            $this->addFriend();
        }
        $bConnectError = false; //par défaut, pas de message d'erreur affiché. Cette variable est utilisée dans la view home.php
        if (array_key_exists('connexion', $_POST)) {    //si l'utilisateur clique sur "Se connecter", la fonction performConnection() est lancée
            $this->performConnection();
        } else {                                        //sinon (ce else sert à séparer la fonction "$this->performConnection();" de "require ROOT . 'src/memberspace/view/home.php';" puisqu'elle contient elle même un require vers cette page
            if (array_key_exists('login', $_SESSION)) { //si l'utilisateur est connecté
                $aUsers = UserManager::getNumberLimit(5);   //les 5 derniers utilisateurs triés par date sont récupérés
                $oLoggedUser = new User;                    //un nouvel objet User dans lequel on va définir l'id par $_SESSION['login'] est créé
                $oLoggedUser->setId($_SESSION['login']);
                $oLoggedUser = UserManager::get($oLoggedUser);  //le reste des informations concernant l'utilisateur sont récupérées
                $aFriends = FriendsManager::getAll($oLoggedUser);   //la liste de ses amis est récupérée
                $aFriendsId = array();
                foreach ($aFriends as $oFriend) {
                    $aFriendsId[] = $oFriend->getId();  //la liste des Id de ses amis est récupérée
                }
            } else {
                $aUsers = UserManager::getRandomNumberLimit(4); //si l'utilisateur n'est pas connecté, 4 utilisateurs aléatoires sont affichés
            }
            require ROOT . 'src/memberspace/view/home.php'; // dans les deux cas, la page home.php est affichée
        }

    }

    /**
     * Gère l'affichage de la page profile.php (à prononcer avec l'accent anglais !)
     * Cette page nest accessible que si l'utilisateur est connecté
     */
    private function handleProfile()
    {
        $oUser = new User;
        $oUser->setId($_SESSION['login']);
        $oUser = UserManager::get($oUser);  //les informations concernant l'utilisateur connecté sont récupérées.

        if (array_key_exists('newavatar', $_POST)) {    //si l'utilisateur décide de changer d'avatar
            $oUserAvatarChange = new User();
            $iNewAvatarId = addslashes($_POST['newavatar']);    //par sécurité des \ sont ajoutés pour éviter de dévier le $_POST
            $oUserAvatarChange->setAvatar($iNewAvatarId);   //le nouvel avatar est configuré en fonction de l'id du $_POST
            $oUserAvatarChange->setId($_SESSION['login']);
            UserManager::setNewAvatar($oUserAvatarChange);  //le changement vers la base de données est effectué
            header('location: index.php?page=profile'); //la page s'actualise afin d'afficher la nouvelle image
        }
        require ROOT . 'src/memberspace/view/profile.php';
    }

    /**
     * Gère l'affiche de la page member.php
     */
    private function handleMember()
    {
        if (array_key_exists('addfriend', $_POST)) {
            $this->addFriend();
        }
        if (array_key_exists('login', $_SESSION)) {
            $oUser = new User;
            $oUser->setId($_GET['id']);
            $oUser = UserManager::get($oUser);  //récupère les informations de la page du membre
            $oLoggedUser = new User;
            $oLoggedUser->setId($_SESSION['login']);
            $oLoggedUser = UserManager::get($oLoggedUser);
            $aFriends = FriendsManager::getAll($oLoggedUser);   //récupère les informations du membre connecté entrain de visualiser la page
            $aFriendsId = array();
            foreach ($aFriends as $oFriend) {
                $aFriendsId[] = $oFriend->getId();  //récupère les id des amis pour modifier l'affichage des boutons, si l'utilisateur connecté est déjà associé au membre affiché
            }
        } else {    //si l'utilisateur n'est pas connecté, alors une partie des informations sera cachée
            $oUser = new User;
            $oUser->setId($_GET['id']);
            $oUser = UserManager::get($oUser);
            $oUser->setLastName('*****');
            $oUser->setEmail('******************');
        }
        require ROOT . 'src/memberspace/view/member.php';
    }

    /**
     *Gère l'affiche de la page subscribe.php
     */
    private function handleSubscribe()
    {
        if (array_key_exists('subscribe', $_POST)) {    //si l'utilisateur a cliqué sur "S'inscrire"
            $this->performSubscription();   //la fonction locale performSubscription() est lancée
        } else {
            $bSubscribeError = false;
            require ROOT . 'src/memberspace/view/subscribe.php';
        }
    }

    /**
     * Gère le fonctionnement du moteur de recherche
     */
    private function handleSearch()
    {
        $aSearchedUsers = UserManager::search($_GET['mot']);    //lorsque des caractères sont entrés dans le champ de recherche, ils sont envoyés en GET
        if (array_key_exists('type', $_GET)) {
            require_once ROOT . 'inc/webapps/JsonSearch.php';   //ils sont récupérés en AJAX, renvoyés vers JsonSearch, qui effectuera le traitement de recherche
        } else {
            require ROOT . 'src/memberspace/view/home.php';
        }
    }

    /**
     * Lancée lorsque l'utilisateur clique sur "S'inscrire"
     */
    private function performSubscription()
    {
        $oUser = new User();    //la condition suivante vérifie si les champs ne sont pas vides, et si mdp et confirm mdp sont égaux
        if(($_POST['password'] !== $_POST['confirmPassword']) ||$_POST['email']=='' || $_POST['password']=='' || $_POST['confirmPassword']=='' || $_POST['lastname']=='' || $_POST['firstname']==''){
            $bSubscribeError = true;    //sinon un message d'erreur s'affichera sur subscribe.php
            require ROOT . 'src/memberspace/view/subscribe.php';
        }
        else{   //si les conditions sont correctes, un objet $oUser est créé, et la fonction subscribe du UserManager est lancée
            $oUser->setEmail($_POST['email']);
            $oUser->setPassword($_POST['password']);
            $oUser->setLastName($_POST['lastname']);
            $oUser->setFirstName($_POST['firstname']);
            $oUser->setAvatar('images/base_avatar.jpg');    //image par défaut
            $oUser->setGender($_POST['gender']);
            $oUser->setJob($_POST['job']);
            $oUser->setRegisterDate(date('Y-m-d H:i:s')); //formatage de l'heure d'inscription
            UserManager::subscribe($oUser);
            $this->handleHome();    //la page d'accueil est actualisée
        }
    }

    /**
     * Lancée lorsque l'utilisateur clique sur "Se connecter"
     */
    private function performConnection()
    {
        $oUser = new User();    //l'email et password sont récupérés dans un objet
        $oUser->setEmail($_POST['email']);
        $oUser->setPassword($_POST['password']);

        if (UserManager::connect($oUser)) { //l'objet est passé en argument de la fonction connect(). si la fonction renvoie true (a fonctionné), la page d'accueil est actualisée
            header('location: index.php');
        } else {    //sinon un message d'erreur s'affiche
            $bConnectError = true;
            $aUsers = UserManager::getRandomNumberLimit(4);
            require ROOT . 'src/memberspace/view/home.php';
        }
    }

    /**
     * Lancée lorsque l'utilisateur clique sur "Déconnecter"
     */
    private function handleLogout()
    {
        UserManager::logout(UserManager::getCurrent()); //la fonction déconnecter du UserManager est lancée
        header('location: index.php');
    }

    /**
     * Lancée lorsque l'utilisateur clique sur "Ajouter en ami"
     */
    private function addFriend()
    {
        $oUser = new User();
        $oUser->setId($_POST['addfriend']);
        $bNotYetFriends = FriendsManager::newFriend($oUser);    //lance la fonction qui établit la relation entre deux users en fonction de leur id respectif
        if ($bNotYetFriends) {
            echo "Ajouté avec succès";  //petit message de contrôle si la fonction a correction fonctionné
        } else {
            echo "Déjà amis !";
        }
    }

}
