<?php

namespace OiLab\OiLaravelNotes\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use OiLab\OiLaravelNotes\OiNotes;

/**
 * HasNotes Trait
 *
 * Provides the polymorphic notes relationship to any model that can be
 * annotated with notes.
 */
trait HasNotes
{
    /**
     * Get all notes attached to this model.
     *
     * @return MorphMany<Model, $this>
     */
    public function notes(): MorphMany
    {
        return $this->morphMany(OiNotes::noteModel(), 'notable');
    }
}
