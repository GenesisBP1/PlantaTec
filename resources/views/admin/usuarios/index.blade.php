<x-admin-table 
    title="Gestión de Usuarios"
    subtitle="Panel de Administración"
    :createRoute="route('admin.usuarios.create')"
    createLabel="Crear Usuario"
    :columns="['Nombre', 'Email', 'Rol', 'Registro']"
    :rows="$tableUsuariosRows"
    :actions="$tableUsuariosActions"
    emptyMessage="No hay usuarios registrados"
/>