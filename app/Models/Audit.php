<?php

namespace App\Models;

use OwenIt\Auditing\Models\Audit as BaseAudit;
use App\Models\User;

class Audit extends BaseAudit
{

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getAuditableTypeAttribute($value)
    {
        $auditable_types = [
            'App\Models\Student' => 'Estudiante',
            'App\Models\User' => 'Usuario',
            'App\Models\Module' => 'Módulo',
            'App\Models\CategoriesWarehouse' => 'Categoría de Bodega',
            'App\Models\CategoryItem' => 'Categoría de Item',
            'App\Models\MeasurementUnit' => 'Medida de Unidad',
            'App\Models\ModuleStudent' => 'Módulo-Estudiante',
            'App\Models\OperationType' => 'Tipo de operación',
            'App\Models\Period' => 'Periodo',
            'App\Models\Project' => 'Proyecto',
            'App\Models\Responsible' => 'Responsable',
            'App\Models\Warehouse' => 'Bodega',
            'App\Models\Task' => 'Tarea',
            'App\Models\Item' => 'Item',
            'App\Models\Kardex' => 'Kardex',

        ];

        return $auditable_types[$value] ?? $value;
    }

    public function getEventAttribute($value)
    {
        $events = [
            'updated' => 'Actualizado',
            'created' => 'Creado',
            'deleted' => 'Eliminado',
        ];

        return $events[$value] ?? $value;
    }
}
