<?php

namespace App\Filament\Resources;

use App\Enums\ProjectStatus;
use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $navigationGroup = 'Invoice Management';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Projects';

    protected static ?string $modelLabel = 'Project';

    protected static ?string $pluralModelLabel = 'Projects';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('Project Information')
                    ->schema([

                        Select::make('client_id')
                            ->relationship('client', 'company_name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->native(false),

                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        Select::make('status')
                            ->options(ProjectStatus::options())
                            ->required()
                            ->native(false),

                    ])
                    ->columns(2),

                Section::make('Schedule')
                    ->schema([

                        DatePicker::make('start_date'),

                        DatePicker::make('end_date'),

                    ])
                    ->columns(2),

                Section::make('Description')
                    ->schema([

                        Textarea::make('description')
                            ->rows(5)
                            ->columnSpanFull(),

                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('client.company_name')
                    ->label('Client')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn (ProjectStatus $state) => $state->label())
                    ->color(fn (ProjectStatus $state) => match ($state) {
                        ProjectStatus::PLANNING => 'gray',
                        ProjectStatus::ACTIVE => 'success',
                        ProjectStatus::COMPLETED => 'primary',
                        ProjectStatus::CANCELLED => 'danger',
                    }),

                TextColumn::make('start_date')
                    ->date(),

                TextColumn::make('end_date')
                    ->date(),

                TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->sortable(),

            ])
            ->defaultSort('created_at', 'desc')
            ->filters([

                Tables\Filters\SelectFilter::make('status')
                    ->options(ProjectStatus::options()),

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
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [
            'name',
            'client.company_name',
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'view' => Pages\ViewProject::route('/{record}'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}