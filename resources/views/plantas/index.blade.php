<x-admin-table 
    title="Gestión de Plantas"
    subtitle="Panel de Administración"
    :createRoute="route('plantas.create')"
    createLabel="Registrar Planta"
    :columns="['Nombre', 'Especie', 'Zona', 'Estado']"
    :rows="$tablePlantasRows"
    :actions="$tablePlantasActions"
    emptyMessage="No hay plantas registradas"
/>
