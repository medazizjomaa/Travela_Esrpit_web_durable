<?php
require_once __DIR__ . '/../DBConnection.php';
require_once __DIR__ . '/../models/reservationModel.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../views/frontOffice/lib/PHPMailer-master/src/Exception.php';
require_once __DIR__ . '/../views/frontOffice/lib/PHPMailer-master/src/PHPMailer.php';
require_once __DIR__ . '/../views/frontOffice/lib/PHPMailer-master/src/SMTP.php';

class ReservationController
{
    private $model;
    private $db;

    public function __construct()
    {
        $this->model = new Reservation();
        $this->db = (new DBConnection())->getConnection();
    }

    public function addReservation()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }

                if (!isset($_SESSION['idclient']) || empty($_SESSION['idclient'])) {
                    throw new Exception("Erreur : Vous devez être connecté pour effectuer une réservation.");
                }

                $idClient = $_SESSION['idclient'];

                $connection = new DBConnection();
                $db = $connection->getConnection();


                $nomDestination = trim($_POST['destination']);
                $stmt = $db->prepare("SELECT id_dest FROM destination WHERE nom_dest = :nom_dest");
                $stmt->execute([':nom_dest' => $nomDestination]);
                $dest = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$dest) {
                    throw new Exception("Destination '$nomDestination' introuvable dans la base !");
                }

                $idDest = $dest['id_dest'];

                
                $reservation = new Reservation();
                $reservation->setIdClient($idClient);
                $reservation->setIdDest($idDest);
                $reservation->setDateRes($_POST['date_reservation']);
                $reservation->setTypeRes($_POST['type']);
                $reservation->setNbrPersonnes($_POST['nbr_personne']);

                if ($this->model->addReservation($reservation)) {
                    

                    -
                    $destinationName = htmlspecialchars($nomDestination);
                    $dateReservation = htmlspecialchars($_POST['date_reservation']);
                    $userEmail = $_SESSION['mailclient'] ?? 'jomaaazize@gmail.com'; 
                    $userName = $_SESSION['nomclient'] ?? 'Client';

                    $mail = new PHPMailer(true);
                    try {
                        
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'jomaaazize@gmail.com'; 
                        $mail->Password = 'nxgecfojesvunzlf';     
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;

                        
                        $mail->setFrom('jomaaazize@gmail.com', 'Travela');
                        $mail->addAddress($userEmail, $userName);

                       
                        $mail->isHTML(true);
                        $mail->Subject = 'Confirmation de votre réservation - Travela';
                        $mail->Body = "
                        <html>
                        <body style='font-family: Arial, sans-serif; color:#333;'>
                            <h2>Bonjour $userName,</h2>
                            <p>Votre réservation a bien été enregistrée ! 🎉</p>
                            <p><strong>Détails :</strong></p>
                            <ul>
                                <li>Destination : <strong>$destinationName</strong></li>
                                <li>Date de réservation : <strong>$dateReservation</strong></li>
                                <li>Type : " . htmlspecialchars($_POST['type']) . "</li>
                                <li>Nombre de personnes : " . htmlspecialchars($_POST['nbr_personne']) . "</li>
                            </ul>
                            <p>Merci d’avoir choisi <strong>Travela</strong>. Nous vous souhaitons un excellent voyage 🌍.</p>
                            <hr>
                            <p style='font-size:12px;color:#777;'>Cet e-mail est envoyé automatiquement. Merci de ne pas y répondre.</p>
                        </body>
                        </html>";

                        $mail->send();
                        echo "<script>alert('✅ Réservation enregistrée et e-mail envoyé à $userEmail !'); window.location='../views/frontOffice/DestRes.php';</script>";
                    } catch (Exception $e) {
                        echo "<script>alert('✅ Réservation enregistrée, mais échec de l’envoi de l’e-mail : {$mail->ErrorInfo}'); window.location='../views/frontOffice/DestRes.php';</script>";
                    }
                } else {
                    throw new Exception('❌ Erreur lors de l’insertion dans la base.');
                }

            } catch (Exception $e) {
                echo "<pre style='color:red;'>Erreur : " . $e->getMessage() . "</pre>";
            }
        }
    }

    public function getReservationsByClient($idclient)
    {
        $query = "SELECT r.*, d.nom_dest 
                  FROM reservation r 
                  JOIN destination d ON r.id_dest = d.id_dest
                  WHERE r.idclient = :idclient";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idclient', $idclient);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteReservation($id_res)
    {
        $stmt = $this->db->prepare("DELETE FROM reservation WHERE id_res = :id_res");
        $stmt->bindParam(':id_res', $id_res);
        return $stmt->execute();
    }

    public function getAllDestinations()
    {
        $stmt = $this->db->prepare("SELECT id_dest, nom_dest FROM destination");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateReservation($id_res, $idclient, $id_dest, $date_res, $type_res, $nbr_personnes)
    {
        $stmt = $this->db->prepare("UPDATE reservation SET idclient = :idclient, id_dest = :id_dest, date_res = :date_res, type_res = :type_res, nbr_personnes = :nbr_personnes WHERE id_res = :id_res");
        $stmt->bindParam(':id_res', $id_res);
        $stmt->bindParam(':idclient', $idclient);
        $stmt->bindParam(':id_dest', $id_dest);
        $stmt->bindParam(':date_res', $date_res);
        $stmt->bindParam(':type_res', $type_res);
        $stmt->bindParam(':nbr_personnes', $nbr_personnes);
        return $stmt->execute();
    }

    public function getAllReservations()
    {
        $query = "SELECT r.*, d.nom_dest 
                  FROM reservation r 
                  JOIN destination d ON r.id_dest = d.id_dest";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}


$controller = new ReservationController();

if (isset($_GET['action'])) {
    if ($_GET['action'] === 'addReservation') {
        $controller->addReservation();
    } elseif ($_GET['action'] === 'delete' && isset($_GET['id'])) {
        if ($controller->deleteReservation($_GET['id'])) {
            echo "<script>alert('✅ Réservation supprimée !'); window.location='lRes.php';</script>";
        } else {
            echo "<script>alert('❌ Erreur lors de la suppression.');</script>";
        }
    } elseif ($_GET['action'] === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_res = $_POST['id_res'];
        $idclient = $_POST['idclient'];
        $id_dest = $_POST['id_dest'];
        $date_res = $_POST['date_res'];
        $type_res = $_POST['type_res'];
        $nbr_personnes = $_POST['nbr_personnes'];
        if ($controller->updateReservation($id_res, $idclient, $id_dest, $date_res, $type_res, $nbr_personnes)) {
            echo "<script>alert('✅ Réservation mise à jour !'); window.location='lRes.php';</script>";
        } else {
            echo "<script>alert('❌ Erreur lors de la mise à jour.');</script>";
        }
    }
}
?>