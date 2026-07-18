<?php

namespace App\Filament\Resources\InvoiceResource\RelationManagers;

use App\Enums\InvoiceTimelineType;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TimelinesRelationManager extends RelationManager
{
    protected static string $relationship = 'timelines';

    protected static ?string $title = 'Timeline';

    public function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')

            ->columns([

                TextColumn::make('type')
                    ->badge()
                    ->formatStateUsing(
                        fn (InvoiceTimelineType $state): string => $state->label()
                    )
                    ->color(
                        fn (InvoiceTimelineType $state): string => match ($state) {
                            InvoiceTimelineType::CREATED => 'gray',
                            InvoiceTimelineType::UPDATED => 'info',
                            InvoiceTimelineType::SENT => 'warning',
                            InvoiceTimelineType::PAYMENT_RECEIVED => 'success',
                            InvoiceTimelineType::STATUS_CHANGED => 'primary',
                            InvoiceTimelineType::NOTE => 'secondary',
                        }
                    ),

                TextColumn::make('user.name')
                    ->label('User')
                    ->placeholder('-')
                    ->searchable(),

                TextColumn::make('description')
                    ->wrap()
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('d M Y H:i:s')
                    ->sortable(),

            ])

            ->headerActions([])

            ->actions([])

            ->bulkActions([]);
    }

    public function isReadOnly(): bool
    {
        return true;
    }
}