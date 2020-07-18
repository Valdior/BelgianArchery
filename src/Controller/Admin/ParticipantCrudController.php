<?php

namespace App\Controller\Admin;

use App\Entity\Participant;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class ParticipantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Participant::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Participant')
            ->setEntityLabelInPlural('Participant')
            ->setSearchFields(['id', 'points', 'numberOfX', 'numberOfTen', 'numberOfNine']);
    }

    public function configureFields(string $pageName): iterable
    {
        $points = IntegerField::new('points');
        $numberOfX = IntegerField::new('numberOfX');
        $numberOfTen = IntegerField::new('numberOfTen');
        $numberOfNine = IntegerField::new('numberOfNine');
        $isForfeited = Field::new('isForfeited');
        $archer = AssociationField::new('archer');
        $peloton = AssociationField::new('peloton');
        $category = AssociationField::new('category');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $points, $numberOfX, $numberOfTen, $numberOfNine, $isForfeited, $archer];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $points, $numberOfX, $numberOfTen, $numberOfNine, $isForfeited, $archer, $peloton, $category];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$points, $numberOfX, $numberOfTen, $numberOfNine, $isForfeited, $archer, $peloton, $category];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$points, $numberOfX, $numberOfTen, $numberOfNine, $isForfeited, $archer, $peloton, $category];
        }
    }
}
