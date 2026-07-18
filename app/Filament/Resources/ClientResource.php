<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Invoice Management';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Clients';

    protected static ?string $modelLabel = 'Client';

    protected static ?string $pluralModelLabel = 'Clients';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('Basic Information')
                    ->schema([

                        TextInput::make('company_name')
                            ->label('Company Name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('contact_name')
                            ->label('Contact Name')
                            ->required()
                            ->maxLength(255),

                    ])
                    ->columns(2),

                Section::make('Contact')
                    ->schema([

                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),

                        TextInput::make('phone')
                            ->tel()
                            ->required()
                            ->maxLength(255),

                    ])
                    ->columns(2),

                Section::make('Additional')
                    ->schema([

                        Textarea::make('address')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),

                        Textarea::make('notes')
                            ->rows(4)
                            ->columnSpanFull(),

                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('company_name')
                    ->label('Company')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('contact_name')
                    ->label('Contact')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('phone')
                    ->copyable(),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('d M Y')
                    ->sortable(),

            ])
            ->defaultSort('company_name')
            ->filters([
            ])
            ->actions([

                Tables\Actions\ViewAction::make(),

                Tables\Actions\EditAction::make(),

                Tables\Actions\DeleteAction::make(),

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

    public static function getGloballySearchableAttributes(): array
    {
        return [
            'company_name',
            'contact_name',
            'email',
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'view' => Pages\ViewClient::route('/{record}'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}