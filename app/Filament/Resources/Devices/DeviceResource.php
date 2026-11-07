<?php

// app/Filament/Resources/DeviceResource.php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\DeviceResource\Pages\ViewDevice;
use App\Filament\Resources\DeviceResource\Schemas\DeviceForm;
use App\Filament\Resources\DeviceResource\Tables\DeviceTable;
use App\Filament\Resources\Devices\Pages\ListDevices;
use App\Models\Device;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

final class DeviceResource extends Resource
{
    protected static ?string $model = Device::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-device-phone-mobile';

    protected static string|UnitEnum|null $navigationGroup = 'System Management';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->components(DeviceForm::schema());
    }

    public static function table(Table $table): Table
    {
        return DeviceTable::make($table);
    }

    public static function canCreate(): bool
    {
        return false; // Devices are created via API only
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDevices::route('/'),
            'view' => ViewDevice::route('/{record}'),
        ];
    }
}
