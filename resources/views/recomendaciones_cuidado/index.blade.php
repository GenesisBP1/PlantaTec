<x-admin-table 
    title="Recomendaciones de Cuidado"
    subtitle="Panel de Administración"
    :columns="['Planta', 'Cuidado', 'Mensaje', 'Prioridad', 'Estado']"
    :rows="$tableRecomendacionesRows"
    :actions="$tableRecomendacionesActions"
    emptyMessage="No hay recomendaciones generadas"
/>