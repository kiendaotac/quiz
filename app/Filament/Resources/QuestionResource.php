<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionResource\Pages;
use App\Filament\Resources\QuestionResource\RelationManagers;
use App\Models\Category;
use App\Models\Question;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\RichEditor::make('content')
                    ->required()
                    ->columnSpanFull()
                    ->label('Nội dung câu hỏi'),
                Forms\Components\Select::make('group')
                    ->required()
                    ->label('Nhóm câu hỏi')
                    ->options([
                        1 => 'Dễ',
                        2 => 'Vừa',
                        3 => 'Khó',
                    ])
                    ->default(1),
                Forms\Components\Select::make('category_id')
                    ->required()
                    ->options(Category::whereNotNull('parent_id')->pluck('name', 'id'))
                    ->label('Danh mục'),
                Forms\Components\Select::make('status')
                    ->required()
                    ->label('Trạng thái')
                    ->options([
                        'active'   => 'Kích hoạt',
                        'inactive' => 'Không kích hoạt',
                    ])
                    ->default('active'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('content')
                    ->label('Câu hỏi')
                    ->html()
                    ->limit(),
                Tables\Columns\TextColumn::make('category.name'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Trạng thái'),
                Tables\Columns\TextColumn::make('answers')
                    ->html()
                    ->formatStateUsing(function ($record) {
                        return $record->answers->map(function ($item) {
                            if ($item->correct) {
                                return "<span class='text-danger-600'>{$item->content}</span>";
                            }

                            return $item->content;
                        })->join('');
                    }),
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
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\AnswersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit'   => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }
}
