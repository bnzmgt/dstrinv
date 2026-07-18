<?php

namespace App\Filament\Resources\InvoiceResource\RelationManagers;

use App\Models\InvoiceItem;
use App\Services\InvoiceItem\AddInvoiceItemService;
use App\Services\InvoiceItem\RemoveInvoiceItemService;
use App\Services\InvoiceItem\UpdateInvoiceItemService;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
//use Filament\Tables\Contracts\HasRelationshipTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $recordTitleAttribute = 'item_name';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Invoice Item')
                    ->schema([
                        TextInput::make('item_name')
                            ->required()
                            ->maxLength(255),

                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),

                        TextInput::make('qty')
                            ->numeric()
                            ->required(),

                        TextInput::make('unit_price')
                            ->numeric()
                            ->prefix('Rp')
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('item_name')

            ->columns([
                TextColumn::make('item_name')
                    ->searchable(),

                TextColumn::make('qty')
                    ->numeric(),

                TextColumn::make('unit_price')
                    ->money('IDR')
                    ->alignEnd(),

                TextColumn::make('created_at')
                    ->dateTime('d M Y'),
            ])

            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->using(function (array $data): Model {

                        return resolve(AddInvoiceItemService::class)
                            ->handle(
                                invoice: $this->getOwnerRecord(),
                                attributes: $data,
                            );

                    }),
            ])

            ->actions([
                Tables\Actions\EditAction::make()
                    ->using(function (
                        Model $record,
                        array $data
                    ): Model {
                        return resolve(UpdateInvoiceItemService::class)
                            ->handle(
                                invoiceItem: $record,
                                attributes: $data,
                            );
                    }),

                Tables\Actions\DeleteAction::make()
                    ->action(function (InvoiceItem $record): void {
                        resolve(RemoveInvoiceItemService::class)
                            ->handle($record);
                    }),
            ])

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([

                    Tables\Actions\BulkAction::make('deleteSelected')
                        ->label('Delete Selected')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(function ($records): void {

                            $service = resolve(RemoveInvoiceItemService::class);

                            foreach ($records as $record) {
                                $service->handle($record);
                            }

                        }),

                ]),
            ]);
    }

    public function isReadOnly(): bool
    {
        return false;
    }
}