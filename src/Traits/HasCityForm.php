<?php

namespace Teguh02\IndonesiaTerritoryForms\Traits;

use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Get;
use Illuminate\Support\Collection;
use Teguh02\IndonesiaTerritoryForms\Models\City;

trait HasCityForm 
{
    /**
     * Get the city form
     *
     * @return Select
     */
    static function city_form() : Select
    {
        return Select::make('city_id')
            ->searchable()
            ->preload()
            ->label(__('indonesia-territory-forms::indonesia-territory-forms.city'))
            ->name(config('indonesia-territory-forms.forms_name.city'))
            ->options(function (Get $get): array {
                return filled($get(config('indonesia-territory-forms.forms_name.province')))
                    ? collect(array_map(function($city) {
                        return [
                            'value' => $city['city_id'],
                            'label' => $city['city_name']
                        ];
                    }, app(City::class)->city_by_provincy($get(config('indonesia-territory-forms.forms_name.province'))))) 
                        ->mapWithKeys(fn($city) => [$city['value'] => $city['label']])
                        ->toArray() : [];
            });
    }

}