<nav class="navbar navbar-default" role="navigation">

    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Espace membres</a>
        </div>

        <ul class="nav navbar-nav ">
            <li><a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-home"></span>Accueil</a></li>

            <?php if (!array_key_exists('login', $_SESSION)): ?>    <!-- si l'utilisateur n'est PAS connecté -->

                <li><a class="navbar-brand" href="index.php?page=subscribe"><span class="glyphicon glyphicon-user"></span>S'enregistrer</a>
                </li>

            <?php else : ?> <!-- si l'utilisateur EST connecté -->

                <li><a class="navbar-brand" href="index.php?page=profile"><span class="glyphicon glyphicon-user"></span>Mon
                        profil</a></li>
                <li>
                    <a href="index.php?page=logout">
                        <button class="btn btn-warning">Déconnecter</button>
                    </a>
                </li>

            <?php endif; ?>

        </ul>

        <?php if (array_key_exists('login', $_SESSION)): ?> <!-- si l'utilisateur EST connecté -->

            <form id="searchform" class="navbar-form navbar-right" action="index.php" method="get" role="search">
                <div class="form-group">
                    <input type="hidden" name="page" value="search"/>
                    <input type="text" name="mot" id="search" class="form-control"
                           placeholder="Recherche d'utilisateurs..."/>
                    <button class="btn btn-primary" type="submit">Chercher</button>
                </div>
            </form>

        <?php endif; ?>

    </div>

</nav>

