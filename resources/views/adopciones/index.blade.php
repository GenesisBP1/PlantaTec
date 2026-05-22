<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PlantaTec — Detalle de adopción</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700;9..40,800&display=swap" rel="stylesheet">

    <!-- Alpine.js para el dropdown (solo funcionalidad) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* ========== ESTILOS GLOBALES PLANTA TEC ========== */
        /* (Mismo bloque completo que en las páginas anteriores) */
        .pt-page { padding: 3.5rem 0; }
        .pt-container { max-width: 1280px; margin: 0 auto; padding: 0 1.5rem; }
        .pt-header { display: flex; align-items: center; justify-content: space-between; gap: 1rem; }
        .pt-header-label { font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.12em; color: #16a34a; margin-bottom: 0.25rem; }
        .pt-header-title { font-size: 1.5rem; font-weight: 800; color: #111827; line-height: 1.2; }
        .pt-header-subtitle, .pt-card-subtitle { font-size: 0.875rem; color: #6b7280; margin-top: 0.25rem; }
        .pt-header-actions { display: flex; align-items: center; gap: 0.75rem; }
        .pt-btn { display: inline-flex; align-items: center; justify-content: center; padding: 0.6rem 1rem; border-radius: 0.9rem; font-size: 0.875rem; font-weight: 700; text-decoration: none; transition: 0.2s ease; }
        .pt-btn-green { background: #16a34a; color: #ffffff; }
        .pt-btn-green:hover { background: #15803d; }
        .pt-btn-light { background: #ffffff; color: #374151; border: 1px solid #e5e7eb; }
        .pt-btn-light:hover { background: #f9fafb; }
        .pt-metrics-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.75rem; margin-bottom: 3.5rem; }
        .pt-metric-card { position: relative; overflow: hidden; background: #ffffff; border: 1px solid #f3f4f6; border-radius: 1.25rem; padding: 1.5rem; box-shadow: 0 4px 14px rgba(0,0,0,0.04); transition: 0.2s ease; }
        .pt-metric-card:hover { transform: translateY(-3px); box-shadow: 0 10px 24px rgba(0,0,0,0.08); }
        .pt-metric-circle { position: absolute; top: -12px; right: -12px; width: 80px; height: 80px; border-radius: 999px; opacity: 0.7; transition: 0.2s ease; }
        .pt-metric-card:hover .pt-metric-circle { transform: scale(1.1); }
        .pt-metric-card.green .pt-metric-circle { background: #f0fdf4; }
        .pt-metric-card.blue .pt-metric-circle { background: #eff6ff; }
        .pt-metric-card.violet .pt-metric-circle { background: #f5f3ff; }
        .pt-metric-card.amber .pt-metric-circle { background: #fffbeb; }
        .pt-metric-content { position: relative; z-index: 1; }
        .pt-metric-icon { width: 42px; height: 42px; border-radius: 0.9rem; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem; font-size: 1.2rem; }
        .pt-metric-card.green .pt-metric-icon { background: #dcfce7; }
        .pt-metric-card.blue .pt-metric-icon { background: #dbeafe; }
        .pt-metric-card.violet .pt-metric-icon { background: #ede9fe; }
        .pt-metric-card.amber .pt-metric-icon { background: #fef3c7; }
        .pt-label { font-size: 0.75rem; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.08em; }
        .pt-number { font-size: 1.875rem; font-weight: 800; color: #111827; margin-top: 0.25rem; }
        .pt-link { font-size: 0.8rem; font-weight: 600; text-decoration: none; margin-top: 0.35rem; display: inline-block; }
        .pt-link:hover { text-decoration: underline; }
        .pt-link.green { color: #16a34a; }
        .pt-link.violet { color: #7c3aed; }
        .pt-link.amber { color: #d97706; }
        .pt-muted { font-size: 0.75rem; color: #9ca3af; margin-top: 0.35rem; display: inline-block; }
        .pt-info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 2.5rem; margin-bottom: 3.5rem; }
        .pt-card { background: #ffffff; border: 1px solid #f3f4f6; border-radius: 1.25rem; padding: 1.75rem; box-shadow: 0 4px 14px rgba(0,0,0,0.04); }
        .pt-card-header, .pt-section-header, .pt-map-header { display: flex; align-items: flex-start; justify-content: space-between; gap: 1rem; margin-bottom: 1.5rem; }
        .pt-card-title, .pt-section-title { font-size: 1.05rem; font-weight: 800; color: #111827; }
        .pt-badge { display: inline-flex; align-items: center; justify-content: center; padding: 0.25rem 0.75rem; border-radius: 999px; font-size: 0.75rem; font-weight: 700; white-space: nowrap; }
        .pt-badge.green { background: #dcfce7; color: #15803d; }
        .pt-badge.blue { background: #dbeafe; color: #1d4ed8; }
        .pt-plant-row { display: flex; align-items: center; gap: 1rem; }
        .pt-plant-image { width: 64px; height: 64px; border-radius: 1rem; overflow: hidden; flex-shrink: 0; background: #f0fdf4; border: 1px solid #dcfce7; }
        .pt-plant-image img { width: 100%; height: 100%; object-fit: cover; }
        .pt-plant-info { min-width: 0; flex: 1; }
        .pt-plant-name { font-size: 1.125rem; font-weight: 800; color: #111827; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .pt-text { font-size: 0.875rem; color: #6b7280; }
        .pt-empty { background: #f9fafb; border: 1px solid #f3f4f6; border-radius: 0.9rem; padding: 1rem; color: #6b7280; font-size: 0.875rem; }
        .pt-empty.center { text-align: center; padding: 2rem 1rem; }
        .pt-empty-icon { font-size: 2rem; margin-bottom: 0.75rem; }
        .pt-empty-title { color: #4b5563; font-weight: 700; }
        .pt-zone-list { display: flex; flex-direction: column; gap: 0.75rem; }
        .pt-zone-item { display: flex; align-items: flex-start; justify-content: space-between; gap: 1rem; padding: 1rem; border-radius: 0.75rem; border: 1px solid #dcfce7; background: linear-gradient(to right, #f0fdf4, #ffffff); transition: 0.2s ease; }
        .pt-zone-item:hover { border-color: #86efac; }
        .pt-zone-main { flex: 1; min-width: 0; }
        .pt-zone-title { font-size: 0.875rem; font-weight: 800; color: #111827; }
        .pt-zone-tags { display: flex; align-items: center; gap: 0.75rem; margin-top: 0.35rem; }
        .pt-zone-description { font-size: 0.75rem; color: #4b5563; font-style: italic; max-width: 260px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .pt-zone-coords { text-align: right; flex-shrink: 0; }
        .pt-code { font-family: monospace; font-size: 0.75rem; color: #374151; }
        .pt-section { padding: 2.25rem; margin-bottom: 3.5rem; }
        .pt-access-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 1rem; }
        .pt-access-btn { display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 0.5rem; min-height: 100px; border: 1px solid transparent; border-radius: 0.9rem; padding: 1rem; font-size: 0.875rem; font-weight: 700; text-align: center; text-decoration: none; transition: 0.2s ease; }
        .pt-access-btn:hover { transform: translateY(-2px); }
        .pt-access-icon { font-size: 1.5rem; }
        .pt-access-btn.green { background: #f0fdf4; color: #15803d; border-color: #dcfce7; }
        .pt-access-btn.blue { background: #eff6ff; color: #1d4ed8; border-color: #dbeafe; }
        .pt-access-btn.violet { background: #f5f3ff; color: #6d28d9; border-color: #ede9fe; }
        .pt-access-btn.cyan { background: #ecfeff; color: #0e7490; border-color: #cffafe; }
        .pt-access-btn.emerald { background: #ecfdf5; color: #047857; border-color: #d1fae5; }
        .pt-access-btn.orange { background: #fff7ed; color: #c2410c; border-color: #fed7aa; }
        .pt-access-btn.yellow { background: #fefce8; color: #a16207; border-color: #fef08a; }
        .pt-access-btn.red { background: #fef2f2; color: #b91c1c; border-color: #fecaca; }
        .pt-access-btn.gray { background: #f9fafb; color: #374151; border-color: #e5e7eb; }
        .pt-access-btn.pink { background: #fdf2f8; color: #be185d; border-color: #fbcfe8; }
        .pt-map-card { margin-top: 5rem; margin-bottom: 3.5rem; background: #ffffff; border: 1px solid #f3f4f6; border-radius: 1.25rem; overflow: hidden; box-shadow: 0 10px 24px rgba(0,0,0,0.08); }
        .pt-map-header { padding: 2.25rem; border-bottom: 1px solid #e5e7eb; margin-bottom: 0; }
        .pt-map-body { padding: 2.25rem; background: #f9fafb; }
        @media (max-width: 1200px) { .pt-access-grid { grid-template-columns: repeat(4, 1fr); } }
        @media (max-width: 1024px) { .pt-metrics-grid, .pt-info-grid { grid-template-columns: repeat(2, 1fr); } .pt-access-grid { grid-template-columns: repeat(3, 1fr); } }
        @media (max-width: 768px) { .pt-page { padding: 2rem 0; } .pt-header { align-items: flex-start; flex-direction: column; } .pt-header-actions { display: none; } .pt-metrics-grid, .pt-info-grid { grid-template-columns: 1fr; } .pt-access-grid { grid-template-columns: repeat(2, 1fr); } .pt-zone-item, .pt-card-header, .pt-map-header { flex-direction: column; } .pt-zone-coords { text-align: left; } }
        .pt-user-stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.25rem; margin-bottom: 2rem; }
        .pt-user-stat { display: block; position: relative; padding: 1.25rem; border-radius: 1.25rem; text-decoration: none; border: 1px solid transparent; box-shadow: 0 6px 18px rgba(0,0,0,0.06); transition: 0.25s ease; }
        .pt-user-stat:hover { transform: translateY(-4px); box-shadow: 0 14px 28px rgba(0,0,0,0.1); }
        .pt-user-stat.green { background: linear-gradient(135deg, #ffffff, #f0fdf4); border-color: #dcfce7; }
        .pt-user-stat.red { background: linear-gradient(135deg, #ffffff, #fef2f2); border-color: #fecaca; }
        .pt-user-stat.amber { background: linear-gradient(135deg, #ffffff, #fffbeb); border-color: #fde68a; }
        .pt-user-stat.blue { background: linear-gradient(135deg, #ffffff, #eff6ff); border-color: #bfdbfe; }
        .pt-user-stat-content { display: flex; align-items: center; justify-content: space-between; gap: 1rem; }
        .pt-user-stat-label { font-size: 0.875rem; font-weight: 700; }
        .pt-user-stat.green .pt-user-stat-label { color: #16a34a; }
        .pt-user-stat.red .pt-user-stat-label { color: #dc2626; }
        .pt-user-stat.amber .pt-user-stat-label { color: #d97706; }
        .pt-user-stat.blue .pt-user-stat-label { color: #2563eb; }
        .pt-user-stat-number { font-size: 2.25rem; font-weight: 800; color: #1f2937; margin-top: 0.25rem; }
        .pt-user-number-row { display: flex; align-items: baseline; gap: 0.35rem; }
        .pt-user-small { font-size: 0.75rem; font-weight: 600; }
        .pt-user-small.red { color: #ef4444; }
        .pt-user-small.amber { color: #d97706; }
        .pt-user-stat-icon { width: 48px; height: 48px; border-radius: 1rem; display: flex; align-items: center; justify-content: center; font-size: 1.35rem; position: relative; flex-shrink: 0; }
        .pt-user-stat.green .pt-user-stat-icon { background: #dcfce7; }
        .pt-user-stat.red .pt-user-stat-icon { background: #fee2e2; }
        .pt-user-stat.amber .pt-user-stat-icon { background: #fef3c7; }
        .pt-user-stat.blue .pt-user-stat-icon { background: #dbeafe; }
        .pt-notification-badge, .pt-action-badge { position: absolute; top: -6px; right: -6px; min-width: 20px; height: 20px; padding: 0 5px; border-radius: 999px; background: #ef4444; color: #ffffff; font-size: 0.7rem; font-weight: 800; display: flex; align-items: center; justify-content: center; }
        .pt-user-stat-link, .pt-user-stat-text { margin-top: 0.75rem; font-size: 0.875rem; font-weight: 600; }
        .pt-user-stat-link.green { color: #16a34a; }
        .pt-user-stat-link.red { color: #dc2626; }
        .pt-user-stat-link:hover { text-decoration: underline; }
        .pt-user-stat-text { color: #6b7280; }
        .pt-user-actions-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.25rem; margin-bottom: 2rem; }
        .pt-user-action { display: flex; align-items: center; gap: 1rem; background: #ffffff; border: 1px solid #f3f4f6; border-radius: 1.25rem; padding: 1.25rem; text-decoration: none; box-shadow: 0 6px 18px rgba(0,0,0,0.06); transition: 0.25s ease; }
        .pt-user-action:hover { transform: translateY(-3px); box-shadow: 0 12px 24px rgba(0,0,0,0.09); }
        .pt-user-action.green:hover { background: #f0fdf4; }
        .pt-user-action.blue:hover { background: #eff6ff; }
        .pt-user-action.red:hover { background: #fef2f2; }
        .pt-user-action.purple:hover { background: #faf5ff; }
        .pt-user-action-icon { width: 48px; height: 48px; border-radius: 0.9rem; display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 1.35rem; position: relative; flex-shrink: 0; }
        .pt-user-action.green .pt-user-action-icon { background: linear-gradient(135deg, #22c55e, #16a34a); }
        .pt-user-action.blue .pt-user-action-icon { background: linear-gradient(135deg, #3b82f6, #2563eb); }
        .pt-user-action.red .pt-user-action-icon { background: linear-gradient(135deg, #ef4444, #dc2626); }
        .pt-user-action.purple .pt-user-action-icon { background: linear-gradient(135deg, #a855f7, #9333ea); }
        .pt-user-action-text { flex: 1; min-width: 0; }
        .pt-user-action-title { font-size: 0.95rem; font-weight: 800; color: #1f2937; }
        .pt-user-action-subtitle { font-size: 0.75rem; color: #6b7280; margin-top: 0.2rem; }
        .pt-user-arrow { color: #9ca3af; font-size: 1.8rem; line-height: 1; }
        .pt-map-placeholder { height: 16rem; border-radius: 1rem; background: #f3f4f6; color: #6b7280; display: flex; align-items: center; justify-content: center; }
        .pt-user-map { height: 420px; border-radius: 18px; margin-top: 1rem; overflow: hidden; }
        .pt-user-banner { position: relative; border-radius: 1.25rem; padding: 1.5rem; overflow: hidden; margin: 2rem 0; }
        .pt-user-banner.active { background: linear-gradient(135deg, #16a34a, #059669); color: #ffffff; box-shadow: 0 10px 24px rgba(22,163,74,0.22); }
        .pt-user-banner.success { display: flex; align-items: center; gap: 1rem; background: linear-gradient(135deg, #ecfdf5, #f0fdf4); border: 1px solid #dcfce7; }
        .pt-user-banner-content { position: relative; z-index: 1; display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap; }
        .pt-banner-circle { position: absolute; border-radius: 999px; background: rgba(255,255,255,0.12); }
        .pt-banner-circle.one { width: 145px; height: 145px; top: -35px; right: -25px; }
        .pt-banner-circle.two { width: 85px; height: 85px; right: 80px; bottom: -25px; }
        .pt-banner-small { font-size: 0.875rem; font-weight: 700; color: #dcfce7; margin-bottom: 0.25rem; }
        .pt-banner-title { font-size: 1.15rem; font-weight: 800; }
        .pt-banner-text { font-size: 0.875rem; color: #dcfce7; margin-top: 0.25rem; }
        .pt-banner-btn { background: #ffffff; color: #15803d; padding: 0.7rem 1rem; border-radius: 0.9rem; font-size: 0.875rem; font-weight: 800; text-decoration: none; box-shadow: 0 4px 12px rgba(0,0,0,0.12); }
        .pt-banner-btn:hover { background: #f0fdf4; }
        .pt-success-icon { width: 48px; height: 48px; border-radius: 999px; background: #dcfce7; color: #16a34a; display: flex; align-items: center; justify-content: center; font-weight: 900; font-size: 1.3rem; flex-shrink: 0; }
        .pt-success-title { font-weight: 800; color: #166534; }
        .pt-success-text { font-size: 0.875rem; color: #16a34a; margin-top: 0.2rem; }
        .pt-last-plants-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; }
        .pt-last-plant-card { background: #f9fafb; border-radius: 1rem; overflow: hidden; transition: 0.25s ease; }
        .pt-last-plant-card:hover { transform: translateY(-3px); box-shadow: 0 10px 24px rgba(0,0,0,0.08); }
        .pt-last-plant-card img { width: 100%; height: 145px; object-fit: cover; transition: 0.25s ease; }
        .pt-last-plant-card:hover img { transform: scale(1.04); }
        .pt-last-plant-body { padding: 1rem; }
        .pt-last-plant-body h4 { font-size: 0.95rem; font-weight: 800; color: #1f2937; }
        .pt-last-plant-body p { font-size: 0.75rem; color: #6b7280; margin-top: 0.25rem; }
        .pt-last-plant-footer { margin-top: 0.9rem; display: flex; align-items: center; justify-content: space-between; }
        @media (max-width: 1024px) { .pt-user-stats-grid, .pt-user-actions-grid { grid-template-columns: repeat(2, 1fr); } .pt-last-plants-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 768px) { .pt-user-stats-grid, .pt-user-actions-grid, .pt-last-plants-grid { grid-template-columns: 1fr; } .pt-user-banner-content { align-items: flex-start; flex-direction: column; } .pt-card-header { flex-direction: column; } }
        .pt-card-body { padding: 1.75rem; }
        .pt-adoption-detail { overflow: hidden; }
        .pt-adoption-flex { display: flex; gap: 2rem; align-items: flex-start; }
        .pt-adoption-image { width: 240px; flex-shrink: 0; background: #e2f0e6; border-radius: 1.5rem; padding: 1rem; display: flex; align-items: center; justify-content: center; }
        .pt-adoption-image img { width: 100%; max-height: 220px; object-fit: contain; border-radius: 1rem; }
        .pt-adoption-info { flex: 1; min-width: 0; }
        .pt-info-grid-small { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; }
        .pt-info-box { background: #f4fbf2; padding: 0.9rem 1rem; border-radius: 1rem; border-left: 4px solid #2b7840; }
        .pt-info-box strong { display: block; color: #2b7840; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem; }
        .pt-info-box span { color: #1e3a2f; font-weight: 700; font-size: 0.95rem; }
        .pt-description { margin-top: 1.25rem; color: #374151; line-height: 1.7; }
        .pt-description strong { color: #111827; }
        .pt-btn-group { display: flex; flex-wrap: wrap; gap: 1rem; margin-top: 1.5rem; }
        .pt-btn-red { background: #dc2626; color: #ffffff; }
        .pt-btn-red:hover { background: #b91c1c; }
        .pt-table-wrapper { width: 100%; overflow-x: auto; }
        .pt-table { width: 100%; border-collapse: collapse; }
        .pt-table th, .pt-table td { padding: 0.85rem; text-align: left; border-bottom: 1px solid #e5e7eb; vertical-align: top; font-size: 0.875rem; }
        .pt-table th { background: #e2f0e6; color: #1e3a2f; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.04em; font-weight: 800; }
        .pt-table td strong { color: #1f2937; }
        .pt-table small { color: #6b7280; }
        .pt-small-btn { display: inline-flex; align-items: center; justify-content: center; padding: 0.45rem 0.85rem; border-radius: 999px; font-size: 0.8rem; font-weight: 800; text-decoration: none; transition: 0.2s ease; }
        .pt-small-btn.green { background: #16a34a; color: #ffffff; }
        .pt-small-btn.green:hover { background: #15803d; transform: translateY(-1px); }
        .pt-history-item { display: flex; align-items: flex-start; gap: 1rem; padding: 1rem 0; border-bottom: 1px solid #f3f4f6; }
        .pt-history-content { flex: 1; }
        .pt-history-title { font-weight: 800; color: #1f2937; }
        .pt-history-title span { font-size: 0.75rem; color: #6b7280; font-weight: 500; margin-left: 0.5rem; }
        .pt-history-text { color: #4b5563; font-size: 0.875rem; margin-top: 0.35rem; line-height: 1.5; }
        .pt-history-image { width: 80px; height: 80px; object-fit: cover; border-radius: 0.9rem; border: 1px solid #e5e7eb; box-shadow: 0 4px 12px rgba(0,0,0,0.07); }
        .pt-problem-item { padding: 1rem 0; border-bottom: 1px solid #f3f4f6; }
        .pt-problem-header { display: flex; align-items: flex-start; justify-content: space-between; gap: 1rem; flex-wrap: wrap; }
        .pt-problem-header strong { color: #1f2937; }
        .pt-status-badge { display: inline-block; padding: 0.25rem 0.75rem; border-radius: 999px; font-size: 0.75rem; font-weight: 800; margin-left: 0.5rem; }
        .pt-status-badge.active { background: #fee2e2; color: #b91c1c; }
        .pt-status-badge.review { background: #fef3c7; color: #b45309; }
        .pt-status-badge.solved { background: #dcfce7; color: #15803d; }
        .pt-table-image { width: 64px; height: 64px; object-fit: cover; border-radius: 0.75rem; border: 1px solid #e5e7eb; }
        @media (max-width: 768px) { .pt-card-body { padding: 1.1rem; } .pt-adoption-flex { flex-direction: column; } .pt-adoption-image { width: 100%; } .pt-info-grid-small { grid-template-columns: 1fr; } .pt-history-item { flex-direction: column; } .pt-table, .pt-table thead, .pt-table tbody, .pt-table tr, .pt-table td, .pt-table th { display: block; } .pt-table thead { display: none; } .pt-table tr { margin-bottom: 1rem; border: 1px solid #e5e7eb; border-radius: 1rem; padding: 0.75rem; } .pt-table td { border: none; padding: 0.4rem 0; } }
        body { margin: 0; font-family: 'DM Sans', 'Figtree', sans-serif; background: #f6f8f5; color: #1f2937; }
        .pt-app { min-height: 100vh; }
        .pt-page-header { background: #ffffff; box-shadow: 0 2px 12px rgba(0,0,0,0.05); }
        .pt-page-header-inner { max-width: 1280px; margin: 0 auto; padding: 1.5rem 1rem; }
        .pt-main { min-height: calc(100vh - 80px); }
        .pt-toast-wrapper { position: fixed; bottom: 20px; right: 20px; z-index: 9999; }
        .pt-toast { padding: 1rem 1.25rem; border-radius: 1rem; color: white; font-weight: 700; min-width: 260px; display: flex; justify-content: space-between; align-items: center; gap: 1rem; }
        .pt-toast.success { background: #16a34a; }
        .pt-toast.error { background: #dc2626; }
        .pt-toast.warning { background: #f59e0b; }
        .pt-toast.info { background: #2563eb; }
        .pt-toast-close { border: none; background: transparent; color: white; font-size: 1.3rem; cursor: pointer; }
        .pt-navbar { background: #ffffff; border-bottom: 1px solid #e5e7eb; position: sticky; top: 0; z-index: 50; box-shadow: 0 2px 12px rgba(0,0,0,0.04); }
        .pt-nav-container { max-width: 1280px; margin: 0 auto; padding: 0 1rem; }
        .pt-nav-inner { height: 64px; display: flex; align-items: center; justify-content: space-between; }
        .pt-nav-left { display: flex; align-items: center; gap: 2rem; }
        .pt-logo { display: flex; align-items: center; gap: 0.6rem; text-decoration: none; color: #1f2937; font-size: 1.25rem; font-weight: 900; }
        .pt-logo-icon { width: 34px; height: 34px; border-radius: 0.9rem; background: linear-gradient(135deg, #16a34a, #047857); color: #ffffff; display: flex; align-items: center; justify-content: center; }
        .pt-desktop-menu { display: flex; align-items: center; gap: 0.25rem; }
        .pt-nav-link { position: relative; display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.6rem 0.85rem; border-radius: 0.75rem; color: #374151; text-decoration: none; font-size: 0.9rem; font-weight: 700; border: none; background: transparent; cursor: pointer; }
        .pt-nav-link:hover, .pt-nav-link.active { background: #f0fdf4; color: #15803d; }
        .pt-dropdown { position: relative; }
        .pt-dropdown-menu, .pt-user-dropdown { position: absolute; top: 115%; background: #ffffff; border: 1px solid #e5e7eb; border-radius: 1rem; box-shadow: 0 16px 32px rgba(0,0,0,0.12); overflow: hidden; z-index: 100; }
        .pt-dropdown-menu { left: 0; width: 270px; padding: 0.4rem; }
        .pt-dropdown-menu a, .pt-user-dropdown a, .pt-user-dropdown button { display: block; width: 100%; padding: 0.75rem 1rem; color: #374151; text-decoration: none; font-size: 0.875rem; font-weight: 600; background: transparent; border: none; text-align: left; cursor: pointer; }
        .pt-dropdown-menu a:hover, .pt-user-dropdown a:hover, .pt-user-dropdown button:hover { background: #f0fdf4; color: #15803d; }
        .pt-dropdown-menu hr { border: none; border-top: 1px solid #e5e7eb; margin: 0.35rem 0; }
        .pt-nav-notification { padding-right: 1.3rem; }
        .pt-nav-badge { background: #ef4444; color: #ffffff; border-radius: 999px; font-size: 0.68rem; font-weight: 900; padding: 0.1rem 0.4rem; margin-left: 0.3rem; }
        .pt-user-menu { position: relative; }
        .pt-user-btn { display: flex; align-items: center; gap: 0.65rem; padding: 0.45rem 0.7rem; border-radius: 0.9rem; background: #f9fafb; border: 1px solid #e5e7eb; cursor: pointer; }
        .pt-user-btn:hover { background: #f3f4f6; }
        .pt-avatar { width: 34px; height: 34px; border-radius: 999px; background: linear-gradient(135deg, #16a34a, #047857); color: #ffffff; display: flex; align-items: center; justify-content: center; font-weight: 900; }
        .pt-user-text { text-align: left; }
        .pt-user-text p { margin: 0; color: #1f2937; font-size: 0.875rem; font-weight: 800; }
        .pt-user-text span { color: #6b7280; font-size: 0.75rem; }
        .pt-user-arrow { color: #6b7280; }
        .pt-user-dropdown { right: 0; width: 230px; }
        .pt-user-info { padding: 1rem; border-bottom: 1px solid #e5e7eb; }
        .pt-user-info p { margin: 0; font-weight: 800; color: #111827; }
        .pt-user-info span { display: block; color: #6b7280; font-size: 0.75rem; overflow: hidden; text-overflow: ellipsis; }
        .pt-user-dropdown button { color: #dc2626; }
        .pt-mobile-btn { display: none; border: none; background: #f3f4f6; color: #374151; width: 40px; height: 40px; border-radius: 0.75rem; font-size: 1.4rem; cursor: pointer; }
        .pt-mobile-menu { display: none; background: #ffffff; border-top: 1px solid #e5e7eb; padding: 0.75rem 1rem; }
        .pt-mobile-menu a, .pt-mobile-menu button { display: block; width: 100%; padding: 0.75rem; border-radius: 0.75rem; color: #374151; text-decoration: none; font-weight: 700; border: none; background: transparent; text-align: left; }
        .pt-mobile-menu a:hover, .pt-mobile-menu a.active, .pt-mobile-menu button:hover { background: #f0fdf4; color: #15803d; }
        .pt-mobile-user { display: flex; align-items: center; gap: 0.75rem; padding: 1rem 0.75rem; border-top: 1px solid #e5e7eb; margin-top: 0.5rem; }
        .pt-mobile-user p { margin: 0; font-weight: 800; color: #111827; }
        .pt-mobile-user span { font-size: 0.8rem; color: #6b7280; }
        @media (max-width: 768px) { .pt-desktop-menu, .pt-user-menu { display: none; } .pt-mobile-btn { display: flex; align-items: center; justify-content: center; } .pt-mobile-menu { display: block; } }
        * { box-sizing: border-box; }
        p, h1, h2, h3, h4 { margin-top: 0; }
    </style>
</head>

<body class="pt-app">

    <!-- ========== BARRA DE NAVEGACIÓN (con Alpine.js) ========== -->
    <nav x-data="{ open: false }" class="pt-navbar">
        <div class="pt-nav-container">
            <div class="pt-nav-inner">

                <div class="pt-nav-left">
                    <a href="{{ route('dashboard') }}" class="pt-logo">
                        <div class="pt-logo-icon">🌿</div>
                        <span>PlantaTec</span>
                    </a>

                    <div class="pt-desktop-menu">
                        <a href="{{ route('dashboard') }}" class="pt-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            Dashboard
                        </a>

                        @if(auth()->user()->rol === 'admin')
                            <div class="pt-dropdown" x-data="{ adminOpen: false }">
                                <button @click="adminOpen = !adminOpen" @click.away="adminOpen = false" class="pt-nav-link pt-dropdown-btn">
                                    Administración
                                    <span>⌄</span>
                                </button>

                                <div x-show="adminOpen" x-transition class="pt-dropdown-menu" style="display:none;">
                                    <a href="{{ route('plantas.index') }}">Plantas</a>
                                    <a href="{{ route('adopciones.index') }}">Adopciones</a>
                                    <a href="{{ route('ubicaciones.index') }}">Ubicaciones</a>
                                    <a href="{{ route('cuidados.index') }}">Cuidados</a>
                                    <a href="{{ route('planta-cuidados.index') }}">Asignar cuidados</a>
                                    <a href="{{ route('recomendaciones-cuidado.index') }}">Recomendaciones de cuidado</a>
                                    <a href="{{ route('recomendaciones-zona.index') }}">Recomendaciones de zona</a>
                                    <a href="{{ route('problemas.index') }}">Problemas</a>
                                    <a href="{{ route('tratamientos.index') }}">Tratamientos</a>
                                    <hr>
                                    <a href="{{ route('reporte-problemas.index') }}">Reportes de problemas</a>
                                    <a href="{{ route('admin.usuarios.index') }}">Usuarios</a>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('catalogo.plantas') }}" class="pt-nav-link {{ request()->routeIs('catalogo.plantas') ? 'active' : '' }}">
                                Catálogo
                            </a>

                            <a href="{{ route('adopciones.index') }}" class="pt-nav-link {{ request()->routeIs('adopciones.*') ? 'active' : '' }}">
                                Mis adopciones
                            </a>

                            @php
                                $notificacionesNoLeidas = \App\Models\Notificacion::where('id_usuario', auth()->id())->where('leida', false)->count();
                            @endphp

                            <a href="{{ route('notificaciones.index') }}" class="pt-nav-link pt-nav-notification {{ request()->routeIs('notificaciones.*') ? 'active' : '' }}">
                                Notificaciones
                                @if($notificacionesNoLeidas > 0)
                                    <span class="pt-nav-badge">
                                        {{ $notificacionesNoLeidas > 9 ? '9+' : $notificacionesNoLeidas }}
                                    </span>
                                @endif
                            </a>
                        @endif
                    </div>
                </div>

                <div class="pt-user-menu" x-data="{ dropdownOpen: false }">
                    <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false" class="pt-user-btn">
                        <div class="pt-avatar">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>

                        <div class="pt-user-text">
                            <p>{{ Auth::user()->name }}</p>
                            <span>{{ Auth::user()->rol === 'admin' ? 'Administrador' : 'Usuario' }}</span>
                        </div>

                        <span class="pt-user-arrow">⌄</span>
                    </button>

                    <div x-show="dropdownOpen" x-transition class="pt-user-dropdown" style="display:none;">
                        <div class="pt-user-info">
                            <p>{{ Auth::user()->name }}</p>
                            <span>{{ Auth::user()->email }}</span>
                        </div>

                        <a href="{{ route('profile.edit') }}">Mi perfil</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">Cerrar sesión</button>
                        </form>
                    </div>
                </div>

                <button @click="open = !open" class="pt-mobile-btn">
                    <span x-show="!open">☰</span>
                    <span x-show="open" style="display:none;">×</span>
                </button>
            </div>
        </div>

        <div x-show="open" x-transition class="pt-mobile-menu" style="display:none;">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Dashboard
            </a>

            @if(auth()->user()->rol === 'admin')
                <a href="{{ route('plantas.index') }}">Plantas</a>
                <a href="{{ route('adopciones.index') }}">Adopciones</a>
                <a href="{{ route('ubicaciones.index') }}">Ubicaciones</a>
                <a href="{{ route('cuidados.index') }}">Cuidados</a>
                <a href="{{ route('planta-cuidados.index') }}">Asignar cuidados</a>
                <a href="{{ route('recomendaciones-cuidado.index') }}">Recomendaciones de cuidado</a>
                <a href="{{ route('recomendaciones-zona.index') }}">Recomendaciones de zona</a>
                <a href="{{ route('problemas.index') }}">Problemas</a>
                <a href="{{ route('tratamientos.index') }}">Tratamientos</a>
                <a href="{{ route('reporte-problemas.index') }}">Reportes de problemas</a>
                <a href="{{ route('admin.usuarios.index') }}">Usuarios</a>
            @else
                <a href="{{ route('catalogo.plantas') }}">Catálogo</a>
                <a href="{{ route('adopciones.index') }}">Mis adopciones</a>

                @php
                    $notificacionesNoLeidasMovil = \App\Models\Notificacion::where('id_usuario', auth()->id())->where('leida', false)->count();
                @endphp

                <a href="{{ route('notificaciones.index') }}">
                    Notificaciones
                    @if($notificacionesNoLeidasMovil > 0)
                        <span class="pt-nav-badge">
                            {{ $notificacionesNoLeidasMovil > 9 ? '9+' : $notificacionesNoLeidasMovil }}
                        </span>
                    @endif
                </a>
            @endif

            <div class="pt-mobile-user">
                <div class="pt-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <p>{{ Auth::user()->name }}</p>
                    <span>{{ Auth::user()->email }}</span>
                </div>
            </div>

            <a href="{{ route('profile.edit') }}">Mi perfil</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Cerrar sesión</button>
            </form>
        </div>
    </nav>

    <!-- ========== CONTENIDO PRINCIPAL ========== -->
    <div class="pt-page">
        <div class="pt-container">

            <div class="pt-card pt-adoption-detail">
                <div class="pt-card-header">
                    <h3 class="pt-card-title">{{ $adopcion->planta->nombre }}</h3>
                </div>

                <div class="pt-card-body">
                    <div class="pt-adoption-flex">
                        <div class="pt-adoption-image">
                            @php
                                $imagenUrl = 'https://images.unsplash.com/photo-1592150621744-aca64f48394a?w=300&fit=crop';
                                if ($adopcion->planta->imagen) {
                                    if (filter_var($adopcion->planta->imagen, FILTER_VALIDATE_URL)) {
                                        $imagenUrl = $adopcion->planta->imagen;
                                    } elseif (file_exists(public_path('storage/' . $adopcion->planta->imagen))) {
                                        $imagenUrl = asset('storage/' . $adopcion->planta->imagen);
                                    }
                                }
                            @endphp

                            <img src="{{ $imagenUrl }}" alt="{{ $adopcion->planta->nombre }}">
                        </div>

                        <div class="pt-adoption-info">
                            <div class="pt-info-grid-small">
                                <div class="pt-info-box">
                                    <strong>Especie</strong>
                                    <span>{{ $adopcion->planta->especie }}</span>
                                </div>

                                <div class="pt-info-box">
                                    <strong>Estado adopción</strong>
                                    <span>{{ ucfirst($adopcion->estado_adopcion) }}</span>
                                </div>

                                <div class="pt-info-box">
                                    <strong>Ubicación</strong>
                                    <span>{{ $adopcion->ubicacion->nombre_lugar ?? 'No registrada' }}</span>
                                </div>

                                <div class="pt-info-box">
                                    <strong>Fecha adopción</strong>
                                    <span>{{ \Carbon\Carbon::parse($adopcion->fecha_adopcion)->format('d/m/Y') }}</span>
                                </div>
                            </div>

                            <p class="pt-description">
                                <strong>Descripción:</strong>
                                {{ $adopcion->planta->descripcion ?? 'Sin descripción.' }}
                            </p>

                            <div class="pt-btn-group">
                                <a href="{{ route('registro-cuidados.create', ['adopcion_id' => $adopcion->id]) }}" class="pt-btn pt-btn-green">
                                    Registrar cuidado general
                                </a>

                                <a href="{{ route('reporte-problemas.create', ['adopcion_id' => $adopcion->id]) }}" class="pt-btn pt-btn-red">
                                    Reportar problema
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-card">
                <div class="pt-card-header">
                    <h3 class="pt-card-title">Plan de cuidados</h3>
                </div>

                <div class="pt-card-body">
                    @php
                        $cuidadosAsignados = $adopcion->planta->plantaCuidados;
                    @endphp

                    @if($cuidadosAsignados->count())
                        <div class="pt-table-wrapper">
                            <table class="pt-table">
                                <thead>
                                    <tr>
                                        <th>Cuidado</th>
                                        <th>Frecuencia</th>
                                        <th>Próxima fecha sugerida</th>
                                        <th>Registrar</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($cuidadosAsignados as $pc)
                                        @php
                                            $ultimoRegistro = $adopcion->registrosCuidados()
                                                ->where('id_planta_cuidado', $pc->id)
                                                ->latest()
                                                ->first();

                                            if ($ultimoRegistro) {
                                                $proximaFecha = \Carbon\Carbon::parse($ultimoRegistro->fecha)->addDays($pc->frecuencia);
                                            } else {
                                                $proximaFecha = \Carbon\Carbon::parse($adopcion->fecha_adopcion)->addDays($pc->frecuencia);
                                            }
                                        @endphp

                                        <tr>
                                            <td>
                                                <strong>{{ $pc->cuidado->nombre }}</strong>
                                                @if($pc->instrucciones_esp)
                                                    <br>
                                                    <small>{{ Str::limit($pc->instrucciones_esp, 80) }}</small>
                                                @endif
                                            </td>
                                            <td>Cada {{ $pc->frecuencia }} días</td>
                                            <td>{{ $proximaFecha->format('d/m/Y') }}</td>
                                            <td>
                                                <a href="{{ route('registro-cuidados.create', ['adopcion_id' => $adopcion->id, 'cuidado_id' => $pc->id]) }}" class="pt-small-btn green">
                                                    Registrar
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="pt-muted">No hay cuidados asignados a esta planta.</p>
                    @endif
                </div>
            </div>

            <div class="pt-card">
                <div class="pt-card-header">
                    <h3 class="pt-card-title">Historial de cuidados</h3>
                </div>

                <div class="pt-card-body">
                    @forelse($adopcion->registrosCuidados as $registro)
                        <div class="pt-history-item">
                            <div class="pt-history-content">
                                <p class="pt-history-title">
                                    {{ $registro->plantaCuidado->cuidado->nombre }}
                                    <span>{{ \Carbon\Carbon::parse($registro->fecha)->format('d/m/Y H:i') }}</span>
                                </p>

                                <p class="pt-history-text">
                                    {{ $registro->descripcion ?? 'Sin descripción' }}
                                </p>

                                @if($registro->estado_observado)
                                    <p class="pt-muted">
                                        Estado observado: {{ $registro->estado_observado }}
                                    </p>
                                @endif
                            </div>

                            @if($registro->imagen)
                                <img src="{{ asset('storage/' . $registro->imagen) }}" class="pt-history-image" alt="Evidencia de cuidado">
                            @endif
                        </div>
                    @empty
                        <p class="pt-muted">Aún no se han registrado cuidados.</p>
                    @endforelse
                </div>
            </div>

            <div class="pt-card">
                <div class="pt-card-header">
                    <h3 class="pt-card-title">Problemas reportados</h3>
                </div>

                <div class="pt-card-body">
                    @forelse($adopcion->reportesProblemas as $reporte)
                        <div class="pt-problem-item">
                            <div class="pt-problem-header">
                                <div>
                                    <strong>{{ $reporte->problema->nombre }}</strong>
                                    <span class="pt-status-badge
                                        @if($reporte->estado === 'activo') active
                                        @elseif($reporte->estado === 'en_revision') review
                                        @else solved @endif">
                                        {{ ucfirst(str_replace('_', ' ', $reporte->estado)) }}
                                    </span>
                                </div>

                                <span class="pt-muted">Gravedad: {{ ucfirst($reporte->gravedad) }}</span>
                            </div>

                            <p class="pt-history-text">{{ $reporte->descripcion ?? 'Sin descripción' }}</p>

                            <a href="{{ route('reporte-problemas.show', $reporte) }}" class="pt-link green">
                                Ver diagnóstico
                            </a>
                        </div>
                    @empty
                        <p class="pt-muted">No hay problemas reportados.</p>
                    @endforelse
                </div>
            </div>

            <div class="pt-card">
                <div class="pt-card-header">
                    <h3 class="pt-card-title">Tratamientos aplicados</h3>
                </div>

                <div class="pt-card-body">
                    <p class="pt-muted">
                        Tratamientos registrados derivados de los problemas reportados.
                    </p>

                    @php
                        $tratamientosReporte = $adopcion->reportesProblemas
                            ->flatMap(function ($reporte) {
                                return $reporte->tratamientosReportes->map(function ($tratamientoReporte) use ($reporte) {
                                    $tratamientoReporte->reporte_original = $reporte;
                                    return $tratamientoReporte;
                                });
                            });
                    @endphp

                    @if($tratamientosReporte->count() > 0)
                        <div class="pt-table-wrapper">
                            <table class="pt-table">
                                <thead>
                                    <tr>
                                        <th>Problema</th>
                                        <th>Tratamiento</th>
                                        <th>Frecuencia</th>
                                        <th>Fecha registro</th>
                                        <th>Estado</th>
                                        <th>Evidencia</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($tratamientosReporte as $tratamientoReporte)
                                        @php
                                            $estadoTratamiento = strtolower($tratamientoReporte->estado ?? 'pendiente');
                                            $fechaRegistro = $tratamientoReporte->updated_at ?? $tratamientoReporte->created_at;
                                        @endphp

                                        <tr>
                                            <td>
                                                <strong>{{ $tratamientoReporte->reporte_original->problema->nombre ?? 'Problema no disponible' }}</strong>
                                                <br>
                                                <small>Gravedad: {{ ucfirst($tratamientoReporte->reporte_original->gravedad ?? 'Sin gravedad') }}</small>
                                            </td>

                                            <td>
                                                <strong>{{ $tratamientoReporte->tratamiento->descripcion ?? 'Tratamiento sin descripción' }}</strong>
                                                @if($tratamientoReporte->descripcion)
                                                    <br>
                                                    <small>Último registro: {{ $tratamientoReporte->descripcion }}</small>
                                                @endif
                                            </td>

                                            <td>Cada {{ $tratamientoReporte->frecuencia_dias ?? 1 }} días</td>

                                            <td>
                                                @if($fechaRegistro)
                                                    {{ \Carbon\Carbon::parse($fechaRegistro)->format('d/m/Y') }}
                                                @else
                                                    Sin fecha
                                                @endif
                                            </td>

                                            <td>
                                                <span class="pt-status-badge
                                                    @if($estadoTratamiento === 'pendiente') review
                                                    @elseif($estadoTratamiento === 'evidenciado') solved
                                                    @elseif($estadoTratamiento === 'resuelto') solved
                                                    @else review @endif">
                                                    {{ ucfirst($tratamientoReporte->estado ?? 'pendiente') }}
                                                </span>
                                            </td>

                                            <td>
                                                @if($tratamientoReporte->imagen)
                                                    <img src="{{ asset('storage/' . $tratamientoReporte->imagen) }}" class="pt-table-image" alt="Evidencia del tratamiento">
                                                @else
                                                    <span class="pt-muted">Sin imagen</span>
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{ route('reporte-problemas.show', $tratamientoReporte->reporte_original->id) }}" class="pt-small-btn green">
                                                    Ver diagnóstico
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="pt-empty center">
                            No hay tratamientos asignados todavía.
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

</body>
</html>