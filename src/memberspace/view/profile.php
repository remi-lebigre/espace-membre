<div class="container">
    <h2>Mon profil</h2>
<div class="row">
    <div class="col-md-6">
    <dl class="dl-horizontal">
        <dt>Nom</dt>
        <dd><?= $oUser->getFirstName(); ?></dd>
        <dt>Prénom</dt>
        <dd><?= $oUser->getLastName(); ?></dd>
        <dt>Email</dt>
        <dd><?= $oUser->getEmail(); ?></dd>
        <dt>Job</dt>
        <dd><?= $oUser->getJob(); ?></dd>
    </dl>
    </div>
    <div class="col-md-6">
        <img class="avatar" src="<?= $oUser->getAvatar() ?>" alt="<?= $oUser->getFirstName(); ?> <?= $oUser->getLastName(); ?>"/>
    </div>
</div>


<h2>Changer d'avatar</h2>

            <ul class="list-inline">
                <li>
                    <a href="#" class="newavatar"><img class="avatar" src="images/<?php if($oUser->getGender()=='homme'){echo"m";}else{echo"f";} ?>1.jpg" alt="f1"/></option></a>
                </li>
                <li>
                    <a href="#" class="newavatar"><img class="avatar" src="images/<?php if($oUser->getGender()=='homme'){echo"m";}else{echo"f";} ?>2.jpg" alt="f1"/></option></a>
                </li>
                <li>
                    <a href="#" class="newavatar"><img class="avatar" src="images/<?php if($oUser->getGender()=='homme'){echo"m";}else{echo"f";} ?>3.jpg" alt="f1"/></option></a>
                </li>
                <li>
                    <a href="#" class="newavatar"><img class="avatar" src="images/base_avatar.jpg" alt="f1"/></option></a>
                </li>
            </ul>


    <form id="newavatarform" action="" method="post">   <!-- l'attribut value="" de ce form est généré via le script.js, selon l'image sur laquelle l'utilisteur va cliquer-->
        <input id="newavatar" type="hidden" name="newavatar"/>
       <button type="submit" class="btn btn-info">Changer</button>
    </form>



</div>