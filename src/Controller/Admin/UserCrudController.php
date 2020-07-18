<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('User')
            ->setEntityLabelInPlural('User')
            ->setSearchFields(['id', 'email', 'username', 'roles', 'tokenPassword', 'tokenRegistration']);
    }

    public function configureFields(string $pageName): iterable
    {
        $email = TextField::new('email');
        $username = TextField::new('username');
        $password = TextField::new('password');
        $roles = ArrayField::new('roles');
        $tokenPassword = TextField::new('tokenPassword');
        $enabled = Field::new('enabled');
        $tokenRegistration = TextField::new('tokenRegistration');
        $createdOn = DateTimeField::new('createdOn');
        $modifiedOn = DateTimeField::new('modifiedOn');
        $tokenValidateOn = DateTimeField::new('tokenValidateOn');
        $tokenPasswordValidateOn = DateTimeField::new('tokenPasswordValidateOn');
        $lastLoginAt = DateTimeField::new('lastLoginAt');
        $archer = AssociationField::new('archer');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $email, $username, $tokenPassword, $enabled, $tokenRegistration, $createdOn];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $email, $username, $password, $roles, $tokenPassword, $enabled, $tokenRegistration, $createdOn, $modifiedOn, $tokenValidateOn, $tokenPasswordValidateOn, $lastLoginAt, $archer];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$email, $username, $password, $roles, $tokenPassword, $enabled, $tokenRegistration, $createdOn, $modifiedOn, $tokenValidateOn, $tokenPasswordValidateOn, $lastLoginAt, $archer];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$email, $username, $password, $roles, $tokenPassword, $enabled, $tokenRegistration, $createdOn, $modifiedOn, $tokenValidateOn, $tokenPasswordValidateOn, $lastLoginAt, $archer];
        }
    }
}
