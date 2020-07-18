<?php

namespace App\Controller\Admin;

use App\Entity\Region;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RegionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Region::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Region')
            ->setEntityLabelInPlural('Region')
            ->setSearchFields(['id', 'name', 'number']);
    }

    public function configureFields(string $pageName): iterable
    {
        $name = TextField::new('name');
        $number = IntegerField::new('number');
        $clubs = AssociationField::new('clubs');
        $league = AssociationField::new('league');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $name, $number, $clubs, $league];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $name, $number, $clubs, $league];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $number, $clubs, $league];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $number, $clubs, $league];
        }
    }
}
