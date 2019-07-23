<?php

namespace App\Controller;

use Interop\Container\ContainerInterface;

class HomeController {
    protected $ci;
    public function __construct(ContainerInterface $ci) {
       $this->ci = $ci;
    }

    public function home($request, $response, $args) {
        function fetchUrl($url){

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 20);
            // You may need to add the line below
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
           
            $feedData = curl_exec($ch);
            curl_close($ch); 
            return $feedData;
           
           }
        ///////////////////////////    décommenter pour feed FB

        //    $profile_id = "avosbars";
           
        //    //App Info, needed for Auth
        //    $app_id = "685382521932975";
        //    $app_secret = "3496bb0e1a957fdf0326f5b12f7318a9";
           
        //    $accessToken = "EAAJvWg3BTK8BAIr6IkDd2ChGoZAjtUv5kt70x9A5bwvjJxVvtHFuhcaOcJzBosuPvo72ejJ51jq3iKAjKy9Okm5ZCwdtXN2mrJFicZAG4Px3VeiySl7ATpQxFGx2o5OjNs4dJj27LTRTbjpRpwnz8qDlIQiheHHGSNKuJoxXAZDZD";
        //    $json_object = json_decode(fetchUrl("https://graph.facebook.com/".$profile_id."/feed?access_token=".$accessToken."&limit=10"));
        //    foreach($json_object->data as $post){

        //        $imagedata =  json_decode(fetchUrl("https://graph.facebook.com/$post->id?fields=picture.type(large)&access_token=$accessToken"));
        //     //    $imagedata = fetchUrl("https://graph.facebook.com/".$post->id."/picture?access_token=".$accessToken);
        //     //    $base64 = base64_encode($imagedata);
        //        $args['fb_img'][$post->id] = $imagedata->picture;
        //     }
        //     var_dump($json_object);
        //     $args['fb_feed'] = $json_object;
        $this->ci->get('renderer')->render($response, "home.html", $args);
    }

    public function newsletterSubscribed($request, $response, $args) {
        $pattern =  '/^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/';
        $postData = $request->getParsedBody();
        $email = htmlspecialchars($postData['email']);
        $existingmail = \App\Model\Newsletter::select()->where('email', $email)->get();
       if(preg_match($pattern, $email)){
           if(count($existingmail) > 0){
                echo "Vous êtes déjà inscrit à notre newsletter";
           }else{
               $new = new \App\Model\Newsletter;
               $new->email = $email;
               $new->save();
               echo "Vous recevrez notre newsletter !";
           }
       }else{
            echo "Erreur - Email incorrect";
       }    
    }
}
