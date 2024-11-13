<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutResource\Pages;
use App\Models\About;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;

    protected static ?string $navigationLabel = 'About Page';
    protected static ?string $navigationIcon = 'heroicon-o-information-circle';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    RichEditor::make('description')
                        ->label('About Us Description')
                        ->required(),

                    Repeater::make('why_us')
                        ->label('Why Us')
                        ->itemLabel(fn($state) => $state['title'] ?? 'New Why Us Item')
                        ->schema([
                            TextInput::make('title')
                                ->label('Title')
                                ->required(),
                            TextInput::make('sub_title')
                                ->label('SubTitle')
                                ->required(),
                            TextInput::make('description')
                                ->label('Small Description')
                                ->required(),

                            TextInput::make('icon_class')
                                ->label('Icon Class Name')
                                ->placeholder('e.g., fas fa-check')
                                ->required(),
                        ])
                        ->collapsible()
                        ->createItemButtonLabel('Add Why Us Section'),

                    FileUpload::make('image')
                        ->label('Upload Image')
                        ->image()
                        ->directory('about_images')
                        ->disk('public'), // Make sure to configure your filesystem if needed
                ]),
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
            'index' => Pages\ListAbouts::route('/'),
            'create' => Pages\CreateAbout::route('/create'),
            'edit' => Pages\EditAbout::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->limit(1);
    }
}
