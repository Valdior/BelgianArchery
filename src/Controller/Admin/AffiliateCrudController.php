<?php

namespace App\Controller\Admin;

use App\Entity\Affiliate;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AffiliateCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Affiliate::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Affiliate')
            ->setEntityLabelInPlural('Affiliate')
            ->setSearchFields(['id', 'affiliateNumber']);
    }

    public function configureFields(string $pageName): iterable
    {
        $affiliateNumber = TextField::new('affiliateNumber');
        $affiliateSince = DateField::new('affiliateSince');
        $affiliateEnd = DateField::new('affiliateEnd');
        $club = AssociationField::new('club');
        $archer = AssociationField::new('archer');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $affiliateNumber, $affiliateSince, $affiliateEnd, $club, $archer];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $affiliateNumber, $affiliateSince, $affiliateEnd, $club, $archer];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$affiliateNumber, $affiliateSince, $affiliateEnd, $club, $archer];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$affiliateNumber, $affiliateSince, $affiliateEnd, $club, $archer];
        }
    }
}
