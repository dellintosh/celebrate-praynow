<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Prayer;
use AppBundle\Service\PrayerManager;
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
        $doctrine = $this->get('doctrine');
        $repository = $doctrine->getRepository('AppBundle:Prayer');

        $query = $repository->createQueryBuilder('p')
            ->orderBy('p.receivedOn', 'DESC')
            ->setMaxResults(4)
            ->getQuery();

        $prayers = $query->getResult();
//         $query = $repository->createQueryBuilder('p')
//     ->where('p.price > :price')
//     ->setParameter('price', '19.99')
//     ->orderBy('p.price', 'ASC')
//     ->getQuery();

// $products = $query->getResult();


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

        $results = $response->body->Response->Entries;

        $prayers = [];
        foreach ($results as $message) {
            $prayers[] = $this->savePrayerToDb($message);
        }

        return $this->render('sync.html.twig', [
            'count' => count($prayers),
        ]);
    }

    protected function savePrayerToDb($prayer_data) {
        $doctrine = $this->get('doctrine');

        $prayer = $doctrine->getRepository('AppBundle:Prayer')->findOneBy(
                ['messageId' => $prayer_data->ID]
            );

        if (!$prayer) {
            $prayer = new Prayer();
        }

        $prayer->setMessageId($prayer_data->ID);
        $prayer->setPhoneNumber($prayer_data->PhoneNumber);
        $prayer->setSubject($prayer_data->Subject);

        $prayer->setMessage(trim(str_ireplace('PRAYNOW', '', $prayer_data->Message)));

        $ReceivedOn = \DateTime::createFromFormat('m-d-Y H:i A', $prayer_data->ReceivedOn);
        $prayer->setReceivedOn($ReceivedOn);

        # Save the $prayer model to the db
        if (strlen($prayer->getMessage()) > 1) {
            $em = $doctrine->getManager();
            $em->persist($prayer);
            $em->flush();
        }

        return $prayer;
    }
}
