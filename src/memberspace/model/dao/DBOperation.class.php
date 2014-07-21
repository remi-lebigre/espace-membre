<?php  namespace memberspace\model\dao;

    /**
     * Class DBOperation.
     * DataBase operation.
     *
     * @package ecommerce\db
     */
    class DBOperation
    {
        const HOST = 'localhost';   //ces 4 constantes sont utilisées dans init() pour définir où l'extension PHP Data Objects se connecte
        const USER = 'root';
        const PWD = '';
        const NAME = 'memberspace';

        /**
         * @var \PDO database.
         */
        private static $oDataBase = null;

        /**
         * Initialise la connection à la base de données
         */
        private static function init()
        {
            if (null === self::$oDataBase) {
                self::$oDataBase = new \PDO('mysql:host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PWD);
                self::$oDataBase->exec("SET CHARACTER SET utf8");
                self::$oDataBase->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            }
        }

        /**
         * Récupère les résultats d'un query
         * @param $sQuery query à exécuter
         * @return array de tous les résultats
         */
        public static function getAll($sQuery)
        {
            self::init();
            try {   //récupère des données dans la base selon la requête passée en argument
                $aAll = array();
                foreach (self::$oDataBase->query($sQuery) as $aRow) {
                    $aAll[] = $aRow;
                }
            } catch (\PDOException $oPdoException) {    //si la requête n'a pas abouti, un message d'erreur est renvoyé
                echo 'PDO Exception : ' . $oPdoException->getMessage();
            }
            return $aAll;
        }

        /**
         * Récupère une ligne d'un query
         * @param $sQuery query à exécuter
         * @return array de la ligne
         */
        public static function getOne($sQuery)
        {
            self::init();
            try {
                $oQueryResult = self::$oDataBase->query($sQuery);
                $aRow = $oQueryResult->fetch();
            } catch (PDOException $oPdoException) {
                echo 'PDO Exception : ' . $oPdoException->getMessage();
            }
            return $aRow;
        }

        /**
         *exécute un query
         * @param $sQuery query à exécuter
         * @return bool true si opération réussie, sinon false
         */
        public static function exec($sQuery)
        {
            self::init();
            try {
                $iAffectedRows = self::$oDataBase->exec($sQuery);
            } catch (PDOException $oPdoException) {
                echo 'PDO Exception : ' . $oPdoException->getMessage();
            }
            return false !== $iAffectedRows;
        }
    }