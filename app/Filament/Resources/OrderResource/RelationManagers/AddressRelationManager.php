<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AddressRelationManager extends RelationManager
{
    protected static string $relationship = 'address';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('first_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('last_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->required()
                    ->tel()
                    ->maxLength(255),
                TextInput::make('city')
                    ->required()
                    ->maxLength(255),
                TextInput::make('state')
                    ->required()
                    ->maxLength(255),
                TextInput::make('zip_code')
                    ->required()
                    ->maxLength(255),

                Textarea::make('street_address')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('street_address')
            ->columns([
                TextColumn::make('full_name')
                    ->label('Full Name')
                    ->sortable()
                    ->searchable()
                    ->limit(50),

                TextColumn::make('phone')
                    ->label('Phone')
                    ->sortable()
                    ->searchable()
                    ->limit(50),
                TextColumn::make('street_address')
                    ->label('Street Address')
                    ->sortable()
                    ->searchable()
                    ->limit(50),
                TextColumn::make('city')
                    ->label('City')
                    ->sortable()
                    ->searchable()
                    ->limit(50),
                TextColumn::make('state')
                    ->label('State')
                    ->sortable()
                    ->searchable()
                    ->limit(50),
                TextColumn::make('zip_code')
                    ->label('Zip Code')
                    ->sortable()
                    ->searchable()
                    ->limit(50),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
