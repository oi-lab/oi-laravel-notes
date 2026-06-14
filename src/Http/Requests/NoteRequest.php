<?php

namespace OiLab\OiLaravelNotes\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'message' => [
                'required',
                'string',
            ],
            'files' => ['nullable', 'array', 'max:'.config('oi-laravel-notes.attachments.max_files', 10)],
            'files.*' => ['file', 'max:'.config('oi-laravel-notes.attachments.max_file_size', 10240)],
        ];
    }
}
