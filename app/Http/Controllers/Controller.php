<?php

namespace App\Http\Controllers;

class Controller
{
    protected $db;

    public function __construct()
    {
        global $capsule;

        $this->db = $capsule;
    }
}