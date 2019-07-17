<?php

namespace App\Controller;

use Interop\Container\ContainerInterface;

class CollectionController {
    protected $ci;
    protected $logger;
    public function __construct(ContainerInterface $ci) {
       $this->ci = $ci;
       $this->logger = $this->ci->get('logger');
    }

    public function home($request, $response, $args) {
        $voitures = \App\Model\Voiture::all();
        $args['voitures'] = $voitures;
        $this->ci->get('renderer')->render($response, "collection.html", $args);
    }

    public function car($request, $response, $args) {
        $id = (int)$args['id'];
        $voitures = \App\Model\Voiture::select()->where('id', $id)->get();
        $args['voitures'] = $voitures;
        $this->ci->get('renderer')->render($response, "detail.html", $args);
    }

    public function insert($request, $response, $args) {
        $new = new \App\Model\Hello;
        $new->name = 'more one';
        $new->save();
        return $response->withStatus(302)->withHeader('Location', '/hello');
    }

    public function addCar($request, $response, $args) {
        $new = new \App\Model\Voiture;
        $postData = $request->getParsedBody();
        $carName = htmlspecialchars($postData['carName']);
        $carImg = htmlspecialchars($postData['carImg']);
        $year = htmlspecialchars($postData['year']);
        $description = htmlspecialchars($postData['description']);
        $target_path = __DIR__ . '/../../public/img/cars/';

        $target_path = $target_path . basename( $_FILES['carImg']['name']); 

        if(move_uploaded_file($_FILES['carImg']['tmp_name'], $target_path)) {
            $this->logger->info('OK');
        } else{
            $this->logger->info('KO');
        }
        $new->name = $carName;
        $new->year = $year;
        $new->description = $description;
        $new->img = $_FILES['carImg']['name'];
        $new->visibility = true;
        $new->save();
        return $response->withStatus(302)->withHeader('Location', '/admin');
    }

    public function changeCarVisibility($request, $response, $args){
        $postData = $request->getParsedBody();
        $id = htmlspecialchars($postData['id']);
        $voiture = \App\Model\Voiture::select()->where('id', $id)->first();
        $this->logger->info($voiture);       
        $voiture->visibility = $voiture->visibility ? 0 : 1;
        $msg = $voiture->visibility ? "visible" : "invisible";
        if($voiture->save()){
            echo $voiture->name." est maintenant ".$msg;
        }else{
            echo "Erreur dans le changement de visibilité.";
        }
    }
}
