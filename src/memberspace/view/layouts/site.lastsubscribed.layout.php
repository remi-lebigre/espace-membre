<h3>Derniers inscrits : <?= count($aUsers) ?></h3>
<ul class="list-inline">

    <?php foreach ($aUsers as $oUser): ?> <!-- Pour chaque objet utilisateur du tableau $aUsers-->

        <?php if ($_SESSION['login'] != $oUser->getId()) : ?> <!-- S'il ne s'agit pas de l'utilisateur connecté (si l'id de l'objet ne correspond pas à celui contenu dans $_SESSION -->

            <li>
                    <a href="index.php?page=member&id=<?= $oUser->getId() ?>">
                        <img class="avatar" src="<?= $oUser->getAvatar() ?>"
                             alt="<?= $oUser->getFirstName() ?><?= $oUser->getLastName() ?> "/>
                    </a>
                <div class="row">
                    <p>Le <?= substr($oUser->getRegisterDate(), 0, 11) ?> à <?= substr($oUser->getRegisterDate(), 11, 2) ?>h : <?= $oUser->getJob() ?></p> <!-- substr() pour couper l'affichage de la date, sans minutes et secondes -->
                </div>

                <?php if(!in_array($oUser->getId(),$aFriendsId)) : ?> <!-- S'il ne s'agit pas d'un ami de l'utilisateur connecté -->

                <div class="row">
                    <form action="" method="post">
                        <button class="btn btn-info">Ajouter en ami</button>
                        <input type="hidden" name="addfriend" value="<?= $oUser->getId() ?>"/>
                    </form>
                </div>

                <?php else : ?>

                    <button class="btn btn-success">Déjà amis !</button>

                <?php endif; ?>

            </li>

        <?php else : ?> <!-- S'il s'agit de l'utilisateur connecté -->

            <li>
                <div class="row">
                    <a href="index.php?page=member&id=<?= $oUser->getId() ?>">
                        <img class="avatar" src="<?= $oUser->getAvatar() ?>"
                             alt="<?= $oUser->getFirstName() ?><?= $oUser->getLastName() ?> "/>
                    </a>
                </div>
                <div class="row">
                    <p>Le <?= substr($oUser->getRegisterDate(), 0, 11) ?> à <?= substr($oUser->getRegisterDate(), 11, 2) ?>h : Vous-même !</p>
                </div>
            </li>

        <?php endif; ?>

    <?php endforeach; ?>

</ul>