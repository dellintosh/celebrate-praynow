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


        return $this->render('index.html.twig', [
            'prayers' => $prayers,
        ]);
    }

    /**
     * @Route("/sync", name="sync")
     */
    public function syncAction()
    {
        # Pull prayers from REST endpoint and cache them in db.
        # Count how many records were updated
        $url = "https://app.eztexting.com/incoming-messages?format=json";
        $headers = ['Accept' => 'application/json'];
        $query = [
            'User' => getenv('EZTEXTING_USERNAME'),
            'Password' => getenv('EZTEXTING_PASSWORD'),
            'Search' => 'PRAYNOW',
            'sortBy' => 'ReceivedOn',
            'sortDir' => 'desc',
        ];
        $response = Unirest\Request::get($url, $headers, $query);

        $count = 12;
        return $this->render('sync.html.twig', [
            'count' => $count,
            'response' => $response->body,
        ]);
    }
}
