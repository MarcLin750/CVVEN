<?php

namespace App\Models;

use CodeIgniter\Model;


class Admin_Model extends Model
{
    protected $table            = 'admin';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nom', 'prenom', 'mail', 'mdp'];

    /**
     * Check login credentials for an admin.
     *
     * @param string $email Email of the admin.
     * @param string $password Password of the admin.
     * @return bool Returns true if login is successful, otherwise false.
     */
    // Dans Admin_Model.php



    /**
     * Registers a new admin in the database.
     *
     * @param array $data Data to register the admin.
     * @return mixed Returns the ID of the inserted record if successful, false otherwise.
     */
    public function register_admin($data)
    {
    if ($this->insert($data)) {
        return $this->db->insertID();  // Return the ID of the newly inserted record
    } else {
        log_message('error', 'Insert failed: ' . $this->errors());  // Log any errors
        return false;
    }
    }

    public function can_login($mail, $password) {
        $query = $this->where('mail', $mail)
                      ->first();
    
        if ($query && password_verify($password, $query['mdp'])) {
            return $query;  // Retourne les données de l'utilisateur
        }
    
        return false;
    }
    
}