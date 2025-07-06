<?php

namespace App\Http\Requests;

use App\Enums\NotePriorityEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NoteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255'
            ],
            'description' => [
                'required',
                'string'
            ],
            'priority' => [
                'required',
                Rule::enum(NotePriorityEnum::class)
            ],
        ];
    }
}
