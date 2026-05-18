<x-admin-table 
    title="Gestión de Ubicaciones"
    subtitle="Panel de Administración"
    :createRoute="route('ubicaciones.create')"
    createLabel="Registrar Ubicación"
    :columns="['Lugar', 'Tipo', 'Usuario', 'Coordenadas']"
    :rows="$tableUbicacionesRows"
    :actions="$tableUbicacionesActions"
    emptyMessage="No hay ubicaciones registradas"
/>
