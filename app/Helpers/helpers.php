<?php
use Spatie\Valuestore\Valuestore;

function settings() {
    return Valuestore::make(storage_path('app/settings.json'));
}