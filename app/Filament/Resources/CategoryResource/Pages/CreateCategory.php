<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;
    
    
    public function save()
    {
        \Log::info("Saving category with name: " . $this->name . " and slug: " . $this->slug);
        
        // Call the parent's save method to handle the actual save logic
        parent::save();
    }
}


