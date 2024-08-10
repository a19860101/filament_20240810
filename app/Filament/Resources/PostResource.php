<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = '文章';
    
    // protected static ?string $pluralModelLabel = '文章';
    // 英文版的介面會有s的複數狀態，可使用pluraModelLabel修正，若為中文版則不用

    protected static ?string $navigationLabel = '文章管理';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('文章標題')
                    ->placeholder('請輸入文章標題')
                    // ->default('預設值')
                    // ->hint('提示')
                    // ->helperText('就是文章標題')
                    ->required()
                    ->maxLength(400)
                    ->columnSpanFull(),
                
                // Forms\Components\TextInput::make('Website')
                //     ->label('網址')
                //     ->prefix('https://')
                //     ->suffix('.com'),
                Forms\Components\FileUpload::make('cover')
                    ->label('文章封面')
                    ->image()
                    ->imageEditor()
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('content')
                    ->label('文章內容')
                    // ->toolbarButtons(['bold','italic'])
                    // ->disableToolbarButtons(['bold','italic'])
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('published_at')
                    ->label('發布日期')
                    ->default('2024/08/12')
                    // ->mask('9999/99/99')
                    // ->placeholder('YYYY/MM/DD')
                    ->columnSpanFull(),
                Forms\Components\Select::make('category_id')
                    ->label('文章分類')
                    ->relationship('category', 'title')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('文章標題')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ImageColumn::make('cover')
                    ->label('文章封面')
                    ->circular(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('發布日期')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.title')
                    ->label('分類')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                    // ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
