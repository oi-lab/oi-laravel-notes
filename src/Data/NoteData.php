<?php

namespace OiLab\OiLaravelNotes\Data;

use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

/**
 * Data transfer object describing a polymorphic note.
 */
class NoteData extends Data
{
    public function __construct(
        #[Required]
        public string $message,
        public ?int $id = null,
        #[Nullable]
        public ?string $uuid = null,
        public bool $has_bot = false,
        #[Nullable, Max(255)]
        public ?string $notable_type = null,
        #[Nullable]
        public ?int $notable_id = null,
        #[Nullable]
        public ?int $user_id = null,
    ) {}
}
