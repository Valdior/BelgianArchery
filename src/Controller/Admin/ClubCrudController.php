<?php

namespace App\Controller\Admin;

use App\Entity\Club;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ClubCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Club::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Club')
            ->setEntityLabelInPlural('Club')
            ->setSearchFields(['id', 'name', 'number', 'acronym', 'email', 'website']);
    }

    public function configureFields(string $pageName): iterable
    {
        $name = TextField::new('name');
        $number = IntegerField::new('number');
        $acronym = TextField::new('acronym');
        $email = TextField::new('email');
        $website = TextField::new('website');
        $region = AssociationField::new('region');
        $members = AssociationField::new('members');
        $tournaments = AssociationField::new('tournaments');
        $owner = AssociationField::new('owner');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $name, $number, $acronym, $email, $website, $region];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $name, $number, $acronym, $email, $website, $region, $members, $tournaments, $owner];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $number, $acronym, $email, $website, $region, $members, $tournaments, $owner];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $number, $acronym, $email, $website, $region, $members, $tournaments, $owner];
        }
    }
}
