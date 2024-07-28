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
use Filament\Pages\Actions\Action;

class SubcategoryResource extends Resource
{
    protected static ?string $model = Subcategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('sub_name')->label('Part Name')
                    ->required(),
                Forms\Components\Select::make('category_id')->label('FG Module')
                    ->relationship('mainCategory', 'category_name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sub_name')->label('Part Name')->searchable(),
                Tables\Columns\TextColumn::make('mainCategory.category_name')->label('FG Module')->searchable(),
            ])
            // ->filters([
            //     Tables\Filters\SelectFilter::make('sub_category_id'),
            //         // ->relationship('mainCategory', 'sub_name'),
            // ])
            ->actions([
                Tables\Actions\EditAction::make()->modalHeading('Edit Item'),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('view_items')
                    ->url(fn (SubCategory $record): string => route('filament.admin.resources.subcategory-datas.index', ['subcategory_id' => $record->id]))
                    ->icon('heroicon-s-eye')
                    ->label('View Items'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
            // ->actions([
            //     Tables\Actions\Action::make('manageSubcategories')
            //         ->label('View Data')
            //         ->url(fn (Subcategory $record) => route('filament.admin.resources.subcategory-datas.index', ['subcategory_id' => $record])),
            // ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubcategories::route('/'),
            // 'create' => Pages\CreateSubcategory::route('/create'),
            // 'edit' => Pages\EditSubcategory::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            // SubcategoryDataRelationManager::class,
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if ($mainCategoryId = request()->get('main_category_id')) {
            $query->where('category_id', $mainCategoryId);
        }

        return $query;
    }
}
