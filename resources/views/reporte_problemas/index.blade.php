<x-admin-table
    title="Reportes de problemas"
    subtitle="Panel de Administración"
    :columns="['Usuario', 'Planta', 'Problema', 'Gravedad', 'Estado', 'Fecha']"
    :rows="$tableReportesRows"
    :actions="$tableReportesActions"
    emptyMessage="No hay reportes de problemas registrados"
/>