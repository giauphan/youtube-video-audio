<?php

namespace App\Filament\Resources\BotBlogResource\Pages;

use App\Filament\Resources\BotBlogResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBotBlog extends EditRecord
{
    protected static string $resource = BotBlogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
