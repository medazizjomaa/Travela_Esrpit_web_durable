<!DOCTYPE html>
<?php
session_start(); // ✅ Only call session_start once at the top

// Get the new destination if it exists
$newDestCard = '';
if(isset($_SESSION['new_destination'])) {
    $newDest = $_SESSION['new_destination'];

    $newDestCard = [
        'name' => $newDest['name'],
        'price' => $newDest['price'],
        'image' => $newDest['image']
    ];

    unset($_SESSION['new_destination']); // show only once
}

// Existing destinations (could also come from session/db)
$allDestinations = $_SESSION['destinations'] ?? [
    ['name'=>'Sidi Bou Said','price'=>500,'image'=>'sidibousaid2.jpg'],
    ['name'=>'Sousse','price'=>300,'image'=>'sousse.png'],
    ['name'=>'Touzer','price'=>300,'image'=>'touzer.jpg'],
    ['name'=>'Mahdia','price'=>320,'image'=>'mahdia.jpg'],
    ['name'=>'Tunis','price'=>400,'image'=>'touni.jpg'],
    ['name'=>'Djerba','price'=>430,'image'=>'djerba.jpg'],
    ['name'=>'Monastir','price'=>360,'image'=>'Monastir.jpg'],
    ['name'=>'Bizerte','price'=>505,'image'=>'Bizerte.jpg'],
];
?>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Travela - Tourism Website Template</title>
            <meta content="width=device-width, initial-scale=1.0" name="viewport">
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
                        <a href="index.html" class="nav-item nav-link ">Acceuil</a>
                        <a href="../../controllers/index.php?action=showDestination" class="nav-item nav-link active">Destination & Reservation</a>
                        <a href="blog.html" class="nav-item nav-link">Activites & Evenements</a>
                        <a href=" formulaire_impact.php" class="nav-item nav-link">Impact Ecologique</a>
                        <a href="testimonial.html" class="nav-item nav-link">Avis</a>
                        <a href="profil.php" class="nav-item nav-link">Mon Profil</a>
                        <a href="login_client.php" class="nav-item nav-link">login</a>
                    </div>
                </div>
            </nav>

        <!-- Header Start -->
        <div class="container-fluid bg-dest">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4">Nos Destinations</h1>
                 
            </div>
        </div>
        <!-- Header End -->

        <!-- Destination Start -->
      <!-- Destination Section -->
<div class="container-fluid destination py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Destination</h5>
            <h1 class="mb-0">Popular Destination</h1>
        </div>

        <div class="row g-4">
            <!-- NEW destination first -->
            <?php if($newDestCard): ?>
                <div class="col-lg-6 col-xl-4">
                    <div class="destination-img">
                        <img class="img-fluid rounded w-100" src="img/<?php echo $newDestCard['image']; ?>" alt="">
                        <div class="destination-overlay p-4">
                            <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">
                                <?php echo $newDestCard['price']; ?>$
                            </a>
                            <h4 class="text-white mb-2 mt-3"><?php echo htmlspecialchars($newDestCard['name']); ?></h4>
                        </div>
                        <div class="search-icon">
                            <a href="img/<?php echo $newDestCard['image']; ?>" data-lightbox="destination">
                                <i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- EXISTING destinations -->
            <?php foreach($allDestinations as $dest): ?>
                <div class="col-lg-6 col-xl-4">
                    <div class="destination-img">
                        <img class="img-fluid rounded w-100" src="img/<?php echo $dest['image']; ?>" alt="">
                        <div class="destination-overlay p-4">
                            <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">
                                <?php echo $dest['price']; ?>$
                            </a>
                            <h4 class="text-white mb-2 mt-3"><?php echo htmlspecialchars($dest['name']); ?></h4>
                        </div>
                        <div class="search-icon">
                            <a href="img/<?php echo $dest['image']; ?>" data-lightbox="destination">
                                <i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div> <!-- row end -->
    </div> <!-- container end -->
