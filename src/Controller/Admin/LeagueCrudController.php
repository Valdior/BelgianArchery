<?php

namespace App\Controller\Admin;

use App\Entity\League;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LeagueCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return League::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('League')
            ->setEntityLabelInPlural('League')
            ->setSearchFields(['id', 'name', 'acronym']);
    }

    public function configureFields(string $pageName): iterable
    {
        $name = TextField::new('name');
        $acronym = TextField::new('acronym');
        $regions = AssociationField::new('regions');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $name, $acronym, $regions];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $name, $acronym, $regions];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $acronym, $regions];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $acronym, $regions];
        }
    }
}
