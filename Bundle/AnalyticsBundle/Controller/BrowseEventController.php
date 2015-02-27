<?php

namespace Victoire\Bundle\AnalyticsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Victoire\Bundle\AnalyticsBundle\Entity\BrowseEvent;

/**
 * @Route("/browseEvent")
 */
class BrowseEventController extends Controller
{
    /**
     * @Route("/track/{viewReferenceId}/{referer}", name="victoire_analytics_track")
     * @Template()
     */
    public function trackAction(Request $request, $viewReferenceId, $referer)
    {
        $browseEvent = new BrowseEvent();
        $browseEvent->setViewReferenceId($viewReferenceId);
        $browseEvent->setIp($request->getClientIp());
        $browseEvent->setReferer($referer);
        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $browseEvent->setAuthor($this->getUser());
        }
        $entityManager = $this->get('doctrine.orm.entity_manager');
        $entityManager->persist($browseEvent);
        $entityManager->flush();

        return new Response();
    }
}
