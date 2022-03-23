<?php

namespace App\Controller\Admin;

use App\Entity\RepositoryEntity;
use App\Entity\TraitEntity;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/", name="admin")
     */
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        // Option 1. Make your dashboard redirect to the same page for all users
        return $this->redirect($adminUrlGenerator->setController(RepositoryEntityCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('PHP Traits');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Repositories', 'fa fa-database', RepositoryEntity::class);
        yield MenuItem::linkToCrud('Traits', 'fa fa-code', TraitEntity::class);

        yield MenuItem::section('Administration');
        yield MenuItem::linkToRoute('Actions', 'fa fa-gears', 'admin_actions');
    }
}
