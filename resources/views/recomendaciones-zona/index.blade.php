<x-admin-table 
    title="Zonas Públicas Recomendadas"
    subtitle="Panel de Administración"
    :createRoute="route('recomendaciones-zona.create')"
    createLabel="Nueva Zona"
    :columns="['Nombre', 'Tipo', 'Descripción', 'Coordenadas']"
    :rows="$tableZonasRows"
    :actions="$tableZonasActions"
    emptyMessage="No hay zonas registradas"
/>
