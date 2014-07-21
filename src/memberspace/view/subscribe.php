<div class="container">
<h2>Inscrivez-vous</h2>

    <?php if ($bSubscribeError): ?> <!-- si les chapms du formulaire d'inscription ne sont pas tous remplis -->

        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span
                    class="sr-only">Close</span></button>
            <strong>Erreur!</strong> Vous n'avez pas correctement rempli tous les champs requis.
        </div>

    <?php endif; ?>

<form class="form-horizontal" id="subscribeform" action="index.php?page=subscribe" method="post"role="form">
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Nom</label>

        <div class="col-sm-10">
            <input type="text" class="form-control" name="lastname" id="name" placeholder="Nom"/>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">Prénom</label>

        <div class="col-sm-10">
            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Prénom"/>
        </div>
    </div>
    <div class="form-group">
        <label for="email" class="col-sm-2 control-label">Email</label>

        <div class="col-sm-10">
            <input type="email" class="form-control" name="email" id="email"
                   placeholder="Votre email servira de login !">
        </div>
    </div>
    <div class="form-group">
        <label for="password" class="col-sm-2 control-label">Mot de passe</label>

        <div class="col-sm-10">
            <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe">
        </div>
    </div>
    <div class="form-group">
        <label for="password" class="col-sm-2 control-label">Confirmer le Mot de passe </label>

        <div class="col-sm-10">
            <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirmez le mot de passe">
        </div>
    </div>

    <div class="form-group row">
        <label for="select" class="col-sm-2 control-label">Job</label>

        <select id="select" class="form-control-static col-sm-10" name="job">
        <option>WebDesigner</option>
        <option>Architecte</option>
        <option>Artisan</option>
        <option>Consultant</option>
        <option>Enseignant</option>
    </select>
        </div>

    <div class="form-group">
        <label for="radio" class="col-sm-2 control-label">Genre</label>

        <label class="checkbox-inline">
            <input type="radio" name="gender" id="homme" value="homme" checked>
            Homme
        </label>
        <label class="checkbox-inline">
            <input type="radio" name="gender" id="femme" value="femme">
            Femme </label>
    </div>

    <input type="hidden" name="subscribe"/>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary" >S'inscrire</button>
        </div>
    </div>
</form></div>
