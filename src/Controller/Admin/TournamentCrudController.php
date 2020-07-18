<?php

namespace App\Controller\Admin;

use App\Entity\Tournament;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TournamentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tournament::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Tournament')
            ->setEntityLabelInPlural('Tournament')
            ->setSearchFields(['id', 'type', 'title', 'slug', 'contact', 'information']);
    }

    public function configureFields(string $pageName): iterable
    {
        $startDate = DateTimeField::new('startDate');
        $endDate = DateTimeField::new('endDate');
        $type = IntegerField::new('type');
        $title = TextField::new('title');
        $slug = TextField::new('slug');
        $contact = TextField::new('contact');
        $information = TextareaField::new('information');
        $organizer = AssociationField::new('organizer');
        $pelotons = AssociationField::new('pelotons');
        $location = AssociationField::new('location');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $startDate, $endDate, $type, $title, $contact, $organizer];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $startDate, $endDate, $type, $title, $slug, $contact, $information, $organizer, $pelotons, $location];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$startDate, $endDate, $type, $title, $slug, $contact, $information, $organizer, $pelotons, $location];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$startDate, $endDate, $type, $title, $slug, $contact, $information, $organizer, $pelotons, $location];
        }
    }
}
