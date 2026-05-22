<x-app-layout>
    <x-slot name="header">
        <div class="pt-header">
            <div>
                <p class="pt-header-label">Tratamientos</p>
                <h2 class="pt-header-title">Gestión de tratamientos</h2>
                <p class="pt-header-subtitle">Panel de administración</p>
            </div>
            <div class="pt-header-actions">
                <a href="{{ route('tratamientos.create') }}" class="pt-btn pt-btn-green">+ Registrar tratamiento</a>
            </div>
        </div>
    </x-slot>

    <style>
        .pt-page {
    padding: 3.5rem 0;
}

.pt-container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 1.5rem;
}

.pt-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
}

.pt-header-label {
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: #16a34a;
    margin-bottom: 0.25rem;
}

.pt-header-title {
    font-size: 1.5rem;
    font-weight: 800;
    color: #111827;
    line-height: 1.2;
}

.pt-header-subtitle,
.pt-card-subtitle {
    font-size: 0.875rem;
    color: #6b7280;
    margin-top: 0.25rem;
}

.pt-header-actions {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.pt-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.6rem 1rem;
    border-radius: 0.9rem;
    font-size: 0.875rem;
    font-weight: 700;
    text-decoration: none;
    transition: 0.2s ease;
}

.pt-btn-green {
    background: #16a34a;
    color: #ffffff;
}

.pt-btn-green:hover {
    background: #15803d;
}

.pt-btn-light {
    background: #ffffff;
    color: #374151;
    border: 1px solid #e5e7eb;
}

.pt-btn-light:hover {
    background: #f9fafb;
}

.pt-metrics-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.75rem;
    margin-bottom: 3.5rem;
}

.pt-metric-card {
    position: relative;
    overflow: hidden;
    background: #ffffff;
    border: 1px solid #f3f4f6;
    border-radius: 1.25rem;
    padding: 1.5rem;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.04);
    transition: 0.2s ease;
}

.pt-metric-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 24px rgba(0, 0, 0, 0.08);
}

.pt-metric-circle {
    position: absolute;
    top: -12px;
    right: -12px;
    width: 80px;
    height: 80px;
    border-radius: 999px;
    opacity: 0.7;
    transition: 0.2s ease;
}

.pt-metric-card:hover .pt-metric-circle {
    transform: scale(1.1);
}

