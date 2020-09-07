<?php

namespace App\Controller\Admin;

use App\Component\DTO\Payload\AttributePayloadDTO;
use App\Entity\Attribute;
use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            // the name visible to end users
            ->setTitle('Mc3')
            ;
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linktoDashboard('Dashboard', 'fa fa-home'),
            MenuItem::section('Website'),
            MenuItem::linkToCrud('Attributes', 'fa fa-tags', Attribute::class),
            MenuItem::linkToCrud('Categories', 'fa fa-tags', Category::class),
        ];
    }
}
