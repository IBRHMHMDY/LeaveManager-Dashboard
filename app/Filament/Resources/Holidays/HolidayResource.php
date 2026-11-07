<?php

// app/Filament/Resources/HolidayResource.php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\HolidayResource\Pages\CreateHoliday;
use App\Filament\Resources\HolidayResource\Pages\EditHoliday;
use App\Filament\Resources\HolidayResource\Pages\ListHolidays;
use App\Filament\Resources\HolidayResource\Schemas\HolidayForm;
use App\Filament\Resources\HolidayResource\Tables\HolidayTable;
use App\Models\Holiday;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

final class HolidayResource extends Resource
{
    protected static ?string $model = Holiday::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-calendar-days';

    protected static string|UnitEnum|null $navigationGroup = 'System Management';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $form): Schema
    {
        return $form->schema(HolidayForm::schema());
    }

    public static function table(Table $table): Table
    {
        return HolidayTable::make($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHolidays::route('/'),
            'create' => CreateHoliday::route('/create'),
            'edit' => EditHoliday::route('/{record}/edit'),
        ];
    }
}
