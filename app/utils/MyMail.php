<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cursophp7\app\utils;

use cursophp7\core\App;
use \Swift_SmtpTransport;
use \Swift_Message;
use \Swift_Mailer;

/**
 * Description of MyMail
 *
 * @author Adrian Ciucurenco
 */
class MyMail {

    private $transport;
    private $mailer;
    private $config;

    public function __construct() {
        $this->config = App::get('config')['swiftmailer'];
        $this->transport = (new Swift_SmtpTransport($this->config['smtp_server'], $this->config['smtp_port'], $this->config['smtp_security']))
                ->setUsername($this->config['username'])
                ->setPassword($this->config['password']);
        $this->mailer = new Swift_Mailer($this->transport);
    }

    public function send(string $assumpte, string $mailTo, string $nameTo, string $text) {
        $message = (new Swift_Message($assumpte))
                ->setFrom([$this->config['email'] => $this->config['name']])
                ->setTo([$mailTo => $nameTo])
                ->setBody($text);
        // Send the message
        $result = $this->mailer->send($message);
    }

}
