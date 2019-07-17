<?php

namespace App\Controller;

use Interop\Container\ContainerInterface;

class AdminController {
    protected $ci;
    protected $logger;

    public function __construct(ContainerInterface $ci) {
       $this->ci = $ci;
       $this->logger = $this->ci->get('logger');
    }

    public function login($request, $response, $args) {
        $this->ci->get('renderer')->render($response, "login.html", $args);
    }

    public function signin($request, $response, $args) {
            $postData = $request->getParsedBody();
            $username = htmlspecialchars($postData['username']);
            $password = htmlspecialchars($postData['password']);
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $user = \App\Model\User::select()->where('user', $username)->first();
            if (empty($user)) {
                // add the message to the request for the showLogin function to assign
                $_SESSION['USER'] = null;
                $args['loginError']="Nom d'utilisateur ou mot de passe éroné";
                // return the login view
                return $this->login($request,$response,$args);
            }
        
            // valid login
            $_SESSION['USER'] = $user;
            $args['username']=$user->user;


            $voitures = \App\Model\Voiture::all();
            $args['voitures'] = $voitures;
            $this->ci->get('renderer')->render($response, "admin.html", $args);        
        }
        
    public function admin($request, $response, $args) {
        if(isset($_SESSION['USER']) && !empty($_SESSION['USER'])){
            $user = $_SESSION['USER'];
            $args['username']= $user->user;


            $voitures = \App\Model\Voiture::all();
            $args['voitures'] = $voitures;
            $this->ci->get('renderer')->render($response, "admin.html", $args);
        }else{
            return $this->login($request,$response,$args);
        }
    }
    public function logout($request, $response, $args) {
        $_SESSION['USER']=null;
        $this->ci->get('renderer')->render($response, "login.html", $args);
    }
}
