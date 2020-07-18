<?php

namespace App\Controller\Admin;

use App\Entity\ArcherCategory;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ArcherCategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ArcherCategory::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('ArcherCategory')
            ->setEntityLabelInPlural('ArcherCategory')
            ->setSearchFields(['id', 'name', 'acronym', 'minimumAge']);
    }

    public function configureFields(string $pageName): iterable
    {
        $name = TextField::new('name');
        $acronym = TextField::new('acronym');
        $minimumAge = IntegerField::new('minimumAge');
        $participants = AssociationField::new('participants');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $name, $acronym, $minimumAge, $participants];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $name, $acronym, $minimumAge, $participants];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $acronym, $minimumAge, $participants];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $acronym, $minimumAge, $participants];
        }
    }
}
