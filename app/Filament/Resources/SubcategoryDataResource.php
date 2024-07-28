<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubcategoryDataResource\Pages;
use App\Filament\Resources\SubcategoryDataResource\RelationManagers;
use App\Models\SubcategoryData;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubcategoryDataResource extends Resource
{
    protected static ?string $model = SubcategoryData::class;
    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static bool $shouldRegisterNavigation = false;

    // public static function getModelLabel(): string
    // {
    //     // Retrieve related data to determine the label
    //     // Example logic for dynamic label
    //     $subcategoryData = SubcategoryData::first(); // Adjust query as needed
    //     return ($subcategoryData->subcategory->sub_name);
    // }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('data_field')
                    ->required(),
                Forms\Components\Select::make('subcategory_id')
                    ->relationship('subCategory', 'sub_name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            // ->heading('Clients')
            // ->description('Manage your clients here.')
            ->columns([
                Tables\Columns\TextColumn::make('data_field'),
                Tables\Columns\TextColumn::make('subCategory.sub_name')->label('Subcategory'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('sub_category_id')
                    ->relationship('subCategory', 'sub_name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->modalHeading('Edit'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubcategoryData::route('/'),
            // 'create' => Pages\CreateSubcategoryData::route('/create'),
            // 'edit' => Pages\EditSubcategoryData::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if ($subCategoryId = request()->get('subcategory_id')) {
            $query->where('subcategory_id', $subCategoryId);
        }

        return $query;
    }
}
