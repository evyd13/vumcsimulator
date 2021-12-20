<?php
require('./db.php');

class User {

    public $COOKIE_NAME = 'uuid';
    private $pdo = null;

    private $won = 0;
    private $lost = 0;
    private $secretunlocked = 0;

    function __construct($pdo) {
        $this->pdo = $pdo;
        $record = $this->getDatabaseRecord();
    }

    public function getDatabaseRecord() {
        $uuid = $this->getUuid();
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE uuid=?");
        $stmt->execute([$uuid]);
        $record = $stmt->fetch();
        if (!$record) {
            // Record does not exist, create one
            try {
                $this->pdo->beginTransaction();
                $stmt = $this->pdo->prepare("INSERT INTO user (uuid) VALUES (?)");
                $stmt->execute([$uuid]);
                $this->pdo->commit();
            } catch (Exception $e){
                $this->pdo->rollback();
                throw $e;
            }
            $record = $this->getDatabaseRecord();
        }
        $this->won = $record['won'];
        $this->lost = $record['lost'];
        $this->secretunlocked = $record['secretunlocked'];
        return $record;
    }

    private function getUuid() {
        $uuid = '';
        if (!isset($_COOKIE[$this->COOKIE_NAME])) {
            $uuid = sha1($_SERVER['REMOTE_ADDR']);
        } else {
            $uuid = $_COOKIE[$this->COOKIE_NAME];
        }
        
        setcookie($this->COOKIE_NAME, $uuid, time() + (86400 * 30), "/"); // 86400 = 1 day
        return $uuid;
    }

    private function save() {
        try {
            $this->pdo->beginTransaction();
            $stmt = $this->pdo->prepare("UPDATE user SET won=?, lost=?, secretunlocked=? WHERE uuid=?");
            $stmt->execute([$this->won, $this->lost, $this->secretunlocked, $this->getUuid()]);
            $this->pdo->commit();
        } catch (Exception $e){
            $this->pdo->rollback();
            throw $e;
        }
    }

    public function printInfo() {
        $record = $this->getDatabaseRecord();
        echo json_encode($record);
    }

    public function getWon() {
        return $this->won;
    }
    public function getLost() {
        return $this->lost;
    }
    public function getSecretUnlocked() {
        return $this->secretunlocked;
    }

    public function setWon($val) {
        $this->won = $val;
        $this->save();
    }
    public function setLost($val) {
        $this->lost = $val;
        $this->save();
    }
    public function setSecretUnlocked($val) {
        $this->secretunlocked = $val;
        $this->save();
    }

}

$user = new User($pdo);

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'won':
            $user->setWon($user->getWon() + 1);
            break;
        case 'lost':
            $user->setLost($user->getLost() + 1);
            break;
        case 'secretunlocked':
            $user->setSecretUnlocked(1);
            break;
        default:
            break;
    }
}

$user->printInfo();