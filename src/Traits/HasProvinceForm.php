<?php

namespace Teguh02\IndonesiaTerritoryForms\Traits;

use Filament\Forms\Components\Select;
use Filament\Forms\Set;
use Teguh02\IndonesiaTerritoryForms\Models\Province;
use Teguh02\IndonesiaTerritoryForms\Models\City;
trait HasProvinceForm 
{
    /**
     * Get the province form
     *
     * @return Select
     */
    static function province_form() : Select
    {
        return Select::make(config('indonesia-territory-forms.forms_name.province'))
            ->searchable()
            ->preload()
            ->label(__('indonesia-territory-forms::indonesia-territory-forms.province'))
            ->name(config('indonesia-territory-forms.forms_name.province'))
            ->options(fn() => collect(app(Province::class)->all())
                ->mapWithKeys(fn($province) => [$province['prov_id'] => $province['prov_name']]))
            ->live(onBlur: true, debounce: 500);
    }
}