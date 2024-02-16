<?php

namespace App\Filament\Resources;

use App\Filament\Exports\MemberExporter;
use App\Filament\Imports\MemberImporter;
use App\Filament\Resources\MemberResource\Pages;
use App\Filament\Resources\MemberResource\RelationManagers;
use App\Models\Member;
use App\Models\Region;
use Cheesegrits\FilamentPhoneNumbers\Columns\PhoneNumberColumn;
use Cheesegrits\FilamentPhoneNumbers\Forms\Components\PhoneNumber;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationGroup = 'Members Management';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                PhoneNumber::make('phone_number')
                    ->strict()
                    ->mask('+999 999-999-999')
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('id_number')
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\TextInput::make('entry_number')
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\Select::make('region_id')
                    ->relationship('region', 'region')
                    ->searchable()
                    ->preload()
                    ->createOptionForm(Region::getForm())
                    ->editOptionForm(Region::getForm()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                ImportAction::make()
                    ->importer(MemberImporter::class)
                    ->icon('heroicon-o-arrow-down-tray'),
                ExportAction::make()
                    ->exporter(MemberExporter::class)
                    ->icon('heroicon-o-arrow-up-tray'),
            ])
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                PhoneNumberColumn::make('phone_number')
                    ->dial(),
                Tables\Columns\TextColumn::make('id_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('entry_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('region.region')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make()
                        ->color('primary'),
                    Action::make('sendSms')
                        ->icon('heroicon-o-chat-bubble-left-right')
                        ->color('success')
                        ->modalDescription(fn ($record) => 'Draft an sms for ' . $record->name)
                        ->form([
                            RichEditor::make('message')
                                ->required(),
                        ])
                        ->action(function (Member $record, $data) {
                            $message = $data['message'];

                            $record->sendSms($message);
                        })
                        ->after(function($record) {
                            Notification::make()
                                ->success()
                                ->title('Success')
                                ->body('An sms was sent to ' . $record->name)
                                ->send();
                        }),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    BulkAction::make('sendSms')
                        ->icon('heroicon-o-chat-bubble-left-right')
                        ->color('success')
                        ->form([
                            RichEditor::make('message')
                                ->required(),
                        ])
                        ->action(function (Collection $records, $data) {
                            $message = $data['message'];

                            $records->each->sendSms($message);
                        })
                        ->after(function(Collection $records) {
                            Notification::make()
                                ->success()
                                ->title('Success')
                                ->body('An sms was sent to ' . $records->count() . ' members')
                                ->send();
                        }),

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
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'view' => Pages\ViewMember::route('/{record}'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
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
