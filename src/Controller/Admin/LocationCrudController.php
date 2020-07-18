<?php

namespace App\Controller\Admin;

use App\Entity\Location;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LocationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Location::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Location')
            ->setEntityLabelInPlural('Location')
            ->setSearchFields(['id', 'street', 'number', 'locality', 'postalcode', 'city', 'title']);
    }

    public function configureFields(string $pageName): iterable
    {
        $street = TextField::new('street');
        $number = IntegerField::new('number');
        $locality = TextField::new('locality');
        $postalcode = IntegerField::new('postalcode');
        $city = TextField::new('city');
        $title = TextField::new('title');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $street, $number, $locality, $postalcode, $city, $title];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $street, $number, $locality, $postalcode, $city, $title];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$street, $number, $locality, $postalcode, $city, $title];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$street, $number, $locality, $postalcode, $city, $title];
        }
    }
}
