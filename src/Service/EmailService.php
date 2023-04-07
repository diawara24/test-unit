<?php
    namespace App\Service;

    class EmailService {

        public function send($email, $message) {
           return mt_rand(0, 1);
        }
    }
