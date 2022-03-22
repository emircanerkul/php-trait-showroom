<?php

namespace App\Controller\Admin;

use App\Entity\RepositoryEntity;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RepositoryEntityCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RepositoryEntity::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
