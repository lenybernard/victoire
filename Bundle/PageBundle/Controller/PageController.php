<?php
namespace Victoire\Bundle\PageBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Victoire\Bundle\PageBundle\Entity\Page;

/**
 * undocumented class
 *
 **/
class PageController extends BasePageController
{
    /**
     * Show homepage or redirect to new page
     *
     * ==========================
     * find homepage
     * if homepage
     *     forward show(homepage)
     * else
         *     redirect to welcome page (dashboard)
     * ==========================
     *
     * @Route("/", name="victoire_core_page_homepage")
     * @return template
     *
     */
    public function homepageAction()
    {
        //services
        $em = $this->getEntityManager();

        //get the homepage
        $homepage = $em->getRepository('VictoirePageBundle:BasePage')->findOneByHomepage(true);

        if ($homepage !== null) {
            return $this->showAction($homepage->getUrl());
        } else {
            return $this->redirect($this->generateUrl('victoire_dashboard_default_welcome'));
        }
    }

}
