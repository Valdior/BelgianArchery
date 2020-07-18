<?php

namespace App\Controller\Admin;

use App\Entity\Peloton;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class PelotonCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Peloton::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Peloton')
            ->setEntityLabelInPlural('Peloton')
            ->setSearchFields(['id', 'maxParticipant', 'type']);
    }

    public function configureFields(string $pageName): iterable
    {
        $maxParticipant = IntegerField::new('maxParticipant');
        $type = IntegerField::new('type');
        $startTime = DateTimeField::new('startTime');
        $tournament = AssociationField::new('tournament');
        $participants = AssociationField::new('participants');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $maxParticipant, $type, $startTime, $tournament, $participants];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $maxParticipant, $type, $startTime, $tournament, $participants];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$maxParticipant, $type, $startTime, $tournament, $participants];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$maxParticipant, $type, $startTime, $tournament, $participants];
        }
    }
}
