<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
protected $table = 'users'; // Nama tabel
protected $primaryKey = 'id';
protected $allowedFields = ['username', 'email', 'password', 'profile_image']; // Kolom yang diizinkan
}