</div> <!-- container-fluid end -->


         <div class="container-fluid booking py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <!-- Your existing content -->
                </div>
                <div class="col-lg-6">
                    <h1 class="text-white mb-3">Book A Tour Deals</h1>
                    <p class="text-white mb-4">Get <span class="text-warning">50% Off</span> On Your First Adventure Trip With Travela. Get More Deal Offers Here.</p>
                   <form id="bookingForm" method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control bg-white border-0" id="nomclient" name="nomclient" placeholder="Votre nom" value="<?php echo htmlspecialchars($_SESSION['nomclient'] ?? ''); ?>" readonly required>
                                        <label for="nomclient">Votre Nom</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control bg-white border-0" id="mailclient" name="mailclient" placeholder="Votre email" value="<?php echo htmlspecialchars($_SESSION['mailclient'] ?? ''); ?>" readonly required>
                                        <label for="mailclient">Votre Email</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control bg-white border-0" id="phonenumber" name="phonenumber" placeholder="nbrphone" required>
                                    <label for="phonenumber">Numéro de téléphone</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control bg-white border-0" id="placename" name="placename" placeholder="Package" readonly>
                                    <label for="placename">Destination</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select bg-white border-0" id="persons" name="persons" required>
                                        <option value="personne">Personne</option>
                                        <option value="group">Group</option>
                                        <option value="family">Family</option>
                                    </select>
                                    <label for="persons">Type</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" class="form-control bg-white border-0" id="nbrpersons" name="nbrpersons" placeholder="Nombre de personnes" value="1" min="1" required>
                                    <label for="nbrpersons">Nombre de personnes</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" class="form-control bg-white border-0" id="baseprice" name="baseprice" placeholder="Prix de base" readonly>
                                    <label for="baseprice">Prix de base</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" class="form-control bg-white border-0" id="price" name="price" placeholder="Prix final" readonly>
                                    <label for="price">Prix final</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary text-white w-100 py-3" type="submit">Book Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Tour Booking End -->
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
<!-- JavaScript Libraries - LOAD JQUERY FIRST -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="/travela/mvc/views/frontOffice/lib/easing/easing.min.js"></script>
<script src="/travela/mvc/views/frontOffice/lib/waypoints/waypoints.min.js"></script>
<script src="/travela/mvc/views/frontOffice/lib/owlcarousel/owl.carousel.min.js"></script>
<script src="/travela/mvc/views/frontOffice/lib/lightbox/js/lightbox.min.js"></script>

<!-- Template Javascript -->
<script src="/travela/mvc/views/frontOffice/js/main.js"></script>

<!-- YOUR CUSTOM BOOKING JAVASCRIPT - LOAD LAST -->
<script>
// Function to handle destination clicks
function selectDestination(destinationName, basePrice) {
    console.log('Destination selected:', destinationName, basePrice);
    
    // 1. Set destination name in placename field
    $('#placename').val(destinationName);
    
    // 2. Set base price in baseprice field
    $('#baseprice').val(basePrice);
    
    // 3. Calculate initial final price
    calculateFinalPrice();
    
    // 4. Load client data from database
    loadClientData();
}

function calculateFinalPrice() {
    const basePrice = parseFloat($('#baseprice').val()) || 0;
    const personType = $('#persons').val();
    const nbrPersons = parseInt($('#nbrpersons').val()) || 1;
    
    let multiplier = 1;
    switch(personType) {
        case 'group': multiplier = 2.5; break;
        case 'family': multiplier = 3.4; break;
        default: multiplier = 1;
    }
    
    const finalPrice = basePrice * multiplier * nbrPersons;
    $('#price').val(finalPrice.toFixed(2));
}

function loadClientData() {
    console.log('Loading client data...');
    $.ajax({
        url: '../../controllers/index.php?action=getClientData',
        type: 'GET',
        success: function(response) {
            console.log('Client data response:', response);
            if(response.success) {
                $('#nomclient').val(response.nomclient);
                $('#mailclient').val(response.mailclient);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading client data:', error);
            // Demo data if AJAX fails
            $('#nomclient').val('aziz');
            $('#mailclient').val('jomaaziz@gmail.com');
        }
    });
}

// Wait for document to be fully ready
$(document).ready(function() {
    console.log('Document ready - initializing destination booking...');
    
    // Add click events to destination price buttons
    $('.destination-overlay .btn').on('click', function(e) {
        e.preventDefault();
        const destinationCard = $(this).closest('.destination-overlay');
        const destinationName = destinationCard.find('h4').text().trim();
        const priceText = $(this).text().replace('$', '').trim();
        const basePrice = parseFloat(priceText);
        
        selectDestination(destinationName, basePrice);
    });

    // Recalculate price when selection changes
    $('#persons, #nbrpersons').on('change', calculateFinalPrice);
    
    // Form submission
  $('#bookingForm').on('submit', function(e) {
    e.preventDefault();

    $.ajax({
        url: '../controllers/index.php?action=processBooking', // ✅ Correct
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(response) {
            console.log('AJAX response:', response);
            if(response.success) {
                alert(response.message);
                $('#bookingForm')[0].reset();
            } else {
                alert('Error: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', status, error);
            console.log(xhr.responseText);
            alert('Server error - check console for details');
        }
    });
    });

});
// Load new destination from localStorage
$(document).ready(function() {
    const newDest = JSON.parse(localStorage.getItem('newDestination'));
    if(newDest) {
        const destCard = `
        <div class="col-lg-6">
            <div class="destination-img">
                <img class="img-fluid rounded w-100" src="${newDest.image}" alt="">
                <div class="destination-overlay p-4">
                    <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">${newDest.price}$</a>
                    <h4 class="text-white mb-2 mt-3">${newDest.name}</h4>
                </div>
                <div class="search-icon">
                    <a href="${newDest.image}" data-lightbox="destination">
                        <i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i>
                    </a>
                </div>
            </div>
        </div>
        `;
        // Append the new destination at the top of the destination row
        $('#tab-1 .row.g-4 .col-xl-8 .row.g-4').prepend(destCard);

        // Remove from localStorage so it's displayed only once
        localStorage.removeItem('newDestination');
    }
});


</script>
    </body>

</html>