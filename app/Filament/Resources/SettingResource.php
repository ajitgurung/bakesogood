<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('site_title')
                    ->label('Site Title')
                    ->required()
                    ->columnspan(2),
                TextInput::make('site_email')
                    ->label('Site Email')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->label('Phone Number')
                    ->tel(),
                TextInput::make('address'),
                TextInput::make('google_map_url')
                    ->label('Google Map')
                    ->url(),
                TextInput::make('instagram_url')
                    ->label('Instagram URL')
                    ->url(),
                TextInput::make('facebook_url')
                    ->label('Facebook URL')
                    ->url(),
                FileUpload::make('logo')
                    ->required(),
                FileUpload::make('favicon')
                    ->required(),
                TextInput::make('og_title')
                    ->label('OG Title'),
                TextArea::make('og_description')
                    ->label('OG Description'),
                TextInput::make('meta_title')
                    ->label('Meta Title'),
                TextArea::make('meta_description')
                    ->label('Meta Description'),
                FileUpload::make('og_image')
                    ->label('OG Image'),
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
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
