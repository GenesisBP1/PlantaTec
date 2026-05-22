<x-admin-table 
    title="Recomendaciones de Cuidado"
    subtitle="Panel de Administración"
    :createRoute="route('recomendaciones-cuidado.create')"
    createLabel="Registrar Recomendación"
    :columns="['Planta', 'Cuidado', 'Mensaje', 'Prioridad', 'Estado']"
    :rows="$tableRecomendacionesRows"
    :actions="$tableRecomendacionesActions"
    emptyMessage="No hay recomendaciones generadas"
/>