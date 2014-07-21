<h3>Amis : <?= count($aFriends) ?></h3>  <!-- compte le nombre d'amis contenus dans $aFriends -->
<ul class="list-inline">
    <?php foreach ($aFriends as $oUser): ?>
        <li>
            <div class="row">
                <a href="index.php?page=member&id=<?= $oUser->getId() ?>"><img class="avatar"
                        src="<?= $oUser->getAvatar() ?>"
                        alt="<?= $oUser->getFirstName() ?><?= $oUser->getLastName() ?> "/>
                </a>
            </div>
            <div class="row">
                <?= $oUser->getFirstName() ?> <?= $oUser->getLastName() ?> : <?= $oUser->getJob() ?>
            </div>
        </li>
    <?php endforeach ?>
</ul>