.pt-metric-card.green .pt-metric-circle { background: #f0fdf4; }
.pt-metric-card.blue .pt-metric-circle { background: #eff6ff; }
.pt-metric-card.violet .pt-metric-circle { background: #f5f3ff; }
.pt-metric-card.amber .pt-metric-circle { background: #fffbeb; }

.pt-metric-content {
    position: relative;
    z-index: 1;
}

.pt-metric-icon {
    width: 42px;
    height: 42px;
    border-radius: 0.9rem;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
    font-size: 1.2rem;
}

.pt-metric-card.green .pt-metric-icon { background: #dcfce7; }
.pt-metric-card.blue .pt-metric-icon { background: #dbeafe; }
.pt-metric-card.violet .pt-metric-icon { background: #ede9fe; }
.pt-metric-card.amber .pt-metric-icon { background: #fef3c7; }

.pt-label {
    font-size: 0.75rem;
    font-weight: 700;
    color: #9ca3af;
    text-transform: uppercase;
    letter-spacing: 0.08em;
}

.pt-number {
    font-size: 1.875rem;
    font-weight: 800;
    color: #111827;
    margin-top: 0.25rem;
}

.pt-link {
    font-size: 0.8rem;
    font-weight: 600;
    text-decoration: none;
    margin-top: 0.35rem;
    display: inline-block;
}

.pt-link:hover {
    text-decoration: underline;
}

.pt-link.green { color: #16a34a; }
.pt-link.violet { color: #7c3aed; }
.pt-link.amber { color: #d97706; }

.pt-muted {
    font-size: 0.75rem;
    color: #9ca3af;
    margin-top: 0.35rem;
    display: inline-block;
}

.pt-info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2.5rem;
    margin-bottom: 3.5rem;
}

.pt-card {
    background: #ffffff;
    border: 1px solid #f3f4f6;
    border-radius: 1.25rem;
    padding: 1.75rem;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.04);
}

.pt-card-header,
.pt-section-header,
.pt-map-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.pt-card-title,
.pt-section-title {
    font-size: 1.05rem;
    font-weight: 800;
    color: #111827;
}

.pt-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.25rem 0.75rem;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 700;
    white-space: nowrap;
}

.pt-badge.green {
    background: #dcfce7;
    color: #15803d;
}

.pt-badge.blue {
    background: #dbeafe;
    color: #1d4ed8;
}

.pt-plant-row {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.pt-plant-image {
    width: 64px;
    height: 64px;
    border-radius: 1rem;
    overflow: hidden;
    flex-shrink: 0;
    background: #f0fdf4;
    border: 1px solid #dcfce7;
}

.pt-plant-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.pt-plant-info {
    min-width: 0;
    flex: 1;
}

.pt-plant-name {
    font-size: 1.125rem;
    font-weight: 800;
    color: #111827;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.pt-text {
    font-size: 0.875rem;
    color: #6b7280;
}

.pt-empty {
    background: #f9fafb;
    border: 1px solid #f3f4f6;
    border-radius: 0.9rem;
    padding: 1rem;
    color: #6b7280;
    font-size: 0.875rem;
}

.pt-empty.center {
    text-align: center;
    padding: 2rem 1rem;
}

.pt-empty-icon {
    font-size: 2rem;
    margin-bottom: 0.75rem;
}

.pt-empty-title {
    color: #4b5563;
    font-weight: 700;
}

.pt-zone-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.pt-zone-item {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 1rem;
    padding: 1rem;
    border-radius: 0.75rem;
    border: 1px solid #dcfce7;
    background: linear-gradient(to right, #f0fdf4, #ffffff);
    transition: 0.2s ease;
}

.pt-zone-item:hover {
    border-color: #86efac;
}

.pt-zone-main {
    flex: 1;
    min-width: 0;
}

.pt-zone-title {
    font-size: 0.875rem;
    font-weight: 800;
    color: #111827;
}

.pt-zone-tags {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-top: 0.35rem;
}

.pt-zone-description {
    font-size: 0.75rem;
    color: #4b5563;
    font-style: italic;
    max-width: 260px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.pt-zone-coords {
    text-align: right;
    flex-shrink: 0;
}

.pt-code {
    font-family: monospace;
    font-size: 0.75rem;
    color: #374151;
}

.pt-section {
    padding: 2.25rem;
    margin-bottom: 3.5rem;
}

.pt-access-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 1rem;
}

.pt-access-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    min-height: 100px;
    border: 1px solid transparent;
    border-radius: 0.9rem;
    padding: 1rem;
    font-size: 0.875rem;
    font-weight: 700;
    text-align: center;
    text-decoration: none;
    transition: 0.2s ease;
}

.pt-access-btn:hover {
    transform: translateY(-2px);
}

.pt-access-icon {
    font-size: 1.5rem;
}

.pt-access-btn.green {
    background: #f0fdf4;
    color: #15803d;
    border-color: #dcfce7;
}

.pt-access-btn.blue {
    background: #eff6ff;
    color: #1d4ed8;
    border-color: #dbeafe;
}

.pt-access-btn.violet {
    background: #f5f3ff;
    color: #6d28d9;
    border-color: #ede9fe;
}

.pt-access-btn.cyan {
    background: #ecfeff;
    color: #0e7490;
    border-color: #cffafe;
}

.pt-access-btn.emerald {
    background: #ecfdf5;
    color: #047857;
    border-color: #d1fae5;
}

.pt-access-btn.orange {
    background: #fff7ed;
    color: #c2410c;
    border-color: #fed7aa;
}

.pt-access-btn.yellow {
    background: #fefce8;
    color: #a16207;
    border-color: #fef08a;
}

.pt-access-btn.red {
    background: #fef2f2;
    color: #b91c1c;
    border-color: #fecaca;
}

.pt-access-btn.gray {
    background: #f9fafb;
    color: #374151;
    border-color: #e5e7eb;
}

.pt-access-btn.pink {
    background: #fdf2f8;
    color: #be185d;
    border-color: #fbcfe8;
}

.pt-map-card {
    margin-top: 5rem;
    margin-bottom: 3.5rem;
    background: #ffffff;
    border: 1px solid #f3f4f6;
    border-radius: 1.25rem;
    overflow: hidden;
    box-shadow: 0 10px 24px rgba(0, 0, 0, 0.08);
}

.pt-map-header {
    padding: 2.25rem;
    border-bottom: 1px solid #e5e7eb;
    margin-bottom: 0;
}

.pt-map-body {
    padding: 2.25rem;
    background: #f9fafb;
}

@media (max-width: 1200px) {
    .pt-access-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

@media (max-width: 1024px) {
    .pt-metrics-grid,
    .pt-info-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .pt-access-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 768px) {
    .pt-page {
        padding: 2rem 0;
    }

    .pt-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .pt-header-actions {
        display: none;
    }

    .pt-metrics-grid,
    .pt-info-grid {
        grid-template-columns: 1fr;
    }

    .pt-access-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .pt-zone-item,
    .pt-card-header,
    .pt-map-header {
        flex-direction: column;
    }

    .pt-zone-coords {
        text-align: left;
    }

}

.pt-user-stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.25rem;
    margin-bottom: 2rem;
}

.pt-user-stat {
    display: block;
    position: relative;
    padding: 1.25rem;
    border-radius: 1.25rem;
    text-decoration: none;
    border: 1px solid transparent;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
    transition: 0.25s ease;
}

.pt-user-stat:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.1);
}

.pt-user-stat.green {
    background: linear-gradient(135deg, #ffffff, #f0fdf4);
    border-color: #dcfce7;
}

.pt-user-stat.red {
    background: linear-gradient(135deg, #ffffff, #fef2f2);
    border-color: #fecaca;
}

.pt-user-stat.amber {
    background: linear-gradient(135deg, #ffffff, #fffbeb);
    border-color: #fde68a;
}

.pt-user-stat.blue {
    background: linear-gradient(135deg, #ffffff, #eff6ff);
    border-color: #bfdbfe;
}

.pt-user-stat-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
}

.pt-user-stat-label {
    font-size: 0.875rem;
    font-weight: 700;
}

.pt-user-stat.green .pt-user-stat-label { color: #16a34a; }
.pt-user-stat.red .pt-user-stat-label { color: #dc2626; }
.pt-user-stat.amber .pt-user-stat-label { color: #d97706; }
.pt-user-stat.blue .pt-user-stat-label { color: #2563eb; }

.pt-user-stat-number {
    font-size: 2.25rem;
    font-weight: 800;
    color: #1f2937;
    margin-top: 0.25rem;
}

.pt-user-number-row {
    display: flex;
    align-items: baseline;
    gap: 0.35rem;
}

.pt-user-small {
    font-size: 0.75rem;
    font-weight: 600;
}

.pt-user-small.red { color: #ef4444; }
.pt-user-small.amber { color: #d97706; }

.pt-user-stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.35rem;
    position: relative;
    flex-shrink: 0;
}

.pt-user-stat.green .pt-user-stat-icon { background: #dcfce7; }
.pt-user-stat.red .pt-user-stat-icon { background: #fee2e2; }
.pt-user-stat.amber .pt-user-stat-icon { background: #fef3c7; }
.pt-user-stat.blue .pt-user-stat-icon { background: #dbeafe; }

.pt-notification-badge,
.pt-action-badge {
    position: absolute;
    top: -6px;
    right: -6px;
    min-width: 20px;
    height: 20px;
    padding: 0 5px;
    border-radius: 999px;
    background: #ef4444;
    color: #ffffff;
    font-size: 0.7rem;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
}

.pt-user-stat-link,
.pt-user-stat-text {
    margin-top: 0.75rem;
    font-size: 0.875rem;
    font-weight: 600;
}

.pt-user-stat-link.green { color: #16a34a; }
.pt-user-stat-link.red { color: #dc2626; }

.pt-user-stat-link:hover {
    text-decoration: underline;
}

.pt-user-stat-text {
    color: #6b7280;
}

.pt-user-actions-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.25rem;
    margin-bottom: 2rem;
}

.pt-user-action {
    display: flex;
    align-items: center;
    gap: 1rem;
    background: #ffffff;
    border: 1px solid #f3f4f6;
    border-radius: 1.25rem;
    padding: 1.25rem;
    text-decoration: none;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
    transition: 0.25s ease;
}

.pt-user-action:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.09);
}

.pt-user-action.green:hover { background: #f0fdf4; }
.pt-user-action.blue:hover { background: #eff6ff; }
.pt-user-action.red:hover { background: #fef2f2; }
.pt-user-action.purple:hover { background: #faf5ff; }

.pt-user-action-icon {
    width: 48px;
    height: 48px;
    border-radius: 0.9rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-size: 1.35rem;
    position: relative;
    flex-shrink: 0;
}

.pt-user-action.green .pt-user-action-icon {
    background: linear-gradient(135deg, #22c55e, #16a34a);
}

.pt-user-action.blue .pt-user-action-icon {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
}

.pt-user-action.red .pt-user-action-icon {
    background: linear-gradient(135deg, #ef4444, #dc2626);
}

.pt-user-action.purple .pt-user-action-icon {
    background: linear-gradient(135deg, #a855f7, #9333ea);
}

.pt-user-action-text {
    flex: 1;
    min-width: 0;
}

.pt-user-action-title {
    font-size: 0.95rem;
    font-weight: 800;
    color: #1f2937;
}

.pt-user-action-subtitle {
    font-size: 0.75rem;
    color: #6b7280;
    margin-top: 0.2rem;
}

.pt-user-arrow {
    color: #9ca3af;
    font-size: 1.8rem;
    line-height: 1;
}

.pt-map-placeholder {
    height: 16rem;
    border-radius: 1rem;
    background: #f3f4f6;
    color: #6b7280;
    display: flex;
    align-items: center;
    justify-content: center;
}

.pt-user-map {
    height: 420px;
    border-radius: 18px;
    margin-top: 1rem;
    overflow: hidden;
}

.pt-user-banner {
    position: relative;
    border-radius: 1.25rem;
    padding: 1.5rem;
    overflow: hidden;
    margin: 2rem 0;
}

.pt-user-banner.active {
    background: linear-gradient(135deg, #16a34a, #059669);
    color: #ffffff;
    box-shadow: 0 10px 24px rgba(22, 163, 74, 0.22);
}

.pt-user-banner.success {
    display: flex;
    align-items: center;
    gap: 1rem;
    background: linear-gradient(135deg, #ecfdf5, #f0fdf4);
    border: 1px solid #dcfce7;
}

.pt-user-banner-content {
    position: relative;
    z-index: 1;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    flex-wrap: wrap;
}

.pt-banner-circle {
    position: absolute;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.12);
}

.pt-banner-circle.one {
    width: 145px;
    height: 145px;
    top: -35px;
    right: -25px;
}

.pt-banner-circle.two {
    width: 85px;
    height: 85px;
    right: 80px;
    bottom: -25px;
}

.pt-banner-small {
    font-size: 0.875rem;
    font-weight: 700;
    color: #dcfce7;
    margin-bottom: 0.25rem;
}

.pt-banner-title {
    font-size: 1.15rem;
    font-weight: 800;
}

.pt-banner-text {
    font-size: 0.875rem;
    color: #dcfce7;
    margin-top: 0.25rem;
}

.pt-banner-btn {
    background: #ffffff;
    color: #15803d;
    padding: 0.7rem 1rem;
    border-radius: 0.9rem;
    font-size: 0.875rem;
    font-weight: 800;
    text-decoration: none;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
}

.pt-banner-btn:hover {
    background: #f0fdf4;
}

.pt-success-icon {
    width: 48px;
    height: 48px;
    border-radius: 999px;
    background: #dcfce7;
    color: #16a34a;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 900;
    font-size: 1.3rem;
    flex-shrink: 0;
}

.pt-success-title {
    font-weight: 800;
    color: #166534;
}

.pt-success-text {
    font-size: 0.875rem;
    color: #16a34a;
    margin-top: 0.2rem;
}

.pt-last-plants-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
}

.pt-last-plant-card {
    background: #f9fafb;
    border-radius: 1rem;
    overflow: hidden;
    transition: 0.25s ease;
}

.pt-last-plant-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 24px rgba(0, 0, 0, 0.08);
}

.pt-last-plant-card img {
    width: 100%;
    height: 145px;
    object-fit: cover;
    transition: 0.25s ease;
}

.pt-last-plant-card:hover img {
    transform: scale(1.04);
}

.pt-last-plant-body {
    padding: 1rem;
}

.pt-last-plant-body h4 {
    font-size: 0.95rem;
    font-weight: 800;
    color: #1f2937;
}

.pt-last-plant-body p {
    font-size: 0.75rem;
    color: #6b7280;
    margin-top: 0.25rem;
}

.pt-last-plant-footer {
    margin-top: 0.9rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

@media (max-width: 1024px) {
    .pt-user-stats-grid,
    .pt-user-actions-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .pt-last-plants-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .pt-user-stats-grid,
    .pt-user-actions-grid,
    .pt-last-plants-grid {
        grid-template-columns: 1fr;
    }

    .pt-user-banner-content {
        align-items: flex-start;
        flex-direction: column;
    }

    .pt-card-header {
        flex-direction: column;
    }
}

.pt-card-body {
    padding: 1.75rem;
}

.pt-adoption-detail {
    overflow: hidden;
}

.pt-adoption-flex {
    display: flex;
    gap: 2rem;
    align-items: flex-start;
}

.pt-adoption-image {
    width: 240px;
    flex-shrink: 0;
    background: #e2f0e6;
    border-radius: 1.5rem;
    padding: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

.pt-adoption-image img {
    width: 100%;
    max-height: 220px;
    object-fit: contain;
    border-radius: 1rem;
}

.pt-adoption-info {
    flex: 1;
    min-width: 0;
}

.pt-info-grid-small {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

.pt-info-box {
    background: #f4fbf2;
    padding: 0.9rem 1rem;
    border-radius: 1rem;
    border-left: 4px solid #2b7840;
}

.pt-info-box strong {
    display: block;
    color: #2b7840;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 0.25rem;
}

.pt-info-box span {
    color: #1e3a2f;
    font-weight: 700;
    font-size: 0.95rem;
}

.pt-description {
    margin-top: 1.25rem;
    color: #374151;
    line-height: 1.7;
}

.pt-description strong {
    color: #111827;
}

.pt-btn-group {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin-top: 1.5rem;
}

.pt-btn-red {
    background: #dc2626;
    color: #ffffff;
}

.pt-btn-red:hover {
    background: #b91c1c;
}

.pt-table-wrapper {
    width: 100%;
    overflow-x: auto;
}

.pt-table {
    width: 100%;
    border-collapse: collapse;
}

.pt-table th,
.pt-table td {
    padding: 0.85rem;
    text-align: left;
    border-bottom: 1px solid #e5e7eb;
    vertical-align: top;
    font-size: 0.875rem;
}

.pt-table th {
    background: #e2f0e6;
    color: #1e3a2f;
    font-size: 0.78rem;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    font-weight: 800;
}

.pt-table td strong {
    color: #1f2937;
}

.pt-table small {
    color: #6b7280;
}

.pt-small-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.45rem 0.85rem;
    border-radius: 999px;
    font-size: 0.8rem;
    font-weight: 800;
    text-decoration: none;
    transition: 0.2s ease;
}

.pt-small-btn.green {
    background: #16a34a;
    color: #ffffff;
}

.pt-small-btn.green:hover {
    background: #15803d;
    transform: translateY(-1px);
}

.pt-history-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem 0;
    border-bottom: 1px solid #f3f4f6;
}

.pt-history-content {
    flex: 1;
}

.pt-history-title {
    font-weight: 800;
    color: #1f2937;
}

.pt-history-title span {
    font-size: 0.75rem;
    color: #6b7280;
    font-weight: 500;
    margin-left: 0.5rem;
}

.pt-history-text {
    color: #4b5563;
    font-size: 0.875rem;
    margin-top: 0.35rem;
    line-height: 1.5;
}

.pt-history-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 0.9rem;
    border: 1px solid #e5e7eb;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.07);
}

.pt-problem-item {
    padding: 1rem 0;
    border-bottom: 1px solid #f3f4f6;
}

.pt-problem-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 1rem;
    flex-wrap: wrap;
}

.pt-problem-header strong {
    color: #1f2937;
}

.pt-status-badge {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 800;
    margin-left: 0.5rem;
}

.pt-status-badge.active {
    background: #fee2e2;
    color: #b91c1c;
}

.pt-status-badge.review {
    background: #fef3c7;
    color: #b45309;
}

.pt-status-badge.solved {
    background: #dcfce7;
    color: #15803d;
}

.pt-table-image {
    width: 64px;
    height: 64px;
    object-fit: cover;
    border-radius: 0.75rem;
    border: 1px solid #e5e7eb;
}

@media (max-width: 768px) {
    .pt-card-body {
        padding: 1.1rem;
    }

    .pt-adoption-flex {
        flex-direction: column;
    }

    .pt-adoption-image {
        width: 100%;
    }

    .pt-info-grid-small {
        grid-template-columns: 1fr;
    }

    .pt-history-item {
        flex-direction: column;
    }

    .pt-table,
    .pt-table thead,
    .pt-table tbody,
    .pt-table tr,
    .pt-table td,
    .pt-table th {
        display: block;
    }

    .pt-table thead {
        display: none;
    }

    .pt-table tr {
        margin-bottom: 1rem;
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
        padding: 0.75rem;
    }

    .pt-table td {
        border: none;
        padding: 0.4rem 0;
    }
}
body {
    margin: 0;
    font-family: 'Figtree', sans-serif;
    background: #f6f8f5;
    color: #1f2937;
}

.pt-app {
    min-height: 100vh;
}

.pt-page-header {
    background: #ffffff;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
}

.pt-page-header-inner {
    max-width: 1280px;
    margin: 0 auto;
    padding: 1.5rem 1rem;
}

.pt-main {
    min-height: calc(100vh - 80px);
}

.pt-toast-wrapper {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 9999;
}

.pt-toast {
    padding: 1rem 1.25rem;
    border-radius: 1rem;
    color: white;
    font-weight: 700;
    min-width: 260px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
}

.pt-toast.success { background: #16a34a; }
.pt-toast.error { background: #dc2626; }
.pt-toast.warning { background: #f59e0b; }
.pt-toast.info { background: #2563eb; }

.pt-toast-close {
    border: none;
    background: transparent;
    color: white;
    font-size: 1.3rem;
    cursor: pointer;
}
.pt-navbar {
    background: #ffffff;
    border-bottom: 1px solid #e5e7eb;
    position: sticky;
    top: 0;
    z-index: 50;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
}

.pt-nav-container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 1rem;
}

.pt-nav-inner {
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.pt-nav-left {
    display: flex;
    align-items: center;
    gap: 2rem;
}

.pt-logo {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    text-decoration: none;
    color: #1f2937;
    font-size: 1.25rem;
    font-weight: 900;
}

.pt-logo-icon {
    width: 34px;
    height: 34px;
    border-radius: 0.9rem;
    background: linear-gradient(135deg, #16a34a, #047857);
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
}

.pt-desktop-menu {
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.pt-nav-link {
    position: relative;
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.6rem 0.85rem;
    border-radius: 0.75rem;
    color: #374151;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 700;
    border: none;
    background: transparent;
    cursor: pointer;
}

.pt-nav-link:hover,
.pt-nav-link.active {
    background: #f0fdf4;
    color: #15803d;
}

.pt-dropdown {
    position: relative;
}

.pt-dropdown-menu,
.pt-user-dropdown {
    position: absolute;
    top: 115%;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 1rem;
    box-shadow: 0 16px 32px rgba(0,0,0,0.12);
    overflow: hidden;
    z-index: 100;
}

.pt-dropdown-menu {
    left: 0;
    width: 270px;
    padding: 0.4rem;
}

.pt-dropdown-menu a,
.pt-user-dropdown a,
.pt-user-dropdown button {
    display: block;
    width: 100%;
    padding: 0.75rem 1rem;
    color: #374151;
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 600;
    background: transparent;
    border: none;
    text-align: left;
    cursor: pointer;
}

.pt-dropdown-menu a:hover,
.pt-user-dropdown a:hover,
.pt-user-dropdown button:hover {
    background: #f0fdf4;
    color: #15803d;
}

.pt-dropdown-menu hr {
    border: none;
    border-top: 1px solid #e5e7eb;
    margin: 0.35rem 0;
}

.pt-nav-notification {
    padding-right: 1.3rem;
}

.pt-nav-badge {
    background: #ef4444;
    color: #ffffff;
    border-radius: 999px;
    font-size: 0.68rem;
    font-weight: 900;
    padding: 0.1rem 0.4rem;
    margin-left: 0.3rem;
}

.pt-user-menu {
    position: relative;
}

.pt-user-btn {
    display: flex;
    align-items: center;
    gap: 0.65rem;
    padding: 0.45rem 0.7rem;
    border-radius: 0.9rem;
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    cursor: pointer;
}

.pt-user-btn:hover {
    background: #f3f4f6;
}

.pt-avatar {
    width: 34px;
    height: 34px;
    border-radius: 999px;
    background: linear-gradient(135deg, #16a34a, #047857);
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 900;
}

.pt-user-text {
    text-align: left;
}

.pt-user-text p {
    margin: 0;
    color: #1f2937;
    font-size: 0.875rem;
    font-weight: 800;
}

.pt-user-text span {
    color: #6b7280;
    font-size: 0.75rem;
}

.pt-user-arrow {
    color: #6b7280;
}

.pt-user-dropdown {
    right: 0;
    width: 230px;
}

.pt-user-info {
    padding: 1rem;
    border-bottom: 1px solid #e5e7eb;
}

.pt-user-info p {
    margin: 0;
    font-weight: 800;
    color: #111827;
}

.pt-user-info span {
    display: block;
    color: #6b7280;
    font-size: 0.75rem;
    overflow: hidden;
    text-overflow: ellipsis;
}

.pt-user-dropdown button {
    color: #dc2626;
}

.pt-mobile-btn {
    display: none;
    border: none;
    background: #f3f4f6;
    color: #374151;
    width: 40px;
    height: 40px;
    border-radius: 0.75rem;
    font-size: 1.4rem;
    cursor: pointer;
}

.pt-mobile-menu {
    display: none;
    background: #ffffff;
    border-top: 1px solid #e5e7eb;
    padding: 0.75rem 1rem;
}

.pt-mobile-menu a,
.pt-mobile-menu button {
    display: block;
    width: 100%;
    padding: 0.75rem;
    border-radius: 0.75rem;
    color: #374151;
    text-decoration: none;
    font-weight: 700;
    border: none;
    background: transparent;
    text-align: left;
}

.pt-mobile-menu a:hover,
.pt-mobile-menu a.active,
.pt-mobile-menu button:hover {
    background: #f0fdf4;
    color: #15803d;
}

.pt-mobile-user {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 0.75rem;
    border-top: 1px solid #e5e7eb;
    margin-top: 0.5rem;
}

.pt-mobile-user p {
    margin: 0;
    font-weight: 800;
    color: #111827;
}

.pt-mobile-user span {
    font-size: 0.8rem;
    color: #6b7280;
}

@media (max-width: 768px) {
    .pt-desktop-menu,
    .pt-user-menu {
        display: none;
    }

    .pt-mobile-btn {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .pt-mobile-menu {
        display: block;
    }
}
.pt-card-body {
    padding: 1.75rem;
}
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: 'Figtree', sans-serif;
    background: #f6f8f5;
    color: #1f2937;
}

p,
h1,
h2,
h3,
h4 {
    margin-top: 0;
}

.pt-page-header {
    background: #ffffff;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
}

.pt-page-header-inner {
    max-width: 1280px;
    margin: 0 auto;
    padding: 1.5rem;
}

.pt-main {
    min-height: calc(100vh - 64px);
}
.pt-catalog-filters {
    background: rgba(255, 255, 255, 0.78);
    backdrop-filter: blur(8px);
    padding: 0.85rem 1.25rem;
    border-radius: 999px;
    margin: 1.5rem 0 2rem;
    display: flex;
    gap: 1rem;
    align-items: center;
    justify-content: space-between;
    border: 1px solid rgba(75, 130, 90, 0.2);
    box-shadow: 0 12px 28px rgba(0, 32, 0, 0.08);
}

.pt-search-box {
    flex: 1;
    position: relative;
}

.pt-search-input,
.pt-filter-select {
    width: 100%;
    padding: 0.75rem 1.1rem;
    border-radius: 999px;
    border: 1px solid #cde0d4;
    background: #ffffff;
    outline: none;
    font-size: 0.9rem;
    font-weight: 600;
    font-family: inherit;
}

.pt-filter-select {
    max-width: 220px;
}

.pt-search-input:focus,
.pt-filter-select:focus {
    border-color: #2b7840;
    box-shadow: 0 0 0 3px rgba(43, 120, 64, 0.1);
}

.pt-suggestions {
    position: absolute;
    top: 110%;
    left: 0;
    right: 0;
    background: #ffffff;
    border-radius: 1.25rem;
    box-shadow: 0 20px 35px rgba(0, 0, 0, 0.12);
    z-index: 100;
    max-height: 300px;
    overflow-y: auto;
    border: 1px solid rgba(75, 130, 90, 0.2);
    display: none;
}

.pt-suggestions ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.pt-suggestions li {
    padding: 0.8rem 1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    cursor: pointer;
    border-bottom: 1px solid #e2ecd9;
}

.pt-suggestions li:hover {
    background: #e2f0e6;
}

.pt-suggestions img {
    width: 42px;
    height: 42px;
    border-radius: 0.8rem;
    object-fit: cover;
}

.pt-suggestions strong {
    display: block;
    color: #1e3a2f;
    font-size: 0.9rem;
}

.pt-suggestions span {
    color: #6f8f7a;
    font-size: 0.75rem;
}

.pt-catalog-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
}

.pt-catalog-card {
    background: #ffffff;
    border-radius: 1.75rem;
    overflow: hidden;
    box-shadow: 0 12px 28px rgba(0, 32, 0, 0.08);
    border: 1px solid rgba(100, 140, 110, 0.2);
    transition: 0.25s ease;
}

.pt-catalog-card:hover {
    transform: translateY(-7px);
    box-shadow: 0 20px 35px rgba(0, 0, 0, 0.12);
    border-color: rgba(75, 130, 90, 0.4);
}

.pt-catalog-card img {
    width: 100%;
    height: 210px;
    object-fit: cover;
    border-bottom: 2px solid #e2f0e6;
    transition: 0.25s ease;
}

.pt-catalog-card:hover img {
    transform: scale(1.02);
}

.pt-catalog-card-body {
    padding: 1.2rem 1.2rem 1.5rem;
}

.pt-catalog-card-body h3 {
    font-size: 1.45rem;
    font-weight: 900;
    color: #1e3a2f;
    margin-bottom: 0.35rem;
}

.pt-catalog-zone {
    font-size: 0.75rem;
    font-weight: 800;
    background: #e2f0e6;
    color: #2b7840;
    display: inline-block;
    padding: 0.35rem 0.9rem;
    border-radius: 999px;
    margin: 0.6rem 0;
}

.pt-catalog-card-body p {
    font-size: 0.9rem;
    color: #6f8f7a;
    margin-bottom: 1.2rem;
    line-height: 1.5;
}

.pt-adopt-btn {
    background: linear-gradient(105deg, #2b7840, #3e8a5a);
    color: #ffffff;
    padding: 0.75rem 1rem;
    border-radius: 999px;
    font-weight: 800;
    width: 100%;
    text-decoration: none;
    transition: 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.pt-adopt-btn:hover {
    background: linear-gradient(105deg, #236a3b, #2b7840);
    transform: scale(0.98);
    box-shadow: 0 8px 18px rgba(43, 120, 64, 0.3);
}

.pt-catalog-empty {
    grid-column: 1 / -1;
}

@media (max-width: 950px) {
    .pt-catalog-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 650px) {
    .pt-catalog-filters {
        flex-direction: column;
        border-radius: 1.25rem;
    }

    .pt-filter-select {
        max-width: 100%;
    }

    .pt-catalog-grid {
        grid-template-columns: 1fr;
    }

    .pt-catalog-card img {
        height: 190px;
    }
}
.hidden {
    display: none !important;
}

.pt-catalog-show-card {
    background: #ffffff;
    border-radius: 2rem;
    box-shadow: 0 20px 35px rgba(0, 32, 0, 0.12);
    margin-bottom: 2rem;
    display: flex;
    overflow: hidden;
    border: 1px solid rgba(100, 140, 110, 0.2);
}

.pt-catalog-show-image {
    flex: 1.2;
    min-width: 280px;
    background: linear-gradient(135deg, #e2f0e6, #c8e0d0);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
}

.pt-catalog-show-image img {
    max-width: 100%;
    max-height: 320px;
    object-fit: contain;
    border-radius: 1.5rem;
    filter: drop-shadow(0 8px 12px rgba(0,0,0,0.1));
}

.pt-catalog-show-info {
    flex: 2;
    padding: 2rem;
    background: #ffffff;
}

.pt-catalog-show-info h3 {
    font-size: 2.1rem;
    font-weight: 900;
    color: #1e3a2f;
    margin-bottom: 0.5rem;
}

.pt-show-section {
    margin-top: 1.5rem;
}

.pt-show-section-title {
    font-size: 1.05rem;
    font-weight: 900;
    color: #166534;
    margin-bottom: 1rem;
}

.pt-care-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 1rem;
}

.pt-care-item {
    background: #f8faf6;
    border-radius: 1.2rem;
    padding: 0.9rem 1rem;
    border-left: 4px solid #2b7840;
}

.pt-care-item strong {
    color: #1e3a2f;
    font-size: 1rem;
}

.pt-care-item p {
    font-size: 0.75rem;
    color: #6f8f7a;
    margin: 0.25rem 0;
}

.pt-care-item span {
    font-size: 0.75rem;
    color: #4b5563;
}

.pt-adoption-form-card {
    margin-top: 1.5rem;
}

.pt-alert-error {
    background: #fee2e2;
    color: #b91c1c;
    border: 1px solid #fecaca;
    padding: 1rem;
    border-radius: 1rem;
    margin: 1rem 0;
}

.pt-alert-error ul {
    margin: 0;
    padding-left: 1.2rem;
}

.pt-radio-group {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    background: #f4fbf2;
    padding: 1rem 1.2rem;
    border-radius: 1.25rem;
}

.pt-radio-group label {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    cursor: pointer;
    font-weight: 600;
    color: #1f2937;
}

.pt-radio-group input[type="radio"] {
    width: 1.1rem;
    height: 1.1rem;
}

.pt-help-text {
    font-size: 0.8rem;
    color: #6b7280;
    margin-top: 0.45rem;
}

.pt-info-message {
    font-size: 0.875rem;
    color: #1d4ed8;
    margin-bottom: 0.75rem;
    font-weight: 600;
}

.pt-location-box {
    margin-top: 0.9rem;
    padding: 0.9rem;
    background: #eff6ff;
    border-radius: 1rem;
    border: 1px solid #bfdbfe;
    color: #1e3a8a;
    font-size: 0.875rem;
}

.pt-location-box p {
    margin: 0;
}

@media (max-width: 768px) {
    .pt-catalog-show-card {
        flex-direction: column;
    }

    .pt-catalog-show-info h3 {
        font-size: 1.7rem;
    }
}


.pt-map-component {
    position: relative;
    width: 100%;
    border-radius: 1rem;
    overflow: hidden;
    border: 1px solid #dbe7df;
    box-shadow: 0 10px 22px rgba(0, 32, 0, 0.08);
}

.pt-map-canvas {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.leaflet-control {
    z-index: 999 !important;
}

.pt-map-toolbar {
    margin-top: 1rem;
    padding: 1rem;
    background: #ffffff;
    border-radius: 1rem;
    border: 1px solid #e5e7eb;
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.05);
}

.pt-map-toolbar-grid {
    display: grid;
    grid-template-columns: 220px 1fr;
    gap: 1rem;
    align-items: center;
}

.pt-map-search {
    display: flex;
    gap: 0.75rem;
}

.pt-map-search input {
    flex: 1;
    padding: 0.75rem 1rem;
    border-radius: 999px;
    border: 1px solid #cde0d4;
    outline: none;
    font-family: inherit;
}

.pt-map-search input:focus {
    border-color: #2b7840;
    box-shadow: 0 0 0 3px rgba(43, 120, 64, 0.12);
}

.pt-map-btn {
    border: none;
    padding: 0.75rem 1rem;
    border-radius: 999px;
    color: #ffffff;
    font-weight: 800;
    cursor: pointer;
    transition: 0.2s ease;
    font-family: inherit;
}

.pt-map-btn.blue {
    background: #2563eb;
}

.pt-map-btn.blue:hover {
    background: #1d4ed8;
}

.pt-map-btn.green {
    background: #16a34a;
}

.pt-map-btn.green:hover {
    background: #15803d;
}

.pt-map-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.pt-map-tip {
    margin-top: 1rem;
    padding: 0.85rem 1rem;
    border-radius: 1rem;
    background: #fffbeb;
    border: 1px solid #fde68a;
    color: #92400e;
    font-size: 0.875rem;
    font-weight: 600;
}

.pt-map-info {
    margin-top: 1rem;
    padding: 1rem;
    background: #ffffff;
    border-radius: 1rem;
    border: 1px solid #e5e7eb;
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.05);
}

.pt-map-info p {
    margin: 0.35rem 0;
    font-size: 0.875rem;
    color: #374151;
}

.pt-map-popup {
    min-width: 180px;
    font-family: inherit;
}

.pt-map-popup h4 {
    margin: 0 0 0.35rem;
    font-size: 0.95rem;
    color: #1e3a2f;
    font-weight: 900;
}

.pt-map-popup p {
    margin: 0.35rem 0;
    font-size: 0.75rem;
    color: #4b5563;
}

.pt-map-popup ul {
    margin: 0.35rem 0 0;
    padding-left: 1rem;
    font-size: 0.75rem;
}

.pt-popup-badge {
    display: inline-block;
    padding: 0.25rem 0.6rem;
    border-radius: 999px;
    font-size: 0.7rem;
    font-weight: 800;
    margin: 0.35rem 0;
}

.pt-popup-badge.green {
    background: #dcfce7;
    color: #15803d;
}

.pt-popup-badge.blue {
    background: #dbeafe;
    color: #1d4ed8;
}

.pt-popup-badge.red {
    background: #fee2e2;
    color: #b91c1c;
}

@media (max-width: 768px) {
    .pt-map-toolbar-grid {
        grid-template-columns: 1fr;
    }

    .pt-map-search {
        flex-direction: column;
    }
}

/* Corrección rápida para mapa y formulario */
.form-group select,
.form-group input,
.form-group textarea,
.pt-form-group select,
.pt-form-group input,
.pt-form-group textarea {
    width: 100%;
    padding: 0.75rem 1rem;
    border-radius: 1rem;
    border: 1px solid #cde0d4;
    font-family: inherit;
    font-size: 0.95rem;
}

.radio-group,
.pt-radio-group {
    background: #f4fbf2;
    padding: 1rem 1.2rem;
    border-radius: 1.2rem;
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.radio-group label,
.pt-radio-group label {
    font-weight: 700;
    color: #1f2937;
}

.obtener-geolocation-btn,
.buscar-ubicacion-btn {
    border: none;
    border-radius: 999px;
    padding: 0.75rem 1.1rem;
    font-weight: 800;
    color: white;
    cursor: pointer;
    font-family: inherit;
}

.obtener-geolocation-btn {
    background: #2563eb;
}

.buscar-ubicacion-btn {
    background: #16a34a;
}

.obtener-geolocation-btn svg,
.buscar-ubicacion-btn svg {
    width: 20px !important;
    height: 20px !important;
}

.btn-adoptar,
.pt-submit-btn {
    width: 100%;
    background: linear-gradient(105deg, #2b7840, #3e8a5a);
    color: white;
    border: none;
    padding: 0.9rem 1.2rem;
    border-radius: 999px;
    font-weight: 900;
    font-size: 1rem;
    cursor: pointer;
    margin-top: 1rem;
}

.btn-adoptar:hover,
.pt-submit-btn:hover {
    background: #236a3b;
}

.bg-blue-50,
.pt-location-box {
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    color: #1e3a8a;
    padding: 0.9rem 1rem;
    border-radius: 1rem;
    margin-top: 1rem;
}

.text-blue-700,
.pt-info-message {
    color: #1d4ed8;
    font-weight: 700;
    margin: 0.8rem 0;
}

.mt-4 {
    margin-top: 1rem;
}

.mt-3 {
    margin-top: 0.75rem;
}

.pt-alert-success {
    background: #dcfce7;
    color: #166534;
    border: 1px solid #86efac;
    padding: 1rem 1.2rem;
    border-radius: 1rem;
    margin-bottom: 1.5rem;
    font-weight: 700;
}

.pt-notifications-list {
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
}

.pt-notification-card {
    background: white;
    border-radius: 1.4rem;
    border-left: 6px solid;
    box-shadow: 0 10px 22px rgba(0, 32, 0, 0.08);
    transition: 0.2s ease;
    overflow: hidden;
}

.pt-notification-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 18px 28px rgba(0,0,0,0.08);
}

.pt-notification-card.general {
    background: #fffbeb;
    border-color: #f59e0b;
}

.pt-notification-card.danger {
    background: #fef2f2;
    border-color: #dc2626;
}

.pt-notification-card.warning {
    background: #fff7ed;
    border-color: #ea580c;
}

.pt-notification-card.today {
    background: #fff7ed;
    border-color: #f97316;
}

.pt-notification-card.info {
    background: #eff6ff;
    border-color: #2563eb;
}

.pt-notification-content {
    padding: 1.4rem;
    display: flex;
    justify-content: space-between;
    gap: 1.5rem;
    align-items: flex-start;
}

.pt-notification-main {
    flex: 1;
}

.pt-notification-top {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex-wrap: wrap;
    margin-bottom: 0.7rem;
}

.pt-notification-top h3 {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 900;
    color: #1f2937;
}

.pt-notification-badge {
    padding: 0.35rem 0.75rem;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 800;
}

.pt-notification-badge.general {
    background: #fde68a;
    color: #92400e;
}

.pt-notification-badge.danger {
    background: #fecaca;
    color: #991b1b;
}

.pt-notification-badge.warning,
.pt-notification-badge.today {
    background: #fdba74;
    color: #9a3412;
}

.pt-notification-badge.info {
    background: #bfdbfe;
    color: #1d4ed8;
}

.pt-notification-message {
    color: #374151;
    line-height: 1.6;
    margin-bottom: 0.75rem;
}

.pt-notification-time {
    font-size: 0.8rem;
    color: #6b7280;
    margin: 0;
}

.pt-notification-actions {
    display: flex;
    flex-direction: column;
    gap: 0.6rem;
    min-width: 150px;
}

.pt-small-btn.blue {
    background: #2563eb;
    color: white;
}

.pt-small-btn.blue:hover {
    background: #1d4ed8;
}

.pt-empty-state {
    background: white;
    padding: 3rem 2rem;
    text-align: center;
    border-radius: 1.5rem;
    box-shadow: 0 10px 22px rgba(0, 32, 0, 0.08);
}

.pt-empty-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.pt-empty-state h3 {
    margin-bottom: 0.5rem;
    color: #1f2937;
}

.pt-empty-state p {
    color: #6b7280;
}

@media (max-width: 768px) {
    .pt-notification-content {
        flex-direction: column;
    }

    .pt-notification-actions {
        width: 100%;
        min-width: unset;
    }
}

.pt-form-container {
    max-width: 900px;
}

.pt-form-card {
    background: #ffffff;
    border-radius: 1.75rem;
    border: 1px solid #dbe7df;
    box-shadow: 0 12px 28px rgba(0, 32, 0, 0.08);
    padding: 2rem;
}

.pt-form-intro {
    margin-bottom: 1.8rem;
}

.pt-form-title {
    font-size: 2rem;
    font-weight: 900;
    color: #1e3a2f;
    margin: 0.4rem 0;
}

.pt-form-subtitle {
    color: #6b7280;
    font-size: 0.95rem;
}

.pt-form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.25rem;
}

.pt-form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.pt-form-group.full {
    grid-column: 1 / -1;
}

.pt-form-group label {
    font-weight: 800;
    color: #374151;
    font-size: 0.92rem;
}

.pt-form-group select,
.pt-form-group input,
.pt-form-group textarea {
    width: 100%;
    padding: 0.85rem 1rem;
    border-radius: 1rem;
    border: 1px solid #cde0d4;
    background: #ffffff;
    font-family: inherit;
    font-size: 0.95rem;
    outline: none;
}

.pt-form-group select:focus,
.pt-form-group input:focus,
.pt-form-group textarea:focus {
    border-color: #2b7840;
    box-shadow: 0 0 0 3px rgba(43, 120, 64, 0.1);
}

.pt-input-inline {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.pt-input-inline span {
    color: #6b7280;
    font-weight: 700;
}

.pt-form-actions {
    margin-top: 2rem;
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.pt-btn-dark {
    background: #475569;
    color: white;
}

.pt-btn-dark:hover {
    background: #334155;
}

@media (max-width: 768px) {
    .pt-form-grid {
        grid-template-columns: 1fr;
    }

    .pt-form-card {
        padding: 1.25rem;
    }

    .pt-form-title {
        font-size: 1.6rem;
    }
}
.pt-admin-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 1.5rem;
    box-shadow: 0 12px 28px rgba(0, 32, 0, 0.08);
    overflow: hidden;
    padding: 1.5rem;
}

.pt-admin-table-wrapper {
    width: 100%;
    overflow-x: auto;
}

.pt-admin-table {
    width: 100%;
    border-collapse: collapse;
}

.pt-admin-table thead tr {
    background: linear-gradient(90deg, #f0fdf4, #ecfdf5);
}

.pt-admin-table th {
    padding: 1rem;
    text-align: left;
    font-size: 0.85rem;
    font-weight: 900;
    color: #374151;
    border-bottom: 1px solid #d1fae5;
    white-space: nowrap;
}

.pt-admin-table td {
    padding: 1rem;
    font-size: 0.875rem;
    color: #374151;
    border-bottom: 1px solid #f3f4f6;
    vertical-align: middle;
}

.pt-admin-table tbody tr {
    transition: 0.2s ease;
}

.pt-admin-table tbody tr:hover {
    background: #f0fdf4;
}

.pt-table-actions {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.pt-table-actions form {
    margin: 0;
}

.pt-action-btn {
    border: 1px solid transparent;
    border-radius: 0.75rem;
    padding: 0.45rem 0.75rem;
    font-size: 0.8rem;
    font-weight: 800;
    text-decoration: none;
    cursor: pointer;
    transition: 0.2s ease;
    font-family: inherit;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.pt-action-btn.view {
    background: #eff6ff;
    color: #2563eb;
    border-color: #bfdbfe;
}

.pt-action-btn.view:hover {
    background: #2563eb;
    color: #ffffff;
}

.pt-action-btn.edit {
    background: #fefce8;
    color: #ca8a04;
    border-color: #fde68a;
}

.pt-action-btn.edit:hover {
    background: #ca8a04;
    color: #ffffff;
}

.pt-action-btn.delete {
    background: #fef2f2;
    color: #dc2626;
    border-color: #fecaca;
}

.pt-action-btn.delete:hover {
    background: #dc2626;
    color: #ffffff;
}

@media (max-width: 768px) {
    .pt-admin-card {
        padding: 1rem;
    }

    .pt-admin-table th,
    .pt-admin-table td {
        padding: 0.75rem;
    }
}
.pt-btn-yellow {
    background: #d97706;
    color: white;
}

.pt-btn-yellow:hover {
    background: #b45309;
}
.pt-detail-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.25rem;
}

.pt-detail-item {
    background: #f8faf6;
    border: 1px solid #dbe7df;
    border-radius: 1.2rem;
    padding: 1rem 1.2rem;
    display: flex;
    flex-direction: column;
    gap: 0.45rem;
}

.pt-detail-item.full {
    grid-column: 1 / -1;
}

.pt-detail-item strong {
    color: #166534;
    font-size: 0.85rem;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 0.04em;
}

.pt-detail-item span {
    color: #374151;
    font-size: 0.95rem;
    line-height: 1.5;
}

@media (max-width: 768px) {
    .pt-detail-grid {
        grid-template-columns: 1fr;
    }

    .pt-detail-item.full {
        grid-column: auto;
    }
}
.pt-admin-table td img,
.pt-admin-table td svg {
    width: 42px;
    height: 42px;
    max-width: 42px;
    max-height: 42px;
    object-fit: cover;
    display: inline-block;
    vertical-align: middle;
}

.pt-admin-table td {
    vertical-align: middle;
}

.pt-admin-table td:first-child {
    font-weight: 700;
    color: #1f2937;
}

.pt-admin-table td:first-child > div,
.pt-admin-table td:first-child .flex,
.pt-admin-table td:first-child .inline-flex {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.pt-admin-table td p,
.pt-admin-table td span {
    margin: 0;
}

.pt-admin-table tbody tr {
    min-height: 72px;
}
.pt-table-name {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.pt-table-icon {
    width: 42px;
    height: 42px;
    border-radius: 0.9rem;
    background: #dcfce7;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
}
.pt-table-name {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.pt-table-icon {
    width: 42px;
    height: 42px;
    min-width: 42px;
    border-radius: 0.9rem;
    background: #dcfce7;
    color: #15803d;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
}
.pt-problem-image {
    width: 260px;
    max-width: 100%;
    border-radius: 1rem;
    object-fit: cover;
    border: 1px solid #dbe7df;
    box-shadow: 0 10px 22px rgba(0, 32, 0, 0.08);
}
.pt-btn-outline {
    background: #f3faf5;
    border: 2px dashed #2b7840;
    color: #1e3a2f;
}

.pt-selected-item {
    margin-top: 10px;
    font-weight: 600;
    color: #2b7840;
}

.pt-modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.65);
    z-index: 9999;
    align-items: center;
    justify-content: center;
}

.pt-modal-content {
    background: white;
    width: 90%;
    max-width: 950px;
    max-height: 85vh;
    overflow-y: auto;
    border-radius: 24px;
}

.pt-modal-header {
    display: flex;
    justify-content: space-between;
    padding: 20px;
    border-bottom: 1px solid #e5e7eb;
}

.pt-close-modal {
    cursor: pointer;
    font-size: 28px;
}

.pt-modal-body {
    padding: 20px;
}

.pt-problemas-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 20px;
}

.pt-problema-card {
    border: 1px solid #dbe7df;
    border-radius: 18px;
    overflow: hidden;
    cursor: pointer;
    transition: .2s;
    background: white;
}

.pt-problema-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 22px rgba(0,0,0,.08);
}

.pt-problema-card img {
    width: 100%;
    height: 160px;
    object-fit: cover;
}

.pt-problema-card-body {
    padding: 14px;
}

.pt-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
}

.pt-badge-success {
    background: #dcfce7;
    color: #166534;
}

.pt-badge-warning {
    background: #fef3c7;
    color: #92400e;
}

.pt-badge-danger {
    background: #fee2e2;
    color: #991b1b;
}

.pt-badge-info {
    background: #dbeafe;
    color: #1d4ed8;
}
.pt-auth-password-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.pt-auth-terms {
    font-size: 0.85rem;
    color: #6b7280;
    line-height: 1.5;
}

.pt-auth-terms a {
    color: #15803d;
    font-weight: 700;
    text-decoration: none;
}

.pt-auth-terms a:hover {
    text-decoration: underline;
}

@media (max-width: 768px) {
    .pt-auth-password-grid {
        grid-template-columns: 1fr;
    }
}
/* =========================
   WELCOME / LANDING PAGE
========================= */

.pt-welcome-body {
    font-family: 'DM Sans', sans-serif;
    background: #fafaf9;
    color: #1f2937;
    min-height: 100vh;
    overflow-x: hidden;
    margin: 0;
}

.pt-welcome-body *,
.pt-welcome-body *::before,
.pt-welcome-body *::after {
    box-sizing: border-box;
}

.pt-welcome-nav {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 50;
    height: 64px;
    padding: 0 2rem;
    background: rgba(250, 250, 249, 0.95);
    backdrop-filter: blur(12px);
    border-bottom: 1px solid rgba(0, 0, 0, 0.06);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.pt-welcome-logo {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    font-size: 1.2rem;
    font-weight: 800;
    color: #166534;
    text-decoration: none;
}

.pt-welcome-links {
    display: flex;
    align-items: center;
    gap: 0.6rem;
}

.pt-welcome-nav-link {
    padding: 0.5rem 1rem;
    border-radius: 0.8rem;
    text-decoration: none;
    color: #374151;
    font-weight: 700;
    transition: 0.2s ease;
}

.pt-welcome-nav-link:hover {
    background: #f3f4f6;
}

.pt-welcome-nav-btn {
    padding: 0.55rem 1.2rem;
    border-radius: 0.8rem;
    background: #16a34a;
    color: #ffffff;
    text-decoration: none;
    font-weight: 800;
    box-shadow: 0 4px 14px rgba(22, 163, 74, 0.25);
    transition: 0.2s ease;
}

.pt-welcome-nav-btn:hover {
    background: #15803d;
}

.pt-welcome-hero {
    min-height: 100vh;
    padding: 120px 2rem 80px;
    background:
        radial-gradient(ellipse 70% 60% at 80% 30%, rgba(187, 247, 208, 0.45) 0%, transparent 65%),
        radial-gradient(ellipse 50% 40% at 10% 80%, rgba(220, 252, 231, 0.35) 0%, transparent 55%),
        #fafaf9;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.pt-welcome-hero-inner {
    max-width: 1100px;
    width: 100%;
    display: grid;
    grid-template-columns: 1fr 1fr;
    align-items: center;
    gap: 5rem;
}

.pt-welcome-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.45rem;
    background: #dcfce7;
    color: #15803d;
    font-size: 0.75rem;
    font-weight: 800;
    padding: 0.35rem 0.9rem;
    border-radius: 999px;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    margin-bottom: 1.25rem;
    border: 1px solid #bbf7d0;
}

.pt-welcome-badge-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #22c55e;
}

.pt-welcome-title {
    font-family: 'DM Serif Display', serif;
    font-size: clamp(2.6rem, 5vw, 3.9rem);
    line-height: 1.08;
    color: #111827;
    margin: 0 0 1.25rem;
}

.pt-welcome-title em {
    color: #15803d;
}

.pt-welcome-description {
    font-size: 1.08rem;
    line-height: 1.7;
    color: #4b5563;
    margin-bottom: 2rem;
    max-width: 44ch;
}

.pt-welcome-actions,
.pt-welcome-cta-actions {
    display: flex;
    gap: 0.8rem;
    flex-wrap: wrap;
}

.pt-welcome-main-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.85rem 1.8rem;
    border-radius: 1rem;
    background: #16a34a;
    color: #ffffff;
    text-decoration: none;
    font-weight: 800;
    box-shadow: 0 6px 18px rgba(22, 163, 74, 0.3);
    transition: 0.2s ease;
}

.pt-welcome-main-btn:hover {
    background: #15803d;
    transform: translateY(-2px);
}

.pt-welcome-secondary-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.85rem 1.8rem;
    border-radius: 1rem;
    background: #ffffff;
    color: #374151;
    text-decoration: none;
    font-weight: 800;
    border: 1.5px solid #e5e7eb;
    transition: 0.2s ease;
}

.pt-welcome-secondary-btn:hover {
    background: #f9fafb;
    transform: translateY(-2px);
}

.pt-welcome-visual {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.pt-welcome-orb {
    width: 380px;
    height: 380px;
    border-radius: 50%;
    background: linear-gradient(135deg, #bbf7d0 0%, #86efac 45%, #4ade80 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 30px 80px rgba(22, 163, 74, 0.2);
    animation: ptWelcomeFloat 8s ease-in-out infinite;
}

.pt-welcome-orb svg {
    width: 140px;
    height: 140px;
    color: #15803d;
    opacity: 0.75;
}

@keyframes ptWelcomeFloat {
    0%, 100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-12px);
    }
}

.pt-welcome-float-card {
    position: absolute;
    background: #ffffff;
    border-radius: 1rem;
    padding: 0.8rem 1rem;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    font-size: 0.85rem;
    font-weight: 800;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    white-space: nowrap;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.pt-float-1 {
    top: 5%;
    left: -8%;
}

.pt-float-2 {
    bottom: 10%;
    right: -10%;
}

.pt-float-3 {
    top: 45%;
    right: -15%;
}

.pt-welcome-section {
    padding: 100px 2rem;
}

.pt-welcome-section.white {
    background: #ffffff;
}

.pt-welcome-section.soft {
    background: #fefcf8;
}

.pt-welcome-section-label {
    text-align: center;
    font-size: 0.78rem;
    font-weight: 900;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: #16a34a;
    margin-bottom: 0.75rem;
}

.pt-welcome-section-title {
    font-family: 'DM Serif Display', serif;
    font-size: clamp(1.9rem, 4vw, 2.8rem);
    color: #111827;
    text-align: center;
    line-height: 1.2;
    margin: 0 0 1rem;
}

.pt-welcome-section-description {
    text-align: center;
    max-width: 55ch;
    margin: 0 auto 4rem;
    color: #4b5563;
    font-size: 1.05rem;
    line-height: 1.7;
}

.pt-welcome-features-grid {
    max-width: 1100px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
}

.pt-welcome-feature-card {
    padding: 2rem;
    border-radius: 1.4rem;
    border: 1.5px solid #f3f4f6;
    background: #ffffff;
    transition: 0.2s ease;
}

.pt-welcome-feature-card:hover {
    border-color: #bbf7d0;
    transform: translateY(-4px);
    box-shadow: 0 12px 40px rgba(22, 163, 74, 0.08);
}

.pt-welcome-feature-icon {
    width: 50px;
    height: 50px;
    border-radius: 1rem;
    background: #dcfce7;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.6rem;
    margin-bottom: 1.25rem;
}

.pt-welcome-feature-card h3 {
    font-weight: 900;
    font-size: 1.05rem;
    color: #111827;
    margin: 0 0 0.5rem;
}

.pt-welcome-feature-card p {
    color: #4b5563;
    line-height: 1.6;
    margin: 0;
}

.pt-welcome-stats {
    padding: 80px 2rem;
    background: linear-gradient(160deg, #14532d 0%, #15803d 100%);
}

.pt-welcome-stats-grid {
    max-width: 900px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
    text-align: center;
}

.pt-welcome-stat-number {
    font-family: 'DM Serif Display', serif;
    font-size: 3rem;
    color: #ffffff;
    margin: 0 0 0.5rem;
}

.pt-welcome-stat-label {
    color: rgba(255, 255, 255, 0.7);
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    font-size: 0.85rem;
    margin: 0;
}

.pt-welcome-plants-grid {
    max-width: 1100px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
}

.pt-welcome-plant-card {
    background: #ffffff;
    border-radius: 1.5rem;
    overflow: hidden;
    border: 1px solid #e5e7eb;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    transition: 0.25s ease;
}

.pt-welcome-plant-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 32px rgba(0, 0, 0, 0.12);
}

.pt-welcome-plant-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.pt-welcome-plant-body {
    padding: 1.25rem;
}

.pt-welcome-plant-body h3 {
    font-family: 'DM Serif Display', serif;
    font-size: 1.35rem;
    color: #111827;
    margin: 0 0 0.5rem;
}

.pt-welcome-plant-body span {
    display: inline-block;
    background: #16a34a;
    color: #ffffff;
    padding: 0.3rem 0.8rem;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 800;
    margin-bottom: 0.8rem;
}

.pt-welcome-plant-body p {
    color: #374151;
    font-size: 0.9rem;
    line-height: 1.5;
    margin: 0 0 1rem;
}

.pt-welcome-outline-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    width: 100%;
    background: transparent;
    border: 1.5px solid #16a34a;
    color: #16a34a;
    padding: 0.7rem 1rem;
    border-radius: 999px;
    font-weight: 800;
    text-decoration: none;
    transition: 0.2s ease;
}

.pt-welcome-outline-btn:hover {
    background: #16a34a;
    color: #ffffff;
}

.pt-welcome-loading,
.pt-welcome-error {
    grid-column: 1 / -1;
    text-align: center;
    padding: 3rem;
}

.pt-welcome-spinner {
    width: 48px;
    height: 48px;
    border: 3px solid #dcfce7;
    border-top-color: #16a34a;
    border-radius: 50%;
    margin: 0 auto 1rem;
    animation: ptWelcomeSpin 0.8s linear infinite;
}

@keyframes ptWelcomeSpin {
    to {
        transform: rotate(360deg);
    }
}

.pt-welcome-error {
    color: #b91c1c;
    background: #fee2e2;
    border-radius: 1rem;
}

.pt-welcome-center {
    text-align: center;
    margin-top: 3rem;
}

.pt-welcome-center .pt-welcome-outline-btn {
    width: auto;
    padding: 0.8rem 2rem;
}

.pt-welcome-cta {
    padding: 100px 2rem;
    text-align: center;
    background: #dffbe8;
}

.pt-welcome-cta h2 {
    font-family: 'DM Serif Display', serif;
    font-size: clamp(2rem, 4vw, 3rem);
    color: #111827;
    margin: 0 0 1rem;
}

.pt-welcome-cta h2 em {
    color: #16a34a;
}

.pt-welcome-cta p {
    font-size: 1.05rem;
    color: #4b5563;
    margin-bottom: 2rem;
}

.pt-welcome-cta-actions {
    justify-content: center;
}

.pt-welcome-footer {
    padding: 2rem;
    text-align: center;
    color: #9ca3af;
    background: #ffffff;
    border-top: 1px solid #f3f4f6;
}

@media (max-width: 900px) {
    .pt-welcome-features-grid,
    .pt-welcome-plants-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .pt-welcome-hero-inner {
        grid-template-columns: 1fr;
        text-align: center;
    }

    .pt-welcome-description {
        margin-left: auto;
        margin-right: auto;
    }

    .pt-welcome-actions {
        justify-content: center;
    }

    .pt-welcome-visual {
        display: none;
    }

    .pt-welcome-features-grid,
    .pt-welcome-plants-grid,
    .pt-welcome-stats-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 600px) {
    .pt-welcome-nav {
        padding: 0 1rem;
    }

    .pt-welcome-nav-link,
    .pt-welcome-nav-btn {
        font-size: 0.8rem;
        padding: 0.45rem 0.75rem;
    }

    .pt-welcome-logo {
        font-size: 1rem;
    }

    .pt-welcome-section,
    .pt-welcome-cta {
        padding: 70px 1rem;
    }
}
.pt-alert-warning {
    background: #fef3c7;
    color: #92400e;
    border: 1px solid #fde68a;
    border-radius: 1rem;
    padding: 1rem 1.25rem;
    font-weight: 700;
}

.pt-history-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.pt-history-item {
    border: 1px solid #dbe7df;
    border-radius: 1rem;
    padding: 1rem;
    background: #f8fbf8;
}

.pt-history-item p {
    margin: 0 0 0.5rem;
}

.pt-history-image {
    width: 160px;
    max-width: 100%;
    border-radius: 0.9rem;
    margin-top: 0.6rem;
    border: 1px solid #dbe7df;
}
.pt-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1.5rem;
}

.pt-form-card {
    width: 100%;
}

.pt-detail-grid {
    gap: 1.3rem;
}

.pt-problem-image {
    width: 280px;
    max-width: 100%;
    height: auto;
}
.pt-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
}

.pt-form-card {
    width: 100%;
    background: #ffffff;
    border-radius: 20px;
    padding: 32px;
    margin-bottom: 24px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
}

.pt-detail-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-top: 20px;
}

.pt-detail-item {
    background: #f8fbf8;
    border: 1px solid #dbe7df;
    border-radius: 14px;
    padding: 18px;
}

.pt-detail-item.full {
    grid-column: span 2;
}

.pt-detail-item strong {
    display: block;
    margin-bottom: 10px;
    font-size: 13px;
    font-weight: 800;
    color: #0f5132;
    text-transform: uppercase;
}

.pt-detail-item span {
    color: #1f2937;
    font-size: 15px;
    line-height: 1.6;
}

.pt-problem-image {
    width: 320px;
    max-width: 100%;
    border-radius: 14px;
    border: 1px solid #dbe7df;
}

.pt-alert-warning {
    background: #fff8db;
    color: #92400e;
    border: 1px solid #fcd34d;
    border-radius: 16px;
    padding: 18px;
    font-weight: 700;
    margin-bottom: 20px;
}

@media (max-width: 768px) {
    .pt-detail-grid {
        grid-template-columns: 1fr;
    }

    .pt-detail-item.full {
        grid-column: span 1;
    }

    .pt-container {
        padding: 0 16px;
    }

    .pt-form-card {
        padding: 20px;
    }
}
    </style>

    <div class="pt-page">
        <div class="pt-container">
            <div class="pt-admin-card">
                <div class="pt-admin-table-wrapper">
                    <table class="pt-admin-table">
                        <thead>
                            <tr>
                                <th>Problema</th>
                                <th>Planta</th>
                                <th>Cuidado</th>
                                <th>Descripción</th>
                                <th>Indicaciones</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tratamientos as $tratamiento)
                                <tr>
                                    <td>{{ $tratamiento->problema->nombre ?? 'Sin problema' }}</td>
                                    <td>{{ $tratamiento->planta->nombre ?? 'General' }}</td>
                                    <td>{{ $tratamiento->cuidado->nombre ?? 'Sin cuidado' }}</td>
                                    <td>{{ Str::limit($tratamiento->descripcion, 50) }}</td>
                                    <td>{{ Str::limit($tratamiento->indicaciones, 50) }}</td>
                                    <td class="pt-table-actions">
                                        <a href="{{ route('tratamientos.show', $tratamiento) }}" class="pt-action-btn view">Ver</a>
                                        <a href="{{ route('tratamientos.edit', $tratamiento) }}" class="pt-action-btn edit">Editar</a>
                                        <form action="{{ route('tratamientos.destroy', $tratamiento) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="pt-action-btn delete" onclick="return confirm('¿Eliminar este tratamiento?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="pt-empty center">No hay tratamientos registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $tratamientos->links() }}
            </div>
        </div>
    </div>
</x-app-layout>