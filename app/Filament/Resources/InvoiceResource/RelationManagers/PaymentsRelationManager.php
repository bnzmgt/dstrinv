<?php

namespace App\Filament\Resources\InvoiceResource\RelationManagers;

use App\Models\Payment;
use App\Services\Payment\CreatePaymentService;
use App\Services\Payment\DeletePaymentService;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class PaymentsRelationManager extends RelationManager
{
    protected static string $relationship = 'payments';

    protected static ?string $recordTitleAttribute = 'reference_number';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Payment')
                    ->schema([

                        DatePicker::make('payment_date')
                            ->required(),

                        TextInput::make('amount')
                            ->numeric()
                            ->required()
                            ->prefix('Rp'),

                        TextInput::make('payment_method')
                            ->required()
                            ->maxLength(50),

                        TextInput::make('reference_number')
                            ->maxLength(100),

                        Textarea::make('notes')
                            ->rows(3)
                            ->columnSpanFull(),

                    ])
                    ->columns(2),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('reference_number')

            ->columns([

                TextColumn::make('payment_date')
                    ->label('Payment Date')
                    ->date()
                    ->sortable(),

                TextColumn::make('amount')
                    ->money('IDR')
                    ->sortable()
                    ->alignEnd(),

                TextColumn::make('payment_method')
                    ->badge()
                    ->searchable(),

                TextColumn::make('reference_number')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->dateTime('d M Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),

            ])

            ->headerActions([

                Tables\Actions\CreateAction::make()
                    ->using(function (array $data): Model {

                        return resolve(CreatePaymentService::class)
                            ->handle(
                                invoice: $this->getOwnerRecord(),
                                attributes: $data,
                            );

                    }),

            ])

            ->actions([

                Tables\Actions\DeleteAction::make()
                    ->requiresConfirmation()
                    ->action(function (Payment $record): void {

                        resolve(DeletePaymentService::class)
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

                            $service = resolve(DeletePaymentService::class);

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