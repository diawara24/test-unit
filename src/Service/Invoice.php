<?php
    namespace App\Service;

    class Invoice {
        private $emailService;

        public function __construct(EmailService $emailService)
        {
            $this->emailService = $emailService;
        }

        public function process($email, $amount) {
            return $this->emailService->send($email, "Votre commande d'un montant de ".$amount." est confrimée");
        }
    }