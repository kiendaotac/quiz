<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExamResource\Pages;
use App\Filament\Resources\ExamResource\RelationManagers;
use App\Models\Exam;
use App\Models\Question;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExamResource extends Resource
{
    protected static ?string $model = Exam::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->required()
                    ->label('Chọn user')
                    ->options(function () {
                        return User::all()->pluck('name', 'id');
                    }),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Tên bài thi')
                    ->default('Bài thi'),
                Forms\Components\TextInput::make('number_question')
                    ->numeric()
                    ->required()
                    ->label('Số câu hỏi trong bài thi')
                    ->default(15),
                Forms\Components\Select::make('status')
                    ->required()
                    ->label('Trạng thái')
                    ->options([
                        'pending' => 'Chờ tạo bài thi'
                    ])
                    ->default('pending')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('number_question'),
                Tables\Columns\TextColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('generate')
                    ->action(function ($record) {
                        $questions = Question::where('status', 'active')->get();
                        for ($i = 0; $i < $record->number_question; $i++) {
                            $record->questions()->create([
                                'question_id' => $questions->random()->id
                            ]);
                            $record->update(['status' => 'ready']);
                        }
                    })
                    ->requiresConfirmation()
                    ->hidden(function ($record) {
                        return $record->status !== 'pending';
                    })
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
            'index' => Pages\ListExams::route('/'),
            'create' => Pages\CreateExam::route('/create'),
            'view' => Pages\ViewExam::route('/{record}'),
            'edit' => Pages\EditExam::route('/{record}/edit'),
        ];
    }    
}
