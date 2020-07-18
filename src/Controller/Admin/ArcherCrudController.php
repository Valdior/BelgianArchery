<?php

namespace App\Controller\Admin;

use App\Entity\Archer;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ArcherCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Archer::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Archer')
            ->setEntityLabelInPlural('Archer')
            ->setSearchFields(['id', 'lastname', 'firstname', 'status', 'gender', 'defaultArc']);
    }

    public function configureFields(string $pageName): iterable
    {
        $lastname = TextField::new('lastname');
        $firstname = TextField::new('firstname');
        $birthdate = DateField::new('birthdate');
        $status = IntegerField::new('status');
        $gender = IntegerField::new('gender');
        $defaultArc = IntegerField::new('defaultArc');
        $affiliations = AssociationField::new('affiliations');
        $competitions = AssociationField::new('competitions');
        $defaultCategory = AssociationField::new('defaultCategory');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $lastname, $firstname, $birthdate, $status, $gender, $defaultArc];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $lastname, $firstname, $birthdate, $status, $gender, $defaultArc, $affiliations, $competitions, $defaultCategory];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$lastname, $firstname, $birthdate, $status, $gender, $defaultArc, $affiliations, $competitions, $defaultCategory];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$lastname, $firstname, $birthdate, $status, $gender, $defaultArc, $affiliations, $competitions, $defaultCategory];
        }
    }
}
