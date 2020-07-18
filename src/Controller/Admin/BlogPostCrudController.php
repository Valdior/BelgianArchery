<?php

namespace App\Controller\Admin;

use App\Entity\BlogPost;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BlogPostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BlogPost::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('BlogPost')
            ->setEntityLabelInPlural('BlogPost')
            ->setSearchFields(['id', 'title', 'slug', 'description', 'body']);
    }

    public function configureFields(string $pageName): iterable
    {
        $title = TextField::new('title');
        $slug = TextField::new('slug');
        $description = TextEditorField::new('description');
        $body = TextareaField::new('body');
        $createdOn = DateTimeField::new('createdOn');
        $modifiedOn = DateTimeField::new('modifiedOn');
        $isPublished = Field::new('isPublished');
        $publishedOn = DateTimeField::new('publishedOn');
        $author = AssociationField::new('author');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $title, $createdOn, $modifiedOn, $isPublished, $publishedOn, $author];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $title, $slug, $description, $body, $createdOn, $modifiedOn, $isPublished, $publishedOn, $author];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$title, $slug, $description, $body, $createdOn, $modifiedOn, $isPublished, $publishedOn, $author];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$title, $slug, $description, $body, $createdOn, $modifiedOn, $isPublished, $publishedOn, $author];
        }
    }
}
