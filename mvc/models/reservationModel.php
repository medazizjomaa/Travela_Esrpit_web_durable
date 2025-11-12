<?php
class Reservation
{
    private $id_res;
    private $idclient;
    private $id_dest;
    private $date_res;
    private $type_res;
    private $nbr_personnes;
        private $db;

    public function __construct() {
        $database = new DBConnection();
        $this->db = $database->getConnection();
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ✅ Pour afficher les erreurs SQL
    }

    
public function addReservation(Reservation $res) {
        try {
            $sql = "INSERT INTO reservation (idclient, id_dest, date_res, type_res, nbr_personnes)
                    VALUES (:idclient, :id_dest, :date_res, :type_res, :nbr_personnes)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':idclient', $res->getIdClient());
            $stmt->bindValue(':id_dest', $res->getIdDest());
            $stmt->bindValue(':date_res', $res->getDateRes());
            $stmt->bindValue(':type_res', $res->getTypeRes());
            $stmt->bindValue(':nbr_personnes', $res->getNbrPersonnes());
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "<pre style='color:red;'>Erreur SQL : " . $e->getMessage() . "</pre>";
            return false;
        }
    }

    

    // Getters
    public function getIdRes() { return $this->id_res; }
    public function getIdClient() { return $this->idclient; }
    public function getIdDest() { return $this->id_dest; }
    public function getDateRes() { return $this->date_res; }
    public function getTypeRes() { return $this->type_res; }
    public function getNbrPersonnes() { return $this->nbr_personnes; }

    // Setters
    public function setIdRes($id_res) { $this->id_res = $id_res; }
    public function setIdClient($idclient) { $this->idclient = $idclient; }
    public function setIdDest($id_dest) { $this->id_dest = $id_dest; }
    public function setDateRes($date_res) { $this->date_res = $date_res; }
    public function setTypeRes($type_res) { $this->type_res = $type_res; }
    public function setNbrPersonnes($nbr_personnes) { $this->nbr_personnes = $nbr_personnes; }
}
?>
