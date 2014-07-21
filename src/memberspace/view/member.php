<div class="container">

        <dl class="dl-horizontal">
            <dt>Prénom</dt><dd><?= $oUser->getFirstName() ?></dd>
            <dt>Nom</dt><dd><?= $oUser->getLastName() ?></dd>
            <dt>eMail</dt><dd><?= $oUser->getEmail() ?></dd>
            <dt>Profession</dt><dd><?= $oUser->getJob() ?></dd>
        </dl>



    <?php if (array_key_exists('login',$_SESSION) && $oUser->getId()!= $_SESSION['login'] ) :?> <!-- si l'utilisateur EST connecté, et que son id est différent de celui du membre dont la page est actuellement affichée. Donc s'il ne s'agit pas de sa propre page -->

        <?php if(!in_array($oUser->getId(),$aFriendsId)) : ?>   <!-- S'il ne s'agit PAS d'un ami de l'utilisateur connecté -->

                <form action="" method="post" style="display:inline-block;">
                    <button class="btn btn-info">Ajouter en ami</button>
                    <input type="hidden" name="addfriend" value="<?= $oUser->getId() ?>"/>
                </form>

        <?php else : ?> <!-- S'il s'agit déjà d'un ami -->

            <button class="btn btn-success">Déjà amis !</button>

        <?php endif; ?>

    <?php elseif(!array_key_exists('login',$_SESSION)) : ?> <!-- Si l'utilisateur N'est PAS connecté -->

        <div class="row">
            Pour avoir accès aux informations <a href="index.php?page=login"><button  class="btn btn-info">Inscrivez-vous </button></a> ou
            <a href="index.php"><button  class="btn btn-primary">Connectez-vous !</button></a>
        </div>

    <?php endif; ?>


<a href="index.php"><button class="btn btn-warning">Retour</button></a>
</div>