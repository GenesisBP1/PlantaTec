<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Mis plantas</p>
                <h2 class="pt-header-title"> Plantas adoptadas</h2>
                <p class="pt-header-subtitle">Registra el cuidado diario y reporta problemas de cada planta</p>
            </div>
            <div class="pt-header-actions">
                <a href="{{ route('catalogo.plantas') }}" class="pt-btn pt-btn-green">+ Adoptar nueva planta</a>
            </div>
        </div>
    </x-slot>

    <style>
        /* ========== ESTILOS ESPECÍFICOS DE "MIS ADOPCIONES" ========== */
        :root {
            --verde-profundo: #1e3a2f;
            --verde-medio: #2b7840;
            --verde-suave: #4c9f6e;
            --verde-claro: #e2f0e6;
            --verde-muy-claro: #f4fbf2;
            --gris-verde: #6f8f7a;
            --blanco: #ffffff;
            --sombra-suave: 0 12px 28px rgba(0, 32, 0, 0.08);
            --sombra-elevada: 0 20px 35px rgba(0, 0, 0, 0.12);
            --border-radius-card: 36px;
            --transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        }
        .pt-page {
            padding: 1rem 0;
        }
        .pt-header-label {
            color: var(--verde-medio);
            font-weight: 600;
        }
        .pt-header-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--verde-profundo);
        }

        .adopciones-container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 1rem 0;
        }
        .plantas-list {
            display: flex;
            flex-direction: column;
            gap: 2rem;
            margin: 2rem 0 3rem;
        }
        .planta-card {
            background: var(--blanco);
            border-radius: var(--border-radius-card);
            padding: 1.8rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 2rem;
            box-shadow: var(--sombra-suave);
            transition: var(--transition);
            border: 1px solid rgba(100, 140, 110, 0.2);
        }
        .planta-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--sombra-elevada);
        }
        .planta-img {
            width: 180px;
            height: 180px;
            border-radius: 32px;
            object-fit: cover;
            box-shadow: 0 12px 22px rgba(0,0,0,0.12);
            border: 3px solid white;
            outline: 1px solid #cde0d4;
            flex-shrink: 0;
            cursor: pointer;
            transition: var(--transition);
        }
        .planta-img:hover { transform: scale(1.02); }
        .sin-imagen {
            width: 180px;
            height: 180px;
            border-radius: 32px;
            background: var(--verde-muy-claro);
            color: var(--verde-profundo);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-weight: 800;
            border: 2px dashed var(--verde-suave);
            padding: 1rem;
        }
        .info-planta { flex: 2; min-width: 250px; }
        .info-planta h3 { font-size: 1.8rem; font-weight: 800; margin-bottom: 0.5rem; }
        .info-planta h3 a { text-decoration: none; color: var(--verde-profundo); transition: color 0.2s; }
        .info-planta h3 a:hover { color: var(--verde-medio); text-decoration: underline; }
        .especie { color: var(--verde-medio); font-weight: 600; margin-bottom: 1rem; }
        .cuidados-list { display: flex; flex-wrap: wrap; gap: 0.8rem; margin: 1rem 0; }
        .cuidado-badge {
            background: var(--verde-claro);
            padding: 0.3rem 1rem;
            border-radius: 40px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--verde-profundo);
        }
        .ultima-evidencia {
            margin-top: 1rem;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f8faf6;
            padding: 0.5rem 1rem;
            border-radius: 60px;
            width: fit-content;
        }
        .ultima-evidencia img {
            width: 40px;
            height: 40px;
            border-radius: 20px;
            object-fit: cover;
        }
        .acciones {
            text-align: center;
            min-width: 200px;
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }
        .btn-evidencia, .btn-problema, .btn-detalle {
            background: var(--blanco);
            border: 1.5px solid var(--verde-medio);
            color: var(--verde-medio);
            padding: 0.7rem 1.2rem;
            border-radius: 60px;
            font-weight: 700;
            cursor: pointer;
            transition: var(--transition);
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-family: 'Inter', sans-serif;
            text-decoration: none;
        }
        .btn-evidencia:hover, .btn-detalle:hover {
            background: var(--verde-medio);
            color: white;
        }
        .btn-problema {
            border-color: #dc2626;
            color: #dc2626;
        }
        .btn-problema:hover {
            background: #dc2626;
            border-color: #dc2626;
            color: white;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.6);
            backdrop-filter: blur(4px);
            align-items: center;
            justify-content: center;
        }
        .modal-content {
            background: var(--blanco);
            margin: auto;
            border-radius: 36px;
            width: 90%;
            max-width: 550px;
            box-shadow: var(--sombra-elevada);
            animation: fadeSlideUp 0.3s ease;
        }
        .modal-header {
            background: var(--verde-claro);
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 36px 36px 0 0;
        }
        .modal-header h4 {
            margin: 0;
            font-weight: 800;
            color: var(--verde-profundo);
        }
        .close-modal {
            font-size: 1.8rem;
            cursor: pointer;
            color: var(--verde-medio);
        }
        .modal-body { padding: 1.8rem; }
        .form-group { margin-bottom: 1.2rem; }
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.3rem;
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.7rem;
            border-radius: 20px;
            border: 1px solid #cde0d4;
        }
        .btn-submit {
            background: var(--verde-medio);
            color: white;
            border: none;
            padding: 0.7rem;
            border-radius: 60px;
            width: 100%;
            font-weight: bold;
            cursor: pointer;
        }
        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .empty-state {
            background: var(--blanco);
            border-radius: 1.5rem;
            padding: 2.5rem;
            text-align: center;
            color: var(--gris-verde);
            box-shadow: var(--sombra-suave);
        }
        .empty-state a {
            color: var(--verde-medio);
            text-decoration: none;
            font-weight: 700;
        }
        .empty-state a:hover { text-decoration: underline; }

        @media (max-width: 850px) {
            .planta-card {
                flex-direction: column;
                text-align: center;
            }
            .info-planta .cuidados-list {
                justify-content: center;
            }
            .ultima-evidencia {
                margin: 0 auto;
            }
            .acciones {
                width: 100%;
            }
        }
    </style>

    <div class="pt-page">
        <div class="pt-container">
            <div class="adopciones-container">
                @if(session('success'))
                    <div class="pt-alert-success" style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 0.75rem; margin-bottom: 1rem;">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="plantas-list">
                    @forelse($adopciones as $adopcion)
                        @php
                            $planta = $adopcion->planta;
                            $cuidadosAsignados = $planta->plantaCuidados ?? collect();
                            $ultimoRegistro = $adopcion->registrosCuidados->sortByDesc('created_at')->first();
                        @endphp

                        <div class="planta-card">
                            <a href="{{ route('adopciones.show', $adopcion) }}">
                                @if($planta->imagen)
                                    <img class="planta-img" src="{{ $planta->imagen }}" alt="{{ $planta->nombre }}">
                                @else
                                    <div class="sin-imagen">Sin imagen registrada</div>
                                @endif
                            </a>

                            <div class="info-planta">
                                <h3><a href="{{ route('adopciones.show', $adopcion) }}">{{ $planta->nombre }}</a></h3>
                                <div class="especie">{{ $planta->especie ?? 'Sin especie registrada' }}</div>

                                <div class="cuidados-list">
                                    @forelse($cuidadosAsignados as $pc)
                                        <span class="cuidado-badge">{{ $pc->cuidado->nombre ?? 'Cuidado' }} cada {{ $pc->frecuencia }} días</span>
                                    @empty
                                        <span class="cuidado-badge">Sin cuidados asignados</span>
                                    @endforelse
                                </div>

                                @if($ultimoRegistro)
                                    <div class="ultima-evidencia">
                                        @if($ultimoRegistro->imagen)
                                            <img src="{{ asset('storage/' . $ultimoRegistro->imagen) }}" alt="evidencia">
                                        @else
                                            <i class="fas fa-leaf"></i>
                                        @endif
                                        <span>Última evidencia: {{ $ultimoRegistro->created_at->diffForHumans() }}</span>
                                    </div>
                                @else
                                    <div class="ultima-evidencia">
                                        <i class="fas fa-info-circle"></i>
                                        <span>Aún no hay registros de cuidado</span>
                                    </div>
                                @endif
                            </div>

                            <div class="acciones">
                                <a href="{{ route('adopciones.show', $adopcion) }}" class="btn-detalle"><i class="fas fa-eye"></i> Ver detalle</a>
                                <button class="btn-evidencia" data-adopcion-id="{{ $adopcion->id }}" data-planta-nombre="{{ $planta->nombre }}"><i class="fas fa-camera"></i> Subir evidencia</button>
                                <a href="{{ route('reporte-problemas.create', ['adopcion_id' => $adopcion->id]) }}" class="btn-problema"><i class="fas fa-exclamation-triangle"></i> Reportar problema</a>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            No tienes plantas adoptadas aún.
                            <a href="{{ route('catalogo.plantas') }}">¡Adopta una!</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para registrar cuidado -->
    <div id="modalCuidado" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Registrar cuidado</h4>
                <span class="close-modal">&times;</span>
            </div>
            <div class="modal-body">
                <form id="formRegistroCuidado" method="POST" enctype="multipart/form-data" action="{{ route('registro-cuidados.store') }}">
                    @csrf
                    <input type="hidden" name="id_adopcion" id="modal_adopcion_id">
                    <div class="form-group">
                        <label>Tipo de cuidado</label>
                        <select name="id_planta_cuidado" id="modal_cuidado_id" required>
                            <option value="">Selecciona un cuidado</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Fecha</label>
                        <input type="datetime-local" name="fecha" value="{{ now()->format('Y-m-d\TH:i') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Imagen (evidencia)</label>
                        <input type="file" name="imagen" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label>Descripción (opcional)</label>
                        <textarea name="descripcion" rows="3" placeholder="Describe lo que hiciste..."></textarea>
                    </div>
                    <button type="submit" class="btn-submit">Guardar registro</button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.querySelectorAll('.btn-evidencia').forEach(btn => {
            btn.addEventListener('click', async function () {
                const adopcionId = this.dataset.adopcionId;
                document.getElementById('modal_adopcion_id').value = adopcionId;
                const selectCuidado = document.getElementById('modal_cuidado_id');
                selectCuidado.innerHTML = '<option value="">Cargando...</option>';
                try {
                    const response = await fetch(`/api/plantas-cuidados/${adopcionId}`);
                    const cuidados = await response.json();
                    selectCuidado.innerHTML = '<option value="">Selecciona un cuidado</option>';
                    cuidados.forEach(c => {
                        const option = document.createElement('option');
                        option.value = c.id;
                        option.textContent = `${c.nombre} cada ${c.frecuencia} días`;
                        selectCuidado.appendChild(option);
                    });
                } catch (error) {
                    selectCuidado.innerHTML = '<option value="">Error al cargar cuidados</option>';
                }
                document.getElementById('modalCuidado').style.display = 'flex';
            });
        });
        document.querySelector('.close-modal').onclick = () => {
            document.getElementById('modalCuidado').style.display = 'none';
        };
        window.onclick = (event) => {
            if (event.target === document.getElementById('modalCuidado')) {
                document.getElementById('modalCuidado').style.display = 'none';
            }
        };
    </script>
    @endpush
</x-app-layout>