<?php

namespace App\Filament\Resources;

use App\Enums\InvoiceStatus;
use App\Filament\Resources\InvoiceResource\Pages;
use App\Filament\Resources\InvoiceResource\RelationManagers\ItemsRelationManager;
use App\Filament\Resources\InvoiceResource\RelationManagers\PaymentsRelationManager;
use App\Filament\Resources\InvoiceResource\RelationManagers\TimelinesRelationManager;
use App\Models\Invoice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Invoice Management';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Invoices';

    protected static ?string $modelLabel = 'Invoice';

    protected static ?string $pluralModelLabel = 'Invoices';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('Invoice Information')
                    ->schema([

                        Select::make('project_id')
                            ->relationship('project', 'name')
                            ->searchable()
                            ->preload()
                            ->native(false)
                            ->required(),

                        TextInput::make('invoice_number')
                            ->disabled()
                            ->dehydrated(false)
                            ->helperText('Automatically generated.'),

                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),

                    ])
                    ->columns(2),

                Section::make('Schedule')
                    ->schema([

                        DatePicker::make('issue_date')
                            ->required(),

                        DatePicker::make('due_date')
                            ->required(),

                    ])
                    ->columns(2),

                Section::make('Additional')
                    ->schema([

                        Textarea::make('notes')
                            ->rows(5)
                            ->columnSpanFull(),

                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')

            ->columns([

                TextColumn::make('invoice_number')
                    ->label('Invoice')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                TextColumn::make('project.client.company_name')
                    ->label('Client')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('project.name')
                    ->label('Project')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('title')
                    ->searchable()
                    ->limit(40),

                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn (InvoiceStatus $state) => $state->label())
                    ->color(fn (InvoiceStatus $state) => match ($state) {
                        InvoiceStatus::DRAFT => 'gray',
                        InvoiceStatus::SENT => 'warning',
                        InvoiceStatus::PAID => 'success',
                    }),

                TextColumn::make('issue_date')
                    ->date(),

                TextColumn::make('due_date')
                    ->date(),

                TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])

            ->filters([

                Tables\Filters\SelectFilter::make('status')
                    ->options(InvoiceStatus::options()),

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

            ItemsRelationManager::class,

            PaymentsRelationManager::class,

            TimelinesRelationManager::class,

        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [

            'invoice_number',

            'title',

            'project.name',

            'project.client.company_name',

        ];
    }

    public static function getPages(): array
    {
        return [

            'index' => Pages\ListInvoices::route('/'),

            'create' => Pages\CreateInvoice::route('/create'),

            'view' => Pages\ViewInvoice::route('/{record}'),

            'edit' => Pages\EditInvoice::route('/{record}/edit'),

        ];
    }
}