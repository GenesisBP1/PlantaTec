<x-admin-table
    title="Gestión de Tratamientos"
    subtitle="Panel de Administración"
    :createRoute="route('tratamientos.create')"
    createLabel="Registrar Tratamiento"
    :columns="['Problema', 'Planta', 'Cuidado', 'Descripción', 'Indicaciones']"
    :rows="$tableTratamientosRows"
    :actions="$tableTratamientosActions"
    emptyMessage="No hay tratamientos registrados"
/>