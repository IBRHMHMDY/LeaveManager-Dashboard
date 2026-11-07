<?php

// app/Filament/Resources/AppVersion.php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\AppVersions\AppVersionResource\CreateAppVersion;
use App\Filament\Resources\AppVersions\Pages\ListAppVersions;
use App\Filament\Resources\AppVersions\Schemas\AppVersionForm;
use App\Filament\Resources\AppVersions\Tables\AppVersionTable;
use App\Filament\Resources\HolidayResource\Pages\EditAppVersion;
use App\Models\AppVersion;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

final class AppVersionResource extends Resource
{
    protected static ?string $model = AppVersion::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rocket-launch';

    protected static string|UnitEnum|null $navigationGroup = 'System Management';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $form): Schema
    {
        return $form->schema(AppVersionForm::schema());
    }

    public static function table(Table $table): Table
    {
        return AppVersionTable::make($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAppVersions::route('/'),
            'create' => CreateAppVersion::route('/create'),
            'edit' => EditAppVersion::route('/{record}/edit'),
        ];
    }
}
