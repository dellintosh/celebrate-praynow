<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Unirest;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction()
    {
        # TODO: get prayers as a list
        // $headers = ['Accept' => 'application/json'];
        // $query = ['q' => 'Frank Sinatra', 'type' => 'track'];
        // $response = Unirest\Request::get('https://api.spotify.com/v1/search', $headers, $query);

        $prayers = [
            "My friend is in a dark place, the devil has a hold of his heart
            and mind right now. Prayers for peace, comfort, love, strength, and
            that he may see the light at the end of this dark path.",
            "Pray for Ashley, a young mother of 3 little ones, wife, daughter, sister
            & friend to many. She has suffered from multiple strokes since Sunday.
            Today they had to do surgery to relieve swelling and fluid on the brain.
            Please pray for a miracle from our Heavenly Father.",
            "My mom is homeless and she is not able to care for me and my brothers and now
            she is suicidal, I pray for strength and endurance and full reliance on Jesus
            in Jesus name.",
            "Pray for my friend who has cancer, complicated with diabetes.",
        ];

        return $this->render('index.html.twig', [
            'prayers' => $prayers,
            // 'response' => $response,
        ]);
    }

    /**
     * @Route("/sync", name="sync")
     */
    public function syncAction()
    {
        # Pull prayers from REST endpoint and cache them in db.
        # Count how many records were updated
        $count = 12;
        return $this->render('sync.html.twig', ['count' => $count]);
    }
}
