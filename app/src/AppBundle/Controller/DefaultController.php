<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        # TODO: get prayers as a list
        $prayers = [
            "My friend is in a dark place, the devil has a hold of his heart
            and mind right now. Prayers for peace, comfort, love, strength, and
            that he may see the light at the end of this dark path.",
            "Pray for Ashley, a young mother of 3 little ones, wife, daughter,
            sister & friend to many. She has suffered from multiple strokes since Sunday.
            Today they had to do surgery to relieve swelling and fluid on the brain.
            Please pray for a miracle from our Heavenly Father.",
            "My mom is homeless and she is not able to care for me and my brothers and now
            she is suicidal, I pray for strength and endurance and full reliance on Jesus
            in Jesus name.",
            "Pray for my friend who has cancer, complicated with diabetes.",
        ];

        return $this->render('index.html.twig', ['prayers' => $prayers]);
    }
}
