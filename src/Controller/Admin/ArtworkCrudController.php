<?php

namespace App\Controller\Admin;

use App\Entity\Artwork;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ArtworkCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Artwork::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // Basic fields
            IdField::new('id')->onlyOnIndex(),
            TextField::new('title'),
            TextareaField::new('description'),

            // ── ARTWORK IMAGE ──
            // Display existing artwork image on index/detail
            ImageField::new('artworkImageName', 'Artwork Image')
                ->setBasePath('/uploads/artwork')
                ->hideOnForm(),
            // Upload widget on new/edit
            Field::new('artworkFile', 'Artwork Image')
                ->setFormType(VichImageType::class)
                ->onlyOnForms(),
        ];
    }
}
