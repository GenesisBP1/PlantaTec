<x-admin-table 
    title="Gestión de Cuidados"
    subtitle="Panel de Administración"
    :createRoute="route('cuidados.create')"
    createLabel="Registrar Cuidado"
    :columns="['Nombre', 'Descripción']"
    :rows="$tableCuidadosRows"
    :actions="$tableCuidadosActions"
    emptyMessage="No hay cuidados registrados"
/>
