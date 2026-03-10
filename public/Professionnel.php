<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bien-être Étudiant - Professionnels</title>
    <link rel="stylesheet" href="../css/Page_Accueil.css">
    <style>
        /* Styles supplémentaires pour l'annuaire - Harmonisé avec #6EC0D0 */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
        }

        .psy-container {
            max-width: 1300px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .psy-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .psy-header h1 {
            font-size: 2rem;
            color: #2C3E50;
            border-left: 8px solid #6EC0D0;
            padding-left: 1.2rem;
        }

        .btn-rdv {
            background: #6EC0D0;
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 3rem;
            text-decoration: none;
            font-weight: 600;
            transition: 0.2s;
            border: 2px solid transparent;
        }

        .btn-rdv:hover {
            background: #5BA3B0;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(110, 192, 208, 0.3);
        }

        .filters {
            background: white;
            border-radius: 3rem;
            padding: 1.2rem 1.8rem;
            margin-bottom: 2rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 1rem 2rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        }

        .badge {
            background: #f0f7fa;
            padding: 0.5rem 1.3rem;
            border-radius: 3rem;
            font-weight: 600;
            font-size: 0.9rem;
            color: #2C3E50;
            cursor: pointer;
            transition: 0.2s;
            border: 2px solid transparent;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .badge:hover {
            background: #e1f0f5;
            border-color: #6EC0D0;
        }

        .badge.active {
            background: #6EC0D0;
            color: white;
            border-color: #5BA3B0;
        }

        .search-bar {
            display: flex;
            align-items: center;
            background: #f1f5f9;
            border-radius: 3rem;
            padding-left: 1.5rem;
            border: 1px solid #cbd5e1;
            flex: 1;
            min-width: 260px;
        }

        .search-bar input {
            border: none;
            background: transparent;
            padding: 0.8rem 0.5rem;
            width: 100%;
            outline: none;
            font-size: 1rem;
        }

        .search-bar button {
            background: #6EC0D0;
            border: none;
            color: white;
            padding: 0.6rem 1.8rem;
            border-radius: 3rem;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
            transition: 0.2s;
        }

        .search-bar button:hover {
            background: #5BA3B0;
        }

        .stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 1.5rem 0 1rem;
            font-weight: 500;
            color: #2C3E50;
        }

        .reset {
            color: #6EC0D0;
            background: none;
            border: none;
            font-weight: 600;
            text-decoration: underline dotted;
            cursor: pointer;
            font-size: 1rem;
        }

        .reset:hover {
            color: #5BA3B0;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.2rem;
            margin-top: 1rem;
        }

        .card {
            background: white;
            border-radius: 2rem;
            padding: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
            border: 1px solid #dde3ea;
            cursor: pointer;
            transition: all 0.2s;
        }

        .card:hover {
            transform: translateY(-3px);
            border-color: #6EC0D0;
            background: #f9fcff;
            box-shadow: 0 10px 25px rgba(110, 192, 208, 0.1);
        }

        .card.selected {
            background: #e1f0f5;
            border: 2px solid #6EC0D0;
        }

        .card h3 {
            font-size: 1.4rem;
            color: #2C3E50;
            margin-bottom: 0.2rem;
        }

        .card .ville {
            color: #5a6f84;
            font-weight: 500;
            margin: 0.3rem 0 0.6rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .modalities {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin: 0.7rem 0;
        }

        .mod {
            background: #f0f7fa;
            padding: 0.2rem 1rem;
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 600;
            color: #2C3E50;
            border: 1px solid #d0e2eb;
        }

        .tags {
            background: #f8fafc;
            border-radius: 30px;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            border: 1px solid #e2eaf2;
        }

        .card-footer {
            margin-top: 1rem;
            font-size: 0.8rem;
            color: #607a93;
            border-top: 1px dashed #d0e2eb;
            padding-top: 0.7rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-prendre-rdv {
            background: #6EC0D0;
            color: white;
            padding: 0.3rem 1rem;
            border-radius: 2rem;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 600;
            transition: 0.2s;
        }

        .btn-prendre-rdv:hover {
            background: #5BA3B0;
            transform: scale(1.05);
        }

        .detail-panel {
            background: white;
            border-radius: 2rem;
            padding: 1.8rem 2rem;
            margin: 2rem 0 1rem;
            border: 2px solid #6EC0D0;
            display: none;
            box-shadow: 0 10px 25px rgba(110, 192, 208, 0.15);
        }

        .detail-panel h2 {
            margin-bottom: 1rem;
            color: #2C3E50;
            border-bottom: 2px solid #f0f7fa;
            padding-bottom: 0.5rem;
        }

        .detail-row {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 0.8rem 2rem;
            max-width: 700px;
        }

        .detail-row span:first-child {
            font-weight: 600;
            color: #6EC0D0;
        }

        .close-detail {
            margin-top: 1.5rem;
            background: white;
            border: 2px solid #6EC0D0;
            color: #6EC0D0;
            padding: 0.4rem 2rem;
            border-radius: 3rem;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .close-detail:hover {
            background: #6EC0D0;
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .psy-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .filters {
                flex-direction: column;
                align-items: stretch;
            }

            .search-bar {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<?php
// Connexion à la base de données
$pdo = new PDO("mysql:host=localhost;dbname=consultation_db;charset=utf8", "root", "", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
?>

<nav class="navbar" style="background-color: #6EC0D0;">
    <div class="nav-container">
        <div class="logo">
            <img src="../css/bien-être%20étudiant%20(1)_page-0001.jpg" alt="Bien-être Étudiant">
        </div>

        <ul class="nav-menu">
            <li class="nav-item">
                <a href="Page_Accueil.php" class="nav-link" style="color: white;">
                    <span class="icon">Accueil</span>
                </a>
            </li>
            <li class="nav-item active">
                <a href="Professionnel.php" class="nav-link" style="color: white; font-weight: 600;">
                    <span class="icon">Professionnels</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="RDV.php" class="nav-link" style="color: white;">
                    <span class="icon">Prendre RDV</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="FAQ.php" class="nav-link" style="color: white;">
                    <span class="icon">FAQ</span>
                </a>
            </li>
        </ul>

        <button class="btn-login" style="background: white; color: #6EC0D0; border: none;">LOGIN</button>
    </div>
</nav>

<div class="psy-container">
    <div class="psy-header">
        <h1>🧠 Annuaire des psychologues</h1>
        <a href="RDV.php" class="btn-rdv">📅 Prendre rendez-vous</a>
    </div>

    <!-- FILTRES -->
    <div class="filters">
        <span class="badge active" data-filter="tous">🔵 tous</span>
        <span class="badge" data-filter="clinique">👥 clinique</span>
        <span class="badge" data-filter="troubles">🧠 troubles spécifiques</span>
        <span class="badge" data-filter="integrative">🌿 intégratif</span>
        <span class="badge" data-filter="professionnel">💼 travail</span>
        <span class="badge" data-filter="enfance">👶 enfance</span>
        <span class="badge" data-filter="enligne">📱 en ligne</span>
        <span class="badge" data-filter="familiale">👪 famille</span>
        <span class="badge" data-filter="corporelle">🧘 corps</span>
        <div class="search-bar">
            <input type="text" id="search" placeholder="nom, ville, mot-clé...">
            <button id="searchBtn">chercher</button>
        </div>
    </div>

    <!-- STATS + RESET -->
    <div class="stats">
        <span id="compteur">XX professionnels</span>
        <button class="reset" id="resetBtn">↺ réinitialiser</button>
    </div>

    <!-- ZONE DÉTAIL (clic) -->
    <div class="detail-panel" id="detailPanel">
        <h2>📋 Détail du professionnel</h2>
        <div class="detail-row" id="detailContent"></div>
        <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
            <button class="close-detail" id="closeDetail">✕ fermer</button>
            <a href="RDV.php" class="btn-rdv" style="padding: 0.4rem 2rem; font-size: 0.9rem;">Prendre RDV</a>
        </div>
    </div>

    <!-- GRILLE CARTES -->
    <div class="cards" id="cardsContainer"></div>
</div>

<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-col">
                <h4>Bien-être Étudiant</h4>
                <p>Votre santé mentale est notre priorité</p>
            </div>
            <div class="footer-col">
                <h4>Navigation</h4>
                <ul>
                    <li><a href="Page_Accueil.php">Accueil</a></li>
                    <li><a href="Professionnel.php">Professionnels</a></li>
                    <li><a href="RDV.php">Prendre RDV</a></li>
                    <li><a href="FAQ.php">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Informations</h4>
                <ul>
                    <li><a href="#apropos">À propos</a></li>
                    <li><a href="#confidentialite">Confidentialité</a></li>
                    <li><a href="#mentions">Mentions légales</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Urgences</h4>
                <ul>
                    <li>3114 - Numéro national</li>
                    <li>Nightline - Écoute étudiante</li>
                    <li>15 - SAMU</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Bien-être Étudiant. Tous droits réservés.</p>
        </div>
    </div>
</footer>

<script>
    (function() {
        // Données des professionnels (à remplacer par des données PHP plus tard)
        const pros = [
            { name: "Dr. Sophie Martin", title: "Psychologue clinicienne", city: "Paris 15e", tags: ["TCC", "Anxiété"], modality: ["Visio","Présentiel"], category: "clinique" },
            { name: "Thomas Dubois", title: "Psychothérapeute", city: "Lyon 2e", tags: ["Thérapie systémique"], modality: ["Visio","Présentiel","Messagerie"], category: "clinique" },
            { name: "Camille Laurent", title: "Psychologue", city: "Marseille", tags: ["Burn-out","Estime de soi"], modality: ["Présentiel","Visio"], category: "clinique" },
            { name: "Nicolas Moreau", title: "Neuropsychologue", city: "Toulouse", tags: ["TDAH","Troubles apprentissage"], modality: ["Présentiel"], category: "clinique" },
            { name: "Laura Petit", title: "Psychologue du travail", city: "Bordeaux", tags: ["Stress professionnel"], modality: ["Visio","Messagerie"], category: "professionnel" },
            { name: "Manon Blanc", title: "Psychotraumatologue", city: "Rennes", tags: ["EMDR","Trauma"], modality: ["Présentiel","Visio"], category: "troubles" },
            { name: "Lucas Michel", title: "Addictologue", city: "Grenoble", tags: ["Dépendances"], modality: ["Présentiel","Messagerie"], category: "troubles" },
            { name: "Inès Garcia", title: "Psychologue TCA", city: "Dijon", tags: ["Troubles alimentaires"], modality: ["Présentiel","Visio"], category: "troubles" },
            { name: "Mélanie Weber", title: "Thérapeute ACT", city: "Metz", tags: ["Acceptation","Engagement"], modality: ["Visio","Présentiel"], category: "integrative" },
            { name: "Clara Klein", title: "Art-thérapeute", city: "Caen", tags: ["Expression créative"], modality: ["Présentiel"], category: "integrative" },
            { name: "Julie Fournier", title: "Psychologue QVT", city: "Paris 10e", tags: ["Qualité de vie"], modality: ["Visio","Messagerie"], category: "professionnel" },
            { name: "Quentin Rousseau", title: "Coach résilience", city: "Lyon", tags: ["Burn-out","Retour"], modality: ["Visio"], category: "professionnel" },
            { name: "Marion Guérin", title: "Psychologue scolaire", city: "Paris 5e", tags: ["Difficultés scolaires"], modality: ["Présentiel"], category: "enfance" },
            { name: "Rémy Fontaine", title: "Spécialiste TDAH", city: "Lyon", tags: ["TDAH"], modality: ["Présentiel","Visio"], category: "enfance" },
            { name: "Sabrina Leroy", title: "Psychologue 100% visio", city: "Paris", tags: ["Expats"], modality: ["Visio"], category: "enligne" },
            { name: "Cédric Mora", title: "Thérapeute asynchrone", city: "Lyon", tags: ["Messagerie"], modality: ["Messagerie"], category: "enligne" },
            { name: "Clémence Barbier", title: "Thérapeute familiale", city: "Rennes", tags: ["Systèmes familiaux"], modality: ["Présentiel"], category: "familiale" },
            { name: "Jules Perrot", title: "Médiateur familial", city: "Grenoble", tags: ["Conflits","Séparation"], modality: ["Présentiel","Visio"], category: "familiale" },
            { name: "Marie-Christine Duval", title: "Sophrologue", city: "Metz", tags: ["Relaxation"], modality: ["Présentiel"], category: "corporelle" },
            { name: "François-Xavier Lambert", title: "Psychologue énergéticien", city: "Besançon", tags: ["Médecine chinoise"], modality: ["Présentiel"], category: "corporelle" },
            { name: "Alexis Costa", title: "Spécialiste autisme", city: "Nantes", tags: ["TSA"], modality: ["Présentiel"], category: "enfance" },
            { name: "Anna Kowalski", title: "Psychologue deuil périnatal", city: "Nantes", tags: ["Perte"], modality: ["Présentiel","Messagerie"], category: "troubles" }
        ];

        // État
        let filterCategory = "tous";
        let searchText = "";
        let selectedPro = null;

        // Éléments DOM
        const container = document.getElementById('cardsContainer');
        const compteurSpan = document.getElementById('compteur');
        const detailPanel = document.getElementById('detailPanel');
        const detailContent = document.getElementById('detailContent');
        const searchInput = document.getElementById('search');
        const searchBtn = document.getElementById('searchBtn');
        const resetBtn = document.getElementById('resetBtn');
        const closeDetail = document.getElementById('closeDetail');

        // Fonction d'affichage
        function render() {
            const filtered = pros.filter(p => {
                if (filterCategory !== "tous" && p.category !== filterCategory) return false;
                if (searchText.trim() !== '') {
                    const term = searchText.toLowerCase();
                    return p.name.toLowerCase().includes(term) ||
                        p.city.toLowerCase().includes(term) ||
                        p.title.toLowerCase().includes(term) ||
                        p.tags.some(t => t.toLowerCase().includes(term));
                }
                return true;
            });

            compteurSpan.innerText = filtered.length + ' professionnel' + (filtered.length > 1 ? 's' : '');

            let html = '';
            filtered.forEach(p => {
                const selectedClass = (selectedPro && selectedPro.name === p.name && selectedPro.city === p.city) ? 'selected' : '';
                const modalités = p.modality.map(m => `<span class="mod">${m}</span>`).join('');
                const tagsHtml = p.tags.map(t => `<span class="mod" style="background:#d3e2f5;">${t}</span>`).join('');

                html += `
                        <div class="card ${selectedClass}" data-name="${p.name}" data-city="${p.city}">
                            <h3>${p.name}</h3>
                            <div class="ville">📍 ${p.city} · ${p.title}</div>
                            <div class="modalities">${modalités}</div>
                            <div class="tags">🏷️ ${tagsHtml}</div>
                            <div class="card-footer">
                                <span>${p.category}</span>
                                <a href="RDV.php?professionnel=${encodeURIComponent(p.name)}&ville=${encodeURIComponent(p.city)}" class="btn-prendre-rdv">Prendre RDV</a>
                            </div>
                        </div>
                    `;
            });
            container.innerHTML = html;

            if (selectedPro && !filtered.some(p => p.name === selectedPro.name && p.city === selectedPro.city)) {
                selectedPro = null;
                detailPanel.style.display = 'none';
            } else if (selectedPro) {
                showDetail(selectedPro);
            } else {
                detailPanel.style.display = 'none';
            }
        }

        function showDetail(p) {
            detailContent.innerHTML = `
                    <span>Nom</span> <span><b>${p.name}</b></span>
                    <span>Titre</span> <span>${p.title}</span>
                    <span>Ville</span> <span>${p.city}</span>
                    <span>Spécialités</span> <span>${p.tags.join(' · ')}</span>
                    <span>Modalités</span> <span>${p.modality.join(' / ')}</span>
                    <span>Catégorie</span> <span>${p.category}</span>
                `;
            detailPanel.style.display = 'block';
        }

        // Clic sur carte
        container.addEventListener('click', (e) => {
            const card = e.target.closest('.card');
            if (!card || e.target.closest('.btn-prendre-rdv')) return;

            const name = card.dataset.name;
            const city = card.dataset.city;
            const pro = pros.find(p => p.name === name && p.city === city);
            if (pro) {
                selectedPro = pro;
                document.querySelectorAll('.card').forEach(c => c.classList.remove('selected'));
                card.classList.add('selected');
                showDetail(pro);
            }
        });

        // Fermer détail
        closeDetail.addEventListener('click', () => {
            selectedPro = null;
            detailPanel.style.display = 'none';
            document.querySelectorAll('.card').forEach(c => c.classList.remove('selected'));
        });

        // Filtres
        document.querySelectorAll('[data-filter]').forEach(badge => {
            badge.addEventListener('click', () => {
                const filter = badge.dataset.filter;
                document.querySelectorAll('[data-filter]').forEach(b => b.classList.remove('active'));
                badge.classList.add('active');
                filterCategory = filter;
                render();
            });
        });

        // Recherche
        function doSearch() {
            searchText = searchInput.value;
            render();
        }
        searchBtn.addEventListener('click', doSearch);
        searchInput.addEventListener('keyup', (e) => { if (e.key === 'Enter') doSearch(); });

        // Reset
        resetBtn.addEventListener('click', () => {
            searchInput.value = '';
            searchText = '';
            filterCategory = 'tous';
            document.querySelectorAll('[data-filter]').forEach(b => b.classList.remove('active'));
            document.querySelector('[data-filter="tous"]').classList.add('active');
            selectedPro = null;
            detailPanel.style.display = 'none';
            render();
        });

        // Initialisation
        render();
    })();
</script>
</body>
</html>