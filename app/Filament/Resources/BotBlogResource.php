<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BotBlogResource\Pages;
use App\Filament\Resources\BotBlogResource\RelationManagers;
use App\Models\BotBlog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BotBlogResource extends Resource
{
    protected static ?string $model = BotBlog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('bot_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('post_url')
                ->unique(ignoreRecord: true)
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('category_post')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('lang')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('limit_blog')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bot_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('post_url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category_post')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lang')
                    ->searchable(),
                Tables\Columns\TextColumn::make('limit_blog')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBotBlogs::route('/'),
            'create' => Pages\CreateBotBlog::route('/create'),
            'edit' => Pages\EditBotBlog::route('/{record}/edit'),
        ];
    }
}
