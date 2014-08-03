<?
// Copyright (c) 2014 The MediaGallery Authors.
// All rights reserved.
//
// GNU GENERAL PUBLIC LICENSE
// See LICENSE file.

require_once __DIR__."/../config/db_config.php";

class DB
{
	private $db;

	private $prefixe;

	public function __construct() {
			global $DB_server, $DB_user, $DB_pass, $DB_prefixe;

			try {
				$db = new PDO($DB_server, $DB_user, $DB_pass);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->db = $db;
			}
			catch(PDOException $e) {
				die("Erreur de connexion à la DB, impossible d'ouvrir le site");
			}

			$this->prefixe = $DB_prefixe;
	}

	public function prepare($sql) {
		return $this->db->prepare($sql);
	}

	// This method must be used with care.
	// See query_secure().
	public function query($sql) {
		return $this->db->query($sql);
	}

	// Secure query helper with prepare method.
	public function query_secure($sql,$attributs) {
		$request=$this->db->prepare($sql);
		$request->execute($attributs);
		return $request;
	}

	public function exec($sql) {
		return $this->db->exec($sql);
	}

	public function getPrefixe() {
		return $this->prefixe;
	}
}

?>