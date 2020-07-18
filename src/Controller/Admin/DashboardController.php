<?php

namespace App\Controller\Admin;

use App\Entity\Club;
use App\Entity\User;
use App\Entity\Archer;
use App\Entity\League;
use App\Entity\Region;
use App\Entity\Peloton;
use App\Entity\BlogPost;
use App\Entity\Location;
use App\Entity\Affiliate;
use App\Entity\Tournament;
use App\Entity\Participant;
use App\Entity\ArcherCategory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Core\User\UserInterface;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('I\'m an Archer')
            ;
    }

    public function configureCrud(): Crud
    {
        return Crud::new();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linktoRoute('Return to site', 'fa fa-site', 'home');

        yield MenuItem::section("Blog");
        yield MenuItem::linkToCrud('BlogPost', 'fas fa-folder-open', BlogPost::class);

        yield MenuItem::section("Archery");        
        yield MenuItem::linkToCrud('Affiliate', 'fas fa-folder-open', Affiliate::class);
        yield MenuItem::linkToCrud('Archer', 'fas fa-folder-open', Archer::class);
        yield MenuItem::linkToCrud('ArcherCategory', 'fas fa-folder-open', ArcherCategory::class);
        yield MenuItem::linkToCrud('Club', 'fas fa-folder-open', Club::class);
        yield MenuItem::linkToCrud('League', 'fas fa-folder-open', League::class);
        yield MenuItem::linkToCrud('Location', 'fas fa-folder-open', Location::class);
        yield MenuItem::linkToCrud('Region', 'fas fa-folder-open', Region::class);

        yield MenuItem::section("Competition");
        yield MenuItem::linkToCrud('Participant', 'fas fa-folder-open', Participant::class);
        yield MenuItem::linkToCrud('Peloton', 'fas fa-folder-open', Peloton::class);        
        yield MenuItem::linkToCrud('Tournament', 'fas fa-folder-open', Tournament::class);

        yield MenuItem::section("User");
        yield MenuItem::linkToCrud('User', 'fas fa-folder-open', User::class);
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        // Usually it's better to call the parent method because that gives you a
        // user menu with some menu items already created ("sign out", "exit impersonation", etc.)
        // if you prefer to create the user menu from scratch, use: return UserMenu::new()->...
        return parent::configureUserMenu($user)
            // use the given $user object to get the user name
            // ->setName($user->getFullName())
            // // use this method if you don't want to display the name of the user
            // ->displayUserName(false)

            // // you can return an URL with the avatar image
            // // ->setAvatarUrl('https://...')
            // // ->setAvatarUrl($user->getProfileImageUrl())
            // // use this method if you don't want to display the user image
            // ->displayUserAvatar(false)
            // // you can also pass an email address to use gravatar's service
            // // ->setGravatarEmail($user->getMainEmailAddress())

            // // you can use any type of menu item, except submenus
            ->addMenuItems([
                MenuItem::linkToRoute('My Profile', 'fa fa-id-card', 'profile', ['...' => '...']),
                MenuItem::section(),
            ])
            ;
    }

    /**
     * @Route("/admin", name="admin_dashboard")
     */
    public function index(): Response
    {
        return parent::index();
    }
}
