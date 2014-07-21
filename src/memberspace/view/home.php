<div class="container">


    <?php if (!array_key_exists('login', $_SESSION)): ?> <!-- si l'utilisateur N'est PAS connecté -->

    <section class="row">
        <div class="col-md-5">
            <h2>Déjà membre ? <span class="text-muted">Connectez-vous</span></h2>
            <?php if ($bConnectError): ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                    <strong>Erreur!</strong> Impossible de vous connecter. Vérifier votre email et votre mot de passe.
                </div>
            <?php endif; ?>
            <form id="loginform" class="form-horizontal" action="" method="post" role="form">
                <div class="form-group">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Votre email"/>
                    <input type="password" name="password" id="password" class="form-control" placeholder="******"/>
                    <input type="hidden" name="connexion"/>
                    <button class="btn btn-primary" type="submit">Se connecter</button>
                </div>
            </form>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5">
            <h2><span class="text-muted">Qu'est ce qu'</span>espace membres ?</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At consectetur cupiditate delectus deleniti ex,
                illum labore laudantium officia.</p>
        </div>
    </section>

    <section class="row" id="subscribed_panel">
        <h2>Ils nous font <span class="text-muted">confiance</span></h2>
        <?php require ROOT . 'src/memberspace/view/layouts/site.randomsubscribed.layout.php'; ?> <!-- Récupère les données de site.randomsubscribed.layout.php -->

    </section>
        <h2>Connectez-vous et interagissez <span class="text-muted">entre membres !</span></h2>

        <div class="row">
            <div class="col-md-4">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, doloribus esse illum in laudantium
                    mollitia,
                    quae quo
                    rerum sapiente, vel vero voluptates? Amet harum, impedit minima porro repellat velit
                    voluptatibus!</p>
            </div>
            <div class="col-md-4">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores consectetur consequatur
                    consequuntur
                    deserunt
                    enim hic iusto, laboriosam non obcaecati pariatur reprehenderit totam! At dignissimos incidunt,
                    labore
                    nostrum quod
                    repellat sit.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi aspernatur assumenda
                    atque
                    aut
                    autem delectus
                    deserunt explicabo, facere ipsa, labore maxime minima, porro praesentium quasi quis sequi similique
                    temporibus voluptatum.</p>
            </div>
            <div class="col-md-4">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, doloribus esse illum in laudantium
                    mollitia,
                    quae quo
                    rerum sapiente, vel vero voluptates? Amet harum, impedit minima porro repellat velit
                    voluptatibus!</p>
            </div>
        </div>

    <?php else: ?> <!-- si l'utilisateur EST connecté -->

        <h2>Bienvenue <?php if ($oLoggedUser->getGender() == 'homme') {
                echo 'Monsieur ';
            } else {
                echo 'Madame ';
            }
            echo $oLoggedUser->getLastName() ?> </h2>

        <div class="row">
            <?php require ROOT . 'src/memberspace/view/layouts/site.friends.layout.php'; ?>
        </div>

        <div class="row">
            <?php require ROOT . 'src/memberspace/view/layouts/site.lastsubscribed.layout.php'; ?>
        </div>

    <?php endif; ?>


</div>
