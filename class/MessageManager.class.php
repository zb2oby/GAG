<?php 

class MessageManager {

	private $_db;

    public function __construct($db) {
        $this->setDb($db);
    }

    private function setDb($db) {
        $this->_db = $db;
    }

    public function addMessage(Message $message) {
    	$q = $this->_db->prepare('INSERT INTO Message_interne(idMessage, dateMessage, message, idUtilisateur, idOeuvre, idArtiste, idExpo, idCollectif) VALUES (:idMessage, :dateMessage, :message, :idUtilisateur, :idOeuvre, :idArtiste, :idExpo, :idCollectif)');
    	$q->bindValue(':idMessage', $message->getIdMessage());
        $q->bindValue(':dateMessage', $message->getDateMessage());
        $q->bindValue(':message', $message->getMessage());
        $q->bindValue(':idUtilisateur', $message->getIdUtilisateur());
        $q->bindValue(':idOeuvre', $message->getIdOeuvre());
        $q->bindValue(':idArtiste', $message->getIdArtiste());
        $q->bindValue(':idExpo', $message->getIdExpo());
        $q->bindValue(':idCollectif', $message->getIdCollectif());

        $q->execute();
    }

    public function deleteMessage(Message $message) {
    	$q = $this->_db->exec('DELETE FROM Message_interne WHERE idMessage ='.$message->getIdMessage());
    }

    
    public function infoMessage($champ, $id) {
    	$list = [];
        $q = $this->_db->query("SELECT dateMessage, message, idUtilisateur FROM Message_interne WHERE ".$champ." ='".$id."'ORDER BY dateMessage DESC LIMIT 10");
        while ($data = $q->fetch()) {
            $list[] = new Message($data);
        }
        
        return $list;
    }
}