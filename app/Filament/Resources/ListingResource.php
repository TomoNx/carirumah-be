<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Listing;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ListingResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Support\Enums\FontWeight;
class ListingResource extends Resource
{
    protected static ?string $model = Listing::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                    ->live(debounce:300)
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->disabled(),
                Forms\Components\Textarea::make('description')
                    ->required(),
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('luas')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('wifi_speed')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('kapasitas')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('harga_per_hari')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Checkbox::make('full_support')
                    ->default(0),
                Forms\Components\Checkbox::make('tersedia_mini_cafe')
                    ->default(0),
                Forms\Components\Checkbox::make('tersedia_gym')
                    ->default(0),
                Forms\Components\FileUpload::make('foto')
                    ->directory('listings')
                    ->image()
                    ->openable()
                    ->reorderable()
                    ->multiple()
                    ->appendFiles(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->weight(FontWeight::Bold),
                Tables\Columns\TextColumn::make('luas')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('wifi_speed')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kapasitas')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('harga_per_hari')
                    ->money('IDR')
                    ->weight(FontWeight::Bold),
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
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListListings::route('/'),
            'create' => Pages\CreateListing::route('/create'),
            'edit' => Pages\EditListing::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
