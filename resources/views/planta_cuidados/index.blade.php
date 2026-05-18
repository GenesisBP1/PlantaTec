<x-admin-table 
    title="Asignar Cuidados"
    subtitle="Panel de Administración"
    :createRoute="route('planta-cuidados.create')"
    createLabel="Asignar Cuidado"
    :columns="['Planta', 'Cuidado', 'Frecuencia', 'Instrucciones']"
    :rows="$tableAsignacionesRows"
    :actions="$tableAsignacionesActions"
    emptyMessage="No hay cuidados asignados"
/>