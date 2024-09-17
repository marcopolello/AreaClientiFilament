<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('codice_cliente')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('ragione_sociale')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('indirizzo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('codice_fiscale')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('categoria_cliente')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('categoria_cliente')
                    ->options([
                        'premium' => 'Premium',
                        'standard' => 'Standard',
                    ]),
                Forms\Components\Select::make('owner_id')
                    ->relationship('owner', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}