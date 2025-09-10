<?php

namespace App\Filament\Resources\BookLoanResource\Pages;

use App\Enums\StatusBookEnum;
use App\Filament\Resources\BookLoanResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions;
use Illuminate\Database\Eloquent\Model;

class CreateBookLoan extends CreateRecord
{
    protected static string $resource = BookLoanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['status'] = StatusBookEnum::BORROWED;
        $data['created_by'] = auth()->user()->id;
        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        $book = \App\Models\Book::find($data['book_id']);
        if ($book->status === StatusBookEnum::BORROWED) {
            Notification::make()
                ->title('O livro já está emprestado.🌽')
                ->danger()
                ->send();
            $this->halt();
        }
        $book->status = StatusBookEnum::BORROWED;
        $book->save();
        return static::getModel()::create($data);
    }
}
