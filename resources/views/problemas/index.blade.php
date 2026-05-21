<x-admin-table
    title="Gestión de Problemas"
    subtitle="Panel de Administración"
    :createRoute="route('problemas.create')"
    createLabel="Registrar Problema"
    :columns="['Nombre', 'Descripción']"
    :rows="$tableProblemasRows"
    :actions="$tableProblemasActions"
    emptyMessage="No hay problemas registrados"
/>