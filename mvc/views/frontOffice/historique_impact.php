<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Travela - Tourism Website Template</title>
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="/travela/mvc/views/frontOffice/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="/travela/mvc/views/frontOffice/lib/lightbox/css/lightbox.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="/travela/mvc/views/frontOffice/css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="/travela/mvc/views/frontOffice/css/style.css" rel="stylesheet">
    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        
         <!-- Navbar & Hero Start -->
        <div class="container-fluid position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="m-0"><i class="fa fa-map-marker-alt me-3"></i>Travela</h1>
                    <!-- <img src="/travela/mvc/views/frontOffice/img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="/travela/mvc/views/frontOffice/index.html" class="nav-item nav-link ">Acceuil</a>
                        <a href="/travela/mvc/views/frontOffice/destination.php" class="nav-item nav-link">Destination & Reservation</a>
                        <a href="/travela/mvc/views/frontOffice/blog.html" class="nav-item nav-link">Activites & Evenements</a>
                        <a href=" /travela/mvc/views/frontOffice/formulaire_impact.php" class="nav-item nav-link active">Impact Ecologique</a>
                        <a href="/travela/mvc/views/frontOffice/testimonial.php" class="nav-item nav-link">Avis</a>
                        <a href="/travela/mvc/views/frontOffice/profil.php" class="nav-item nav-link">Mon Profil</a>
                        <a href="login_client.php" class="nav-item nav-link">login</a>
                    </div>
                </div>
            </nav>

        <!-- Header Start -->
        <div class="container-fluid bg-eco">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4">Impact Ecologique</h1>
                 
            </div>
        </div>
        <!-- Header End -->
        
        <!-- Services Start -->
      <div class="impact-history-container">
    <h2>📜 Historique des calculs d'impact</h2>
    <table class="impact-history-table">
        <tr>
            <th>Date</th>
            <th>Transport</th>
            <th>Distance (km)</th>
            <th>Voyageurs</th>
            <th>Hébergement</th>
            <th>CO₂ (kg)</th>
        </tr>
        <?php foreach($historique as $item): ?>
        <tr>
            <td><?= htmlspecialchars($item['DATE_CALCUL']) ?></td>
            <td><?= htmlspecialchars($item['TRANSPORT']) ?></td>
            <td><?= htmlspecialchars($item['DISTANCE']) ?></td>
            <td><?= htmlspecialchars($item['VOYAGEURS']) ?></td>
            <td><?= htmlspecialchars($item['HEBERGEMENT']) ?></td>
            <td><?= htmlspecialchars($item['CO2_TOTAL']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="../controllers/index.php?action=formulaire" class="impact-btn">⬅️ Nouveau calcul</a>
</div>


        <!-- Services End -->

         
        
        <!-- Copyright Start -->
        <div class="container-fluid copyright text-body py-4">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6 text-center text-md-end mb-md-0">
                        <i class="fas fa-copyright me-2"></i><a class="text-white" href="#">Your Site Name</a>, All right reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-start">
                        <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                        <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                        <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                        Designed By <a class="text-white" href="https://htmlcodex.com">HTML Codex</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>
        

        <!-- Template Javascript -->
        <script src="/travela/mvc/views/frontOffice/js/main.js"></script>
    </body>

</html>