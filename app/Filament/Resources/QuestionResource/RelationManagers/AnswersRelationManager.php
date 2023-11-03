<?php

namespace App\Filament\Resources\QuestionResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnswersRelationManager extends RelationManager
{
    protected static string $relationship = 'answers';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\RichEditor::make('content')
                    ->label('Câu trả lời')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('correct')
                    ->label('Đáp án đúng?')
                    ->required()
                    ->default(false),
                Forms\Components\Select::make('status')
                    ->required()
                    ->label('Trạng thái')
                    ->options([
                        'active' => 'Kích hoạt',
                        'inactive' => 'Không kích hoạt'
                    ])
                    ->default('active')
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('content')
            ->columns([
                Tables\Columns\TextColumn::make('content')
                ->html(),
                Tables\Columns\ToggleColumn::make('correct'),
                Tables\Columns\TextColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
