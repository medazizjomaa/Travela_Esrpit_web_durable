<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Travela - Nos Activités</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet"> 

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets1/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <style>
        :root {
            --primary: #3498db;
            --secondary: #2c3e50;
            --success: #2ecc71;
            --info: #17a2b8;
            --warning: #f39c12;
            --danger: #e74c3c;
        }
        
        .activity-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            position: relative;
            margin-bottom: 2rem;
            border: 1px solid #dee2e6;
            height: 100%;
        }

        .activity-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .card-type {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(135deg, var(--primary), #2980b9);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .activity-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--secondary);
            margin-bottom: 10px;
            line-height: 1.3;
        }

        .activity-description {
            color: #6c757d;
            line-height: 1.5;
            margin-bottom: 15px;
        }

        .activity-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .activity-info i {
            width: 20px;
            color: var(--primary);
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-upcoming {
            background: #c6f6d5;
            color: #22543d;
        }

        .status-ongoing {
            background: #bee3f8;
            color: #1a365d;
        }

        .status-past {
            background: #fed7d7;
            color: #742a2a;
        }

        .search-box {
            position: relative;
            margin-bottom: 2rem;
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 3;
        }

        .search-box input {
            padding-left: 45px;
            border-radius: 8px;
            border: 2px solid #dee2e6;
            height: 50px;
            font-size: 1rem;
        }

        .search-box input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .results-count {
            background: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            color: var(--secondary);
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border: 1px solid #dee2e6;
            margin-bottom: 1rem;
            display: inline-block;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            width: 100%;
        }

        .empty-state i {
            font-size: 4rem;
            color: #cbd5e0;
            margin-bottom: 20px;
        }

        .empty-state h3 {
            color: var(--secondary);
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #6c757d;
            margin-bottom: 20px;
        }

        .activity-item {
            display: block !important;
        }

        .read-more-btn {
            background: linear-gradient(135deg, var(--primary), #2980b9);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .read-more-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
            color: white;
        }

        .filters-row {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }

        .filter-group {
            margin-bottom: 1rem;
        }

        .filter-group label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--secondary);
        }

        .loading-spinner {
            text-align: center;
            padding: 40px;
        }

        .loading-spinner i {
            font-size: 2rem;
            color: var(--primary);
        }
    </style>
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
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="index.php" class="nav-item nav-link">Acceuil</a>
                    <a href="DestRes.php" class="nav-item nav-link">Destination & Reservation</a>
                    <a href="blog.php" class="nav-item nav-link active">Activites & Evenements</a>
                    <a href="impactEco.php" class="nav-item nav-link">Impact Ecologique</a>
                    <a href="testimonial.php" class="nav-item nav-link">Avis</a>
                    <a href="profil.php" class="nav-item nav-link">Mon Profil</a>
                    <a href="login_client.php" class="nav-item nav-link text-danger">Déconnexion</a>
                    
                </div>
            </div>
        </nav>

        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4">Nos activités et évènements</h3>
                <p class="text-white mb-0">Découvrez toutes nos activités durables et événements éco-responsables</p>
            </div>
        </div>
        <!-- Header End -->
    </div>

    <!-- Blog Start -->
    <div class="container-fluid blog py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h5 class="section-title px-3">Liste des activités & events à venir</h5>
         </div>

            <!-- Barre de recherche et filtres -->
            <div class="filters-row">
                <div class="row">
                    <div class="col-md-8">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" class="form-control" id="search" placeholder="Rechercher une activité par nom, description, lieu, responsable...">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="filter-group">
                            <label for="type-filter">Type</label>
                            <select class="form-select" id="type-filter">
                                <option value="all">Tous les types</option>
                                <option value="activité">Activités</option>
                                <option value="événement">Événements</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="filter-group">
                            <label for="status-filter">Statut</label>
                            <select class="form-select" id="status-filter">
                                <option value="all">Tous les statuts</option>
                                <option value="upcoming">À venir</option>
                                <option value="ongoing">En cours</option>
                                <option value="past">Passés</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Compteur de résultats -->
            <div class="text-center mb-4">
                <div class="results-count" id="results-count">
                    <i class="fas fa-spinner fa-spin me-2"></i>Chargement des activités...
                </div>
            </div>

            <!-- Container des activités -->
            <div class="row g-4" id="activities-container">
                <div class="col-12">
                    <div class="loading-spinner">
                        <i class="fas fa-spinner fa-spin"></i>
                        <p class="mt-2">Chargement des activités...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog End -->
<!-- Gallery Start -->
        <div class="container-fluid gallery py-5 my-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h5 class="section-title px-3">Notre Gallerie</h5>
                <h2 class="mb-4">Découvrez notre sélection d'activités éco-responsables et d'événements durables.</h2>
                
            </div>
            <div class="tab-class text-center">
                
                <div class="tab-content">
                    <div id="GalleryTab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-2">
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                                <div class="gallery-item h-100">
                                    <img src="/travela/mvc/views/frontOffice/img/1.jpg" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">Explorer</h5>
                                              
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="/travela/mvc/views/frontOffice/img/1.jpg" data-lightbox="gallery-1" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                <div class="gallery-item h-100">
                                    <img src="/travela/mvc/views/frontOffice/img/2.jpg" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">Explorer</h5>
                                              
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="/travela/mvc/views/frontOffice/img/2.jpg" data-lightbox="gallery-2" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                                <div class="gallery-item h-100">
                                    <img src="/travela/mvc/views/frontOffice/img/3.jpg" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">Explorer</h5>
                                              
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="/travela/mvc/views/frontOffice/img/3.jpg" data-lightbox="gallery-3" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                <div class="gallery-item h-100">
                                    <img src="/travela/mvc/views/frontOffice/img/4.jpg" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">Explorer</h5>
                                              
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="/travela/mvc/views/frontOffice/img/4.jpg" data-lightbox="gallery-4" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                                <div class="gallery-item h-100">
                                    <img src="/travela/mvc/views/frontOffice/img/5.jpg" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">Explorer</h5>
                                              
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="/travela/mvc/views/frontOffice/img/5.jpg" data-lightbox="gallery-5" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                                <div class="gallery-item h-100">
                                    <img src="/travela/mvc/views/frontOffice/img/6.jpg" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">Explorer</h5>
                                              
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="/travela/mvc/views/frontOffice/img/6.jpg" data-lightbox="gallery-6" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                <div class="gallery-item h-100">
                                    <img src="/travela/mvc/views/frontOffice/img/7.jpg" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">Explorer</h5>
                                              
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="/travela/mvc/views/frontOffice/img/7.jpg" data-lightbox="gallery-7" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-2">
                                <div class="gallery-item h-100">
                                    <img src="/travela/mvc/views/frontOffice/img/8.jpg" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">Explorer</h5>
                                              
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="/travela/mvc/views/frontOffice/img/8.jpg" data-lightbox="gallery-8" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                <div class="gallery-item h-100">
                                    <img src="/travela/mvc/views/frontOffice/img/9.jpg" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">Explorer</h5>
                                              
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="/travela/mvc/views/frontOffice/img/9.jpg" data-lightbox="gallery-9" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-2">
                                <div class="gallery-item h-100">
                                    <img src="/travela/mvc/views/frontOffice/img/10.jpg" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">Explorer</h5>
                                              
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="/travela/mvc/views/frontOffice/img/10.jpg" data-lightbox="gallery-10" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="GalleryTab-2" class="tab-pane fade show p-0">
                        <div class="row g-2">
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                <div class="gallery-item h-100">
                                    <img src="/travela/mvc/views/frontOffice/img/gallery-2.jpg" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">Explorer</h5>
                                              
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="/travela/mvc/views/frontOffice/img/gallery-2.jpg" data-lightbox="gallery-2" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                                <div class="gallery-item h-100">
                                    <img src="/travela/mvc/views/frontOffice/img/gallery-3.jpg" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">Explorer</h5>
                                              
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="/travela/mvc/views/frontOffice/img/gallery-3.jpg" data-lightbox="gallery-3" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="GalleryTab-3" class="tab-pane fade show p-0">
                        <div class="row g-2">
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                <div class="gallery-item h-100">
                                    <img src="/travela/mvc/views/frontOffice/img/gallery-2.jpg" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">Explorer</h5>
                                              
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="/travela/mvc/views/frontOffice/img/gallery-2.jpg" data-lightbox="gallery-2" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                                <div class="gallery-item h-100">
                                    <img src="/travela/mvc/views/frontOffice/img/gallery-3.jpg" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">Explorer</h5>
                                              
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="/travela/mvc/views/frontOffice/img/gallery-3.jpg" data-lightbox="gallery-3" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="GalleryTab-4" class="tab-pane fade show p-0">
                        <div class="row g-2">
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                <div class="gallery-item h-100">
                                    <img src="/travela/mvc/views/frontOffice/img/gallery-2.jpg" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">Explorer</h5>
                                              
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="/travela/mvc/views/frontOffice/img/gallery-2.jpg" data-lightbox="gallery-2" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                                <div class="gallery-item h-100">
                                    <img src="/travela/mvc/views/frontOffice/img/gallery-3.jpg" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">Explorer</h5>
                                              
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="/travela/mvc/views/frontOffice/img/gallery-3.jpg" data-lightbox="gallery-3" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="GalleryTab-5" class="tab-pane fade show p-0">
                        <div class="row g-2">
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                <div class="gallery-item h-100">
                                    <img src="/travela/mvc/views/frontOffice/img/gallery-2.jpg" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">Explorer</h5>
                                              
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="/travela/mvc/views/frontOffice/img/gallery-2.jpg" data-lightbox="gallery-2" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                                <div class="gallery-item h-100">
                                    <img src="/travela/mvc/views/frontOffice/img/gallery-3.jpg" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">Explorer</h5>
                                              
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="/travela/mvc/views/frontOffice/img/gallery-3.jpg" data-lightbox="gallery-3" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Gallery End -->
    <!-- Copyright Start -->
    <div class="container-fluid copyright text-body py-4">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-6 text-center text-md-end mb-md-0">
                    <i class="fas fa-copyright me-2"></i><a class="text-white" href="#">Travela</a>, All right reserved.
                </div>
                <div class="col-md-6 text-center text-md-start">
                    Designed By <a class="text-white" href="#">Travela Team</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->

    <!-- Back to Top -->
        

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <script>
        // Variables globales
        let toutesLesActivites = [];

        // Chargement des activités au démarrage
        document.addEventListener('DOMContentLoaded', function() {
            chargerActivites();
            
            // Événements de recherche et filtres
            document.getElementById('search').addEventListener('input', filterActivities);
            document.getElementById('type-filter').addEventListener('change', filterActivities);
            document.getElementById('status-filter').addEventListener('change', filterActivities);
        });

        function chargerActivites() {
            fetch('api/activites.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erreur réseau: ' + response.status);
                    }
                    return response.json();
                })
                .then(activites => {
                    toutesLesActivites = activites;
                    afficherActivites(activites);
                    filterActivities(); // Appliquer le filtrage initial
                })
                .catch(error => {
                    console.error('Erreur lors du chargement des activités:', error);
                    document.getElementById('activities-container').innerHTML = `
                        <div class="col-12">
                            <div class="empty-state">
                                <i class="fas fa-exclamation-triangle"></i>
                                <h3>Erreur de chargement</h3>
                                <p>Impossible de charger les activités. Veuillez réessayer plus tard.</p>
                                <button class="btn btn-primary" onclick="chargerActivites()">
                                    <i class="fas fa-redo me-2"></i>
                                    Réessayer
                                </button>
                            </div>
                        </div>
                    `;
                    document.getElementById('results-count').textContent = 'Erreur de chargement';
                });
        }

        function afficherActivites(activites) {
            const container = document.getElementById('activities-container');
            
            if (activites.length === 0) {
                container.innerHTML = `
                    <div class="col-12">
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <h3>Aucune activité trouvée</h3>
                            <p>Aucune activité n'est disponible pour le moment.</p>
                        </div>
                    </div>
                `;
                return;
            }

            let html = '';
            activites.forEach(activite => {
                const status = getStatus(activite.date_debut, activite.date_fin);
                const description = activite.description && activite.description.length > 120 ? 
                    activite.description.substring(0, 120) + '...' : activite.description;

                html += `
                    <div class="col-lg-4 col-md-6 activity-item">
                        <div class="activity-card" data-type="${activite.type}" data-status="${status}">
                            <div class="card-body p-4">
                                <div class="card-type">${activite.type}</div>
                                <h5 class="activity-title">${escapeHtml(activite.nom)}</h5>
                                <p class="activity-description">${escapeHtml(description || 'Aucune description disponible')}</p>
                                
                                <div class="activity-info">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>${escapeHtml(activite.lieu)}</span>
                                </div>
                                <div class="activity-info">
                                    <i class="fas fa-user"></i>
                                    <span>${escapeHtml(activite.responsable)}</span>
                                </div>
                                <div class="activity-info">
                                    <i class="fas fa-calendar-day"></i>
                                    <span>Début: ${formatDate(activite.date_debut)}</span>
                                </div>
                                <div class="activity-info">
                                    <i class="fas fa-calendar-check"></i>
                                    <span>Fin: ${formatDate(activite.date_fin)}</span>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="status-badge ${getStatusClass(status)}">
                                        <i class="fas ${getStatusIcon(status)} me-1"></i>
                                        ${getStatusText(status)}
                                    </span>
                                    <a href="#" class="read-more-btn" onclick="afficherDetails(${activite.id}, event)">
                                        <i class="fas fa-eye me-1"></i>Voir plus
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });

            container.innerHTML = html;
        }

        function filterActivities() {
            const searchTerm = document.getElementById('search').value.toLowerCase();
            const typeValue = document.getElementById('type-filter').value;
            const statusValue = document.getElementById('status-filter').value;

            const activitesFiltrees = toutesLesActivites.filter(activite => {
                const status = getStatus(activite.date_debut, activite.date_fin);
                
                // Recherche texte
                const matchesSearch = !searchTerm || 
                    activite.nom.toLowerCase().includes(searchTerm) || 
                    (activite.description && activite.description.toLowerCase().includes(searchTerm)) ||
                    activite.lieu.toLowerCase().includes(searchTerm) ||
                    activite.responsable.toLowerCase().includes(searchTerm);

                // Filtre type
                const matchesType = typeValue === 'all' || activite.type === typeValue;
                
                // Filtre statut
                const matchesStatus = statusValue === 'all' || status === statusValue;

                return matchesSearch && matchesType && matchesStatus;
            });

            afficherActivites(activitesFiltrees);
            
            // Mettre à jour le compteur
            document.getElementById('results-count').textContent = 
                `${activitesFiltrees.length} activité(s) trouvée(s)`;
        }

        function afficherDetails(id, event) {
            if (event) event.preventDefault();
            
            // Trouver l'activité
            const activite = toutesLesActivites.find(a => a.id === id);
            if (!activite) return;

            // Créer un modal avec les détails complets
            const modalHtml = `
                <div class="modal fade" id="activityModal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">${escapeHtml(activite.nom)}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p><strong>Description:</strong> ${escapeHtml(activite.description || 'Aucune description disponible')}</p>
                                        <p><strong>Type:</strong> ${escapeHtml(activite.type)}</p>
                                        <p><strong>Lieu:</strong> ${escapeHtml(activite.lieu)}</p>
                                        <p><strong>Responsable:</strong> ${escapeHtml(activite.responsable)}</p>
                                        <p><strong>Date de début:</strong> ${formatDate(activite.date_debut)}</p>
                                        <p><strong>Date de fin:</strong> ${formatDate(activite.date_fin)}</p>
                                        <p><strong>Statut:</strong> <span class="status-badge ${getStatusClass(getStatus(activite.date_debut, activite.date_fin))}">
                                            ${getStatusText(getStatus(activite.date_debut, activite.date_fin))}
                                        </span></p>
                                    </div>
                                    <div class="col-md-4">
                                        ${activite.image_url ? `<img src="${activite.image_url}" class="img-fluid rounded" alt="${escapeHtml(activite.nom)}">` : ''}
                                    </div>
                                </div>
                                ${activite.video_url ? `
                                <div class="mt-3">
                                    <strong>Vidéo:</strong>
                                    <div class="ratio ratio-16x9">
                                        <iframe src="${activite.video_url}" allowfullscreen></iframe>
                                    </div>
                                </div>
                                ` : ''}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            // Ajouter le modal au DOM et l'afficher
            document.body.insertAdjacentHTML('beforeend', modalHtml);
            const modal = new bootstrap.Modal(document.getElementById('activityModal'));
            modal.show();
            
            // Nettoyer le modal après fermeture
            document.getElementById('activityModal').addEventListener('hidden.bs.modal', function () {
                this.remove();
            });
        }

        // Fonctions utilitaires
        function getStatus(dateDebut, dateFin) {
            const now = new Date();
            const debut = new Date(dateDebut);
            const fin = new Date(dateFin);

            if (debut > now) return 'upcoming';
            if (debut <= now && fin >= now) return 'ongoing';
            return 'past';
        }

        function getStatusClass(status) {
            const classes = {
                'upcoming': 'status-upcoming',
                'ongoing': 'status-ongoing',
                'past': 'status-past'
            };
            return classes[status] || 'status-upcoming';
        }

        function getStatusIcon(status) {
            const icons = {
                'upcoming': 'fa-clock',
                'ongoing': 'fa-play-circle',
                'past': 'fa-check-circle'
            };
            return icons[status] || 'fa-clock';
        }

        function getStatusText(status) {
            const texts = {
                'upcoming': 'À venir',
                'ongoing': 'En cours',
                'past': 'Terminé'
            };
            return texts[status] || 'À venir';
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('fr-FR', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        function escapeHtml(unsafe) {
            if (!unsafe) return '';
            return unsafe
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }
    </script>


        <!-- Bouton Chatbot -->
<button id="chatbot-btn" class="btn btn-primary btn-lg " 
        style="position: fixed; bottom: 25px; right: 25px; z-index: 1000;">
    <i class="fa-solid fa-robot"></i>
</button>

<!-- Fenêtre du Chatbot (contenu directement intégré, pas d'iframe) -->
<div id="chatbot-window" 
     style="display:none; position: fixed; bottom: 90px; right: 25px; width: 380px; height: 520px; 
            background: white; border-radius: 15px; box-shadow: 0 0 20px rgba(0,0,0,0.3); 
            z-index: 1001; overflow: hidden;">

  <div style="background:#007bff; color:white; padding:10px; text-align:center; font-weight:bold;">
      Travela Chatbot
      <button id="close-chatbot" style="float:right; background:none; border:none; color:white; font-size:16px; cursor:pointer;">✕</button>
  </div>

  <div id="chat-body" style="padding:10px; height:370px; overflow-y:auto; font-size:14px;"></div>

  <div style="display:flex; padding:10px; border-top:1px solid #ddd;">
      <input type="text" id="user-input" placeholder="Écrivez ici..." 
             style="flex:1; padding:8px; font-size:14px; border:1px solid #ccc; border-radius:5px;">
      <button id="send-btn" 
              style="background-color:#007bff; color:white; border:none; padding:8px 12px; margin-left:5px; border-radius:5px; cursor:pointer;">
              Envoyer
      </button>
  </div>
</div>

<script>
const chatbotBtn = document.getElementById("chatbot-btn");
const chatbotWindow = document.getElementById("chatbot-window");
const closeChatbot = document.getElementById("close-chatbot");
const chatBody = document.getElementById('chat-body');
const userInput = document.getElementById('user-input');
const sendBtn = document.getElementById('send-btn');

// ouvrir / fermer le chatbot
chatbotBtn.addEventListener("click", () => {
  chatbotWindow.style.display = "block";
});
closeChatbot.addEventListener("click", () => {
  chatbotWindow.style.display = "none";
});

// Réponses automatiques
const responses = {
  "bonjour": "Bonjour 👋! Comment puis-je vous aider aujourd’hui ?",
  "réservation": "Pour vos réservations, consultez la section 'Destination & Reservation'.",
  "calculer impact":"pour calculer l'impact de votre voyage remplir le formulaire dans la section impact ecologique",
  "profil": "Vous pouvez gérer votre profil depuis votre page personnelle.",
  "avis":"si vous voulez ajouter votre avis consulter la page avis",
  "merci": "Avec plaisir 😊!",
  "aide": "Je peux répondre à vos questions sur Travela, les réservations ou le profil."
};

function addMessage(sender, text) {
  const msg = document.createElement('div');
  msg.style.marginBottom = '10px';
  msg.innerHTML = `<b style="color:${sender === 'user' ? '#333' : '#13357B80'}">${sender === 'user' ? 'Vous' : 'TravelaBot'} :</b> ${text}`;
  chatBody.appendChild(msg);
  chatBody.scrollTop = chatBody.scrollHeight;
}

function sendMessage() {
  const text = userInput.value.trim();
  if (text === "") return;

  addMessage('user', text);
  userInput.value = "";

  const reply = responses[text.toLowerCase()] || "Désolé 😅, je ne comprends pas encore cette question.";
  setTimeout(() => addMessage('bot', reply), 500);
}

sendBtn.addEventListener('click', sendMessage);
userInput.addEventListener('keypress', (e) => {
  if (e.key === 'Enter') sendMessage();
});
</script>
</body>

</html>