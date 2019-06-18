<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Aides SmartDoc</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/contact.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/navigation.css">


</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md shadow-lg navigation-clean-button" style="background-color: #313437;">
        <div class="container"><a class="navbar-brand" href="#" style="color: #ffffff;">SmartDoc</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
                class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav mr-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="connexion.php" style="color: #ffffff;">Accueil</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="accueil_membre.php" style="color: #ffffff;">Vos documents</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="aides.php" style="color: #ffffff;">Aides</a></li>

                </ul><span class="navbar-text actions"> <a class="btn btn-light action-button" role="button" href="deconnexion.php">Déconnexion</a></span></div>
        </div>
    </nav>
    <div class="contact">
        <form class="shadow" method="post" style="border-radius: 20px 50px 20px 50px;">
            <h2 class="text-center">Contactez nous !</h2>
            <div class="form-group"><input class="form-control" type="text" name="nom" placeholder="Nom"></div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email"></div>
            <div class="form-group"><textarea class="form-control" name="message" placeholder="Message"></textarea></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Envoyer</button></div>
        </form>
    </div>

    <div class="footer">
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-6 offset-md-3 offset-lg-3 item text">
                        <h3>SmartDoc</h3>
                        <p>Jeune start-up, SmartDoc souhaite développer sa vison du stockage de document, accessible partout et sur tout support</p>
                    </div>
                </div>
                <p class="signature">Copyright SmartDoc © 2019</p>
            </div>
        </footer>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>