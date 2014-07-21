<div class="row">

    <?php foreach ($aUsers as $oUser): ?> <!-- Pour chaque objet utilisateur du tableau $aUsers-->

        <div class="col-md-3">
                <a href="index.php?page=member&id=<?= $oUser->getId() ?>">
                    <img class="avatar" src="<?= $oUser->getAvatar() ?>"
                         alt="<?= $oUser->getFirstName() ?><?= $oUser->getLastName() ?> "/>
                </a>
                <div class="row">
                    Le <?= substr($oUser->getRegisterDate(), 0, 11) ?> à <?= substr($oUser->getRegisterDate(), 11, 2) ?>h : <?= $oUser->getJob() ?>
                </div>
        </div>

    <?php endforeach; ?>

</div>