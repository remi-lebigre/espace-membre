<?php namespace memberspace\model;


    class User
    {
        //setters et getters servent à récupérer les variables privées ci-dessous. setters pour changer leur valeurs, getters pour les récupérer.
        private $sEmail;
        private $sGender;
        private $sLastName;
        private $sFirstName;
        private $sPassword;
        private $sJob;
        private $sRegisterDate;
        private $sAvatar;
        private $iId;

        /**
         * @param $sEmail
         */
        public function setEmail($sEmail)
        {
            $this->sEmail = $sEmail;
        }

        /**
         * @return mixed
         */
        public function getEmail()
        {
            return $this->sEmail;
        }

        /**
         * @param $sAvatar
         */
        public function setAvatar($sAvatar)
        {
            $this->sAvatar = addslashes($sAvatar);  //les addslashes sont placés par sécurité, pour ne pas détourner le formulaire d'inscription
        }

        /**
         * @return mixed
         */
        public function getAvatar()
        {
            return $this->sAvatar;
        }

        /**
         * @param $sFirstName
         */
        public function setFirstName($sFirstName)
        {
            $this->sFirstName = ucfirst(addslashes($sFirstName));
        }

        /**
         * @return mixed
         */
        public function getFirstName()
        {
            return $this->sFirstName;
        }

        /**
         * @param $sGender
         */
        public function setGender($sGender)
        {
            $this->sGender = addslashes($sGender);
        }

        /**
         * @return mixed
         */
        public function getGender()
        {
            return $this->sGender;
        }

        /**
         * @param $sJob
         */
        public function setJob($sJob)
        {
            $this->sJob = addslashes($sJob);
        }

        /**
         * @return mixed
         */
        public function getJob()
        {
            return $this->sJob;
        }

        /**
         * @param $sLastName
         */
        public function setLastName($sLastName)
        {
            $this->sLastName = ucfirst(addslashes($sLastName));
        }

        /**
         * @return mixed
         */
        public function getLastName()
        {
            return $this->sLastName;
        }

        /**
         * @param $sPassword
         */
        public function setPassword($sPassword)
        {
            $this->sPassword = addslashes($sPassword);
        }

        /**
         * @return mixed
         */
        public function getPassword()
        {
            return $this->sPassword;
        }

        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->iId;
        }

        /**
         * @return mixed
         */
        public function setId($iId)
        {
            $this->iId = $iId;
        }

        /**
         * @param $sRegisterDate
         */
        public function setRegisterDate($sRegisterDate)
        {
            $this->sRegisterDate = $sRegisterDate;
        }

        /**
         * @return mixed
         */
        public function getRegisterDate()
        {
            return $this->sRegisterDate;
        }

        /**
         * Renvoie le mot de passe crypté
         * @return string
         */
        public function getCryptedPassword()
        {
            return sha1($this->getPassword());
        }

        /**
         * Renvoie le lien de l'url selon l'id de l'objet User créé
         * @return string
         */
        public function getLink()
        {
            return 'index.php?page=member&id=' . $this->getId();
        }
    }