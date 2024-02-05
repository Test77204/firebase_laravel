<?php

namespace App\Services;

use Kreait\Firebase\Factory;

class FirebaseService1 {
    private $firebase;

    public function __construct()
    {
        $this->firebase = (new Factory())
            ->withServiceAccount(config_path('firebase_credentials.json'))
            ->create();
    }

    public function getDatabase()
    {
        return $this->firebase->getDatabase();
    }
}
