<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Reporte de problemas</p>
                <h2 class="pt-header-title">Reportar problema</h2>
            </div>
        </div>
    </x-slot>

    <div class="pt-page">
        <div class="pt-container pt-form-container">

            <div class="pt-form-card">
                <div class="pt-form-intro">
                    <p class="pt-header-label">Nuevo reporte</p>
                    <h3 class="pt-form-title">{{ $adopcion->planta->nombre }}</h3>
                    <p class="pt-form-subtitle">
                        Reporta un problema detectado en esta planta adoptada.
                    </p>
                </div>

                @if($errors->any())
                    <div class="pt-alert-error">
                        <p><strong>Revisa los campos del formulario:</strong></p>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('reporte-problemas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id_adopcion" value="{{ $adopcion->id }}">
                    <input type="hidden" name="id_problema" id="id_problema" required>

                    <div class="pt-form-grid">

                        <div class="pt-form-group full">
                            <label>Problema detectado</label>

                            <button type="button" class="pt-btn pt-btn-outline" id="btnAbrirModal">
                                Seleccionar tipo de problema
                            </button>

                            <div id="problemaSeleccionado" class="pt-selected-item"></div>
                        </div>

                        <div class="pt-form-group full">
                            <label>Gravedad</label>
                            <select name="gravedad" required>
                                <option value="leve">Leve</option>
                                <option value="media">Media</option>
                                <option value="grave">Grave</option>
                            </select>
                        </div>

                        <div class="pt-form-group full">
                            <label>Descripción adicional</label>
                            <textarea
                                name="descripcion"
                                rows="5"
                                placeholder="Describe lo que observas en la planta..."
                            >{{ old('descripcion') }}</textarea>
                        </div>

                        <div class="pt-form-group full">
                            <label>Imagen (opcional)</label>
                            <input type="file" name="imagen" accept="image/*">
                        </div>

                    </div>

                    <div class="pt-form-actions">
                        <a href="{{ route('adopciones.show', $adopcion) }}" class="pt-btn pt-btn-dark">
                            Cancelar
                        </a>

                        <button type="submit" class="pt-btn pt-btn-green">
                            Reportar problema
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <!-- MODAL -->
    <div id="modalProblemas" class="pt-modal">
        <div class="pt-modal-content">
            <div class="pt-modal-header">
                <h4>Selecciona un problema</h4>
                <span class="pt-close-modal">&times;</span>
            </div>

            <div class="pt-modal-body">
                <div class="pt-problemas-grid">
                    @foreach($problemas as $problema)
                        <div class="pt-problema-card"
                             data-id="{{ $problema->id }}"
                             data-nombre="{{ $problema->nombre }}">
                            
                            <img src="{{ $problema->imagen ?? 'https://via.placeholder.com/300x160?text=Sin+imagen' }}"
                                 alt="{{ $problema->nombre }}">

                            <div class="pt-problema-card-body">
                                <h5>{{ $problema->nombre }}</h5>
                                <p>{{ Str::limit($problema->descripcion, 60) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        const btnAbrir = document.getElementById('btnAbrirModal');
        const modal = document.getElementById('modalProblemas');
        const closeModal = document.querySelector('.pt-close-modal');
        const idProblemaInput = document.getElementById('id_problema');
        const problemaSeleccionadoDiv = document.getElementById('problemaSeleccionado');

        btnAbrir.onclick = () => {
            modal.style.display = 'flex';
        }

        closeModal.onclick = () => {
            modal.style.display = 'none';
        }

        window.onclick = (event) => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        }

        document.querySelectorAll('.pt-problema-card').forEach(card => {
            card.addEventListener('click', () => {
                const id = card.dataset.id;
                const nombre = card.dataset.nombre;

                idProblemaInput.value = id;
                problemaSeleccionadoDiv.innerHTML =
                    `<strong>Problema seleccionado:</strong> ${nombre}`;

                modal.style.display = 'none';
            });
        });
    </script>
</x-app-layout>