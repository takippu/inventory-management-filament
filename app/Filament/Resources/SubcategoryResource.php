<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubcategoryDataResource\RelationManagers\SubcategoryDataRelationManager;
use App\Filament\Resources\SubcategoryResource\Pages;
use App\Filament\Resources\SubcategoryResource\RelationManagers;
use App\Models\Subcategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubcategoryResource extends Resource
{
    protected static ?string $model = Subcategory::class;



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('sub_name')->label('Part Name')
                    ->required(),
                Forms\Components\Select::make('category_id')->label('FG Module')
                    ->relationship('category', 'category_name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sub_name')->label('Part Name'),
                Tables\Columns\TextColumn::make('category.category_name')->label('FG Module'),
            ])
            ->actions([
                Tables\Actions\Action::make('manageSubcategories')
                    ->label('View Data')
                    ->url(fn (Subcategory $record) => route('filament.admin.resources.subcategory-datas.index', ['subcategory_id' => $record])),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubcategories::route('/'),
            'create' => Pages\CreateSubcategory::route('/create'),
            'edit' => Pages\EditSubcategory::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            SubcategoryDataRelationManager::class,
        ];
    }
}
