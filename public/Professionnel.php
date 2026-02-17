<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professionnels - Bien-être Étudiant</title>
    <link rel="stylesheet" href="../css/Page_Accueil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Styles spécifiques pour la page professionnels */
        .professionnels-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 60px 20px;
            text-align: center;
        }

        .professionnels-header h1 {
            font-size: 2.8rem;
            margin-bottom: 20px;
        }

        .professionnels-header p {
            font-size: 1.2rem;
            max-width: 800px;
            margin: 0 auto;
            opacity: 0.9;
        }

        .filtres-section {
            background-color: white;
            padding: 40px 20px;
            box-shadow: var(--shadow);
            margin-bottom: 40px;
        }

        .filtres-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .filtres-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .filtre-group {
            display: flex;
            flex-direction: column;
        }

        .filtre-group label {
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .filtre-group select,
        .filtre-group input {
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .filtre-group select:focus,
        .filtre-group input:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .btn-filtres {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 20px;
        }

        .btn-filter {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-filter:hover {
            background-color: #6854D4;
            transform: translateY(-2px);
        }

        .btn-reset {
            background-color: var(--text-light);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-reset:hover {
            background-color: #4a5568;
            transform: translateY(-2px);
        }

        .professionnels-grid {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .professionnels-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }

        .professionnel-card {
            background-color: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .professionnel-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .professionnel-header {
            background-color: var(--primary-color);
            color: white;
            padding: 25px;
            text-align: center;
        }

        .professionnel-nom {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .professionnel-specialite {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .professionnel-content {
            padding: 25px;
            flex-grow: 1;
        }

        .professionnel-info {
            margin-bottom: 20px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
            color: var(--text-light);
        }

        .info-item i {
            color: var(--primary-color);
            width: 20px;
        }

        .professionnel-description {
            color: var(--text-dark);
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .badges-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }

        .badge {
            background-color: var(--bg-light);
            color: var(--text-dark);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .badge-mode {
            background-color: var(--secondary-color);
            color: white;
        }

        .badge-disponible {
            background-color: #4CAF50;
            color: white;
        }

        .professionnel-footer {
            padding: 0 25px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .delai-reponse {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .btn-rdv {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 25px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-rdv:hover {
            background-color: #6854D4;
            transform: translateY(-2px);
        }

        .no-results {
            text-align: center;
            padding: 60px 20px;
            grid-column: 1 / -1;
        }

        .no-results h3 {
            font-size: 1.8rem;
            color: var(--text-dark);
            margin-bottom: 20px;
        }

        .no-results p {
            color: var(--text-light);
            margin-bottom: 30px;
        }

        .results-count {
            text-align: center;
            color: var(--text-light);
            margin-bottom: 30px;
            font-size: 1.1rem;
        }

        .results-count span {
            font-weight: bold;
            color: var(--primary-color);
        }

        .filtres-actifs {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            border-left: 4px solid var(--primary-color);
        }

        .filtres-actifs p {
            margin: 0;
            color: var(--text-dark);
        }

        @media (max-width: 768px) {
            .filtres-form {
                grid-template-columns: 1fr;
            }

            .professionnels-list {
                grid-template-columns: 1fr;
            }

            .professionnel-footer {
                flex-direction: column;
                gap: 15px;
                align-items: stretch;
            }

            .btn-filtres {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
<nav class="navbar">
    <div class="nav-container">
        <div class="logo">
            <img src="../css/bien-être étudiant (1)_page-0001.jpg" alt="Bien-être Étudiant">
        </div>

        <ul class="nav-menu">
            <li class="nav-item">
                <a href="Page_Accueil.php" class="nav-link">
                    <span class="icon">Accueil</span>
                </a>
            </li>
            <li class="nav-item active">
                <a href="Professionnel.php" class="nav-link">
                    <span class="icon">Professionnels</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="RDV.php" class="nav-link">
                    <span class="icon">Prendre RDV</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="FAQ.php" class="nav-link">
                    <span class="icon">FAQ</span>
                </a>
            </li>
        </ul>

        <button class="btn-login">LOGIN</button>
    </div>
</nav>

<section class="professionnels-header">
    <h1>Nos Professionnels</h1>
    <p>Retrouvez notre réseau de professionnels qualifiés et engagés pour votre bien-être. Chaque expert est sélectionné avec soin pour vous offrir un accompagnement adapté à vos besoins.</p>
</section>

<section class="filtres-section">
    <div class="filtres-container">
        <form method="GET" action="" class="filtres-form">
            <div class="filtre-group">
                <label for="search"><i class="fas fa-search"></i> Recherche</label>
                <input type="text" id="search" name="search" placeholder="Nom, spécialité, ville...">
            </div>

            <div class="filtre-group">
                <label for="specialite"><i class="fas fa-stethoscope"></i> Spécialité</label>
                <select id="specialite" name="specialite">
                    <option value="">Toutes les spécialités</option>
                    <option value="Psychologue clinicien">Psychologue clinicien</option>
                    <option value="Psychothérapeute">Psychothérapeute</option>
                    <option value="Neuropsychologue">Neuropsychologue</option>
                    <option value="Psychiatre">Psychiatre</option>
                    <option value="Psychologue du travail">Psychologue du travail</option>
                    <option value="Sexologue">Sexologue</option>
                    <option value="Thérapeute familial">Thérapeute familial</option>
                    <option value="Addictologue">Addictologue</option>
                    <option value="Psychotraumatologue">Psychotraumatologue</option>
                    <option value="Psychologue enfants">Psychologue enfants</option>
                </select>
            </div>

            <div class="filtre-group">
                <label for="ville"><i class="fas fa-map-marker-alt"></i> Ville</label>
                <select id="ville" name="ville">
                    <option value="">Toutes les villes</option>
                    <option value="Paris">Paris</option>
                    <option value="Lyon">Lyon</option>
                    <option value="Marseille">Marseille</option>
                    <option value="Toulouse">Toulouse</option>
                    <option value="Bordeaux">Bordeaux</option>
                    <option value="Lille">Lille</option>
                    <option value="Nice">Nice</option>
                    <option value="Nantes">Nantes</option>
                    <option value="Strasbourg">Strasbourg</option>
                    <option value="Montpellier">Montpellier</option>
                </select>
            </div>

            <div class="filtre-group">
                <label for="mode"><i class="fas fa-laptop-house"></i> Mode de consultation</label>
                <select id="mode" name="mode">
                    <option value="">Tous les modes</option>
                    <option value="visio">Visio uniquement</option>
                    <option value="presentiel">Présentiel uniquement</option>
                    <option value="mixte">Visio et présentiel</option>
                    <option value="messagerie">Messagerie uniquement</option>
                </select>
            </div>

            <div class="btn-filtres">
                <button type="submit" class="btn-filter">
                    <i class="fas fa-filter"></i> Filtrer
                </button>
                <a href="Professionnel.php" class="btn-reset">
                    <i class="fas fa-redo"></i> Réinitialiser
                </a>
            </div>
        </form>
    </div>
</section>

<section class="professionnels-grid">
    <div class="results-count">
        <span id="count">13</span> professionnels trouvés
    </div>

    <div class="professionnels-list" id="professionnels-list">
        <!-- 👥 PSYCHOLOGUES CLINIQUES & PSYCHOTHÉRAPEUTES -->
        <div class="professionnel-card">
            <div class="professionnel-header">
                <h3 class="professionnel-nom">Dr. Sophie Martin</h3>
                <p class="professionnel-specialite">Psychologue clinicienne</p>
            </div>
            <div class="professionnel-content">
                <div class="professionnel-info">
                    <div class="info-item"><i class="fas fa-map-marker-alt"></i><span>Paris 15e</span></div>
                    <div class="info-item"><i class="fas fa-laptop-house"></i><span>Visio et présentiel</span></div>
                    <div class="info-item"><i class="fas fa-user-md"></i><span>Spécialité : TCC, Anxiété</span></div>
                </div>
                <div class="professionnel-description">Spécialiste en Thérapie Cognitive et Comportementale avec expertise dans le traitement des troubles anxieux et des attaques de panique.</div>
                <div class="badges-container">
                    <span class="badge badge-mode">Visio + Présentiel</span>
                    <span class="badge badge-disponible"><i class="fas fa-check-circle"></i> Disponible</span>
                </div>
            </div>
            <div class="professionnel-footer">
                <div class="delai-reponse"><i class="fas fa-clock"></i> Délai : <strong>24h</strong></div>
                <a href="RDV.php?professionnel=1" class="btn-rdv"><i class="fas fa-calendar-check"></i> Prendre RDV</a>
            </div>
        </div>

        <div class="professionnel-card">
            <div class="professionnel-header">
                <h3 class="professionnel-nom">Thomas Dubois</h3>
                <p class="professionnel-specialite">Psychothérapeute</p>
            </div>
            <div class="professionnel-content">
                <div class="professionnel-info">
                    <div class="info-item"><i class="fas fa-map-marker-alt"></i><span>Lyon 2e</span></div>
                    <div class="info-item"><i class="fas fa-laptop-house"></i><span>Visio, présentiel, messagerie</span></div>
                    <div class="info-item"><i class="fas fa-user-md"></i><span>Spécialité : Thérapie systémique</span></div>
                </div>
                <div class="professionnel-description">Thérapeute systémique expérimenté dans l'accompagnement des dynamiques familiales et relationnelles complexes.</div>
                <div class="badges-container">
                    <span class="badge badge-mode">Tous modes</span>
                    <span class="badge badge-disponible"><i class="fas fa-check-circle"></i> Disponible</span>
                </div>
            </div>
            <div class="professionnel-footer">
                <div class="delai-reponse"><i class="fas fa-clock"></i> Délai : <strong>36h</strong></div>
                <a href="RDV.php?professionnel=2" class="btn-rdv"><i class="fas fa-calendar-check"></i> Prendre RDV</a>
            </div>
        </div>

        <div class="professionnel-card">
            <div class="professionnel-header">
                <h3 class="professionnel-nom">Camille Laurent</h3>
                <p class="professionnel-specialite">Psychologue</p>
            </div>
            <div class="professionnel-content">
                <div class="professionnel-info">
                    <div class="info-item"><i class="fas fa-map-marker-alt"></i><span>Marseille</span></div>
                    <div class="info-item"><i class="fas fa-laptop-house"></i><span>Présentiel et visio</span></div>
                    <div class="info-item"><i class="fas fa-user-md"></i><span>Spécialité : Burn-out, Estime de soi</span></div>
                </div>
                <div class="professionnel-description">Accompagnement spécialisé dans l'épuisement professionnel et la reconstruction de l'estime de soi.</div>
                <div class="badges-container">
                    <span class="badge badge-mode">Mixte</span>
                    <span class="badge badge-disponible"><i class="fas fa-check-circle"></i> Disponible</span>
                </div>
            </div>
            <div class="professionnel-footer">
                <div class="delai-reponse"><i class="fas fa-clock"></i> Délai : <strong>48h</strong></div>
                <a href="RDV.php?professionnel=3" class="btn-rdv"><i class="fas fa-calendar-check"></i> Prendre RDV</a>
            </div>
        </div>

        <div class="professionnel-card">
            <div class="professionnel-header">
                <h3 class="professionnel-nom">Nicolas Moreau</h3>
                <p class="professionnel-specialite">Neuropsychologue</p>
            </div>
            <div class="professionnel-content">
                <div class="professionnel-info">
                    <div class="info-item"><i class="fas fa-map-marker-alt"></i><span>Toulouse</span></div>
                    <div class="info-item"><i class="fas fa-laptop-house"></i><span>Présentiel uniquement</span></div>
                    <div class="info-item"><i class="fas fa-user-md"></i><span>Spécialité : TDAH, Troubles apprentissage</span></div>
                </div>
                <div class="professionnel-description">Expert en évaluation et accompagnement des troubles neurodéveloppementaux (TDAH, dyslexie, dyspraxie).</div>
                <div class="badges-container">
                    <span class="badge badge-mode">Présentiel</span>
                    <span class="badge badge-disponible"><i class="fas fa-check-circle"></i> Disponible</span>
                </div>
            </div>
            <div class="professionnel-footer">
                <div class="delai-reponse"><i class="fas fa-clock"></i> Délai : <strong>72h</strong></div>
                <a href="RDV.php?professionnel=4" class="btn-rdv"><i class="fas fa-calendar-check"></i> Prendre RDV</a>
            </div>
        </div>

        <div class="professionnel-card">
            <div class="professionnel-header">
                <h3 class="professionnel-nom">Laura Petit</h3>
                <p class="professionnel-specialite">Psychologue du travail</p>
            </div>
            <div class="professionnel-content">
                <div class="professionnel-info">
                    <div class="info-item"><i class="fas fa-map-marker-alt"></i><span>Bordeaux</span></div>
                    <div class="info-item"><i class="fas fa-laptop-house"></i><span>Visio et messagerie</span></div>
                    <div class="info-item"><i class="fas fa-user-md"></i><span>Spécialité : Stress professionnel</span></div>
                </div>
                <div class="professionnel-description">Spécialiste en risques psychosociaux et gestion du stress en milieu professionnel.</div>
                <div class="badges-container">
                    <span class="badge badge-mode">Visio</span>
                    <span class="badge badge-disponible"><i class="fas fa-check-circle"></i> Disponible</span>
                </div>
            </div>
            <div class="professionnel-footer">
                <div class="delai-reponse"><i class="fas fa-clock"></i> Délai : <strong>24h</strong></div>
                <a href="RDV.php?professionnel=5" class="btn-rdv"><i class="fas fa-calendar-check"></i> Prendre RDV</a>
            </div>
        </div>

        <div class="professionnel-card">
            <div class="professionnel-header">
                <h3 class="professionnel-nom">Julien Bernard</h3>
                <p class="professionnel-specialite">Thérapeute de couple</p>
            </div>
            <div class="professionnel-content">
                <div class="professionnel-info">
                    <div class="info-item"><i class="fas fa-map-marker-alt"></i><span>Lille</span></div>
                    <div class="info-item"><i class="fas fa-laptop-house"></i><span>Présentiel et visio</span></div>
                    <div class="info-item"><i class="fas fa-user-md"></i><span>Spécialité : Relations, Communication</span></div>
                </div>
                <div class="professionnel-description">Accompagnement des couples dans l'amélioration de la communication et la résolution des conflits.</div>
                <div class="badges-container">
                    <span class="badge badge-mode">Mixte</span>
                    <span class="badge badge-disponible"><i class="fas fa-check-circle"></i> Disponible</span>
                </div>
            </div>
            <div class="professionnel-footer">
                <div class="delai-reponse"><i class="fas fa-clock"></i> Délai : <strong>48h</strong></div>
                <a href="RDV.php?professionnel=6" class="btn-rdv"><i class="fas fa-calendar-check"></i> Prendre RDV</a>
            </div>
        </div>

        <div class="professionnel-card">
            <div class="professionnel-header">
                <h3 class="professionnel-nom">Chloé Robert</h3>
                <p class="professionnel-specialite">Psychologue enfants</p>
            </div>
            <div class="professionnel-content">
                <div class="professionnel-info">
                    <div class="info-item"><i class="fas fa-map-marker-alt"></i><span>Nice</span></div>
                    <div class="info-item"><i class="fas fa-laptop-house"></i><span>Présentiel uniquement</span></div>
                    <div class="info-item"><i class="fas fa-user-md"></i><span>Spécialité : Thérapie par le jeu</span></div>
                </div>
                <div class="professionnel-description">Spécialisée dans l'accompagnement des enfants par des techniques ludothérapeutiques adaptées.</div>
                <div class="badges-container">
                    <span class="badge badge-mode">Présentiel</span>
                    <span class="badge badge-disponible"><i class="fas fa-check-circle"></i> Disponible</span>
                </div>
            </div>
            <div class="professionnel-footer">
                <div class="delai-reponse"><i class="fas fa-clock"></i> Délai : <strong>72h</strong></div>
                <a href="RDV.php?professionnel=7" class="btn-rdv"><i class="fas fa-calendar-check"></i> Prendre RDV</a>
            </div>
        </div>

        <div class="professionnel-card">
            <div class="professionnel-header">
                <h3 class="professionnel-nom">Maxime Richard</h3>
                <p class="professionnel-specialite">Sexologue</p>
            </div>
            <div class="professionnel-content">
                <div class="professionnel-info">
                    <div class="info-item"><i class="fas fa-map-marker-alt"></i><span>Nantes</span></div>
                    <div class="info-item"><i class="fas fa-laptop-house"></i><span>Visio et présentiel</span></div>
                    <div class="info-item"><i class="fas fa-user-md"></i><span>Spécialité : Santé sexuelle, Intimité</span></div>
                </div>
                <div class="professionnel-description">Accompagnement dans les problématiques de santé sexuelle et de vie intime avec bienveillance.</div>
                <div class="badges-container">
                    <span class="badge badge-mode">Mixte</span>
                    <span class="badge badge-disponible"><i class="fas fa-check-circle"></i> Disponible</span>
                </div>
            </div>
            <div class="professionnel-footer">
                <div class="delai-reponse"><i class="fas fa-clock"></i> Délai : <strong>36h</strong></div>
                <a href="RDV.php?professionnel=8" class="btn-rdv"><i class="fas fa-calendar-check"></i> Prendre RDV</a>
            </div>
        </div>

        <div class="professionnel-card">
            <div class="professionnel-header">
                <h3 class="professionnel-nom">Emma Leroy</h3>
                <p class="professionnel-specialite">Gestalt-thérapeute</p>
            </div>
            <div class="professionnel-content">
                <div class="professionnel-info">
                    <div class="info-item"><i class="fas fa-map-marker-alt"></i><span>Strasbourg</span></div>
                    <div class="info-item"><i class="fas fa-laptop-house"></i><span>Présentiel uniquement</span></div>
                    <div class="info-item"><i class="fas fa-user-md"></i><span>Spécialité : Développement personnel</span></div>
                </div>
                <div class="professionnel-description">Approche gestaltiste pour le développement personnel et la conscience de soi.</div>
                <div class="badges-container">
                    <span class="badge badge-mode">Présentiel</span>
                    <span class="badge badge-disponible"><i class="fas fa-check-circle"></i> Disponible</span>
                </div>
            </div>
            <div class="professionnel-footer">
                <div class="delai-reponse"><i class="fas fa-clock"></i> Délai : <strong>48h</strong></div>
                <a href="RDV.php?professionnel=9" class="btn-rdv"><i class="fas fa-calendar-check"></i> Prendre RDV</a>
            </div>
        </div>

        <div class="professionnel-card">
            <div class="professionnel-header">
                <h3 class="professionnel-nom">Dr. Antoine Simon</h3>
                <p class="professionnel-specialite">Psychiatre</p>
            </div>
            <div class="professionnel-content">
                <div class="professionnel-info">
                    <div class="info-item"><i class="fas fa-map-marker-alt"></i><span>Montpellier</span></div>
                    <div class="info-item"><i class="fas fa-laptop-house"></i><span>Visio et présentiel</span></div>
                    <div class="info-item"><i class="fas fa-user-md"></i><span>Spécialité : Troubles de l'humeur</span></div>
                </div>
                <div class="professionnel-description">Psychiatre spécialisé dans le diagnostic et le traitement des troubles de l'humeur (dépression, bipolarité).</div>
                <div class="badges-container">
                    <span class="badge badge-mode">Mixte</span>
                    <span class="badge badge-disponible"><i class="fas fa-check-circle"></i> Disponible</span>
                </div>
            </div>
            <div class="professionnel-footer">
                <div class="delai-reponse"><i class="fas fa-clock"></i> Délai : <strong>72h</strong></div>
                <a href="RDV.php?professionnel=10" class="btn-rdv"><i class="fas fa-calendar-check"></i> Prendre RDV</a>
            </div>
        </div>

        <!-- 🧠 SPÉCIALISTES DES TROUBLES SPÉCIFIQUES -->
        <div class="professionnel-card">
            <div class="professionnel-header">
                <h3 class="professionnel-nom">Manon Blanc</h3>
                <p class="professionnel-specialite">Psychotraumatologue</p>
            </div>
            <div class="professionnel-content">
                <div class="professionnel-info">
                    <div class="info-item"><i class="fas fa-map-marker-alt"></i><span>Rennes</span></div>
                    <div class="info-item"><i class="fas fa-laptop-house"></i><span>Présentiel et visio</span></div>
                    <div class="info-item"><i class="fas fa-user-md"></i><span>Spécialité : EMDR, Trauma</span></div>
                </div>
                <div class="professionnel-description">Spécialiste en psychotraumatologie et thérapie EMDR pour le traitement des traumatismes.</div>
                <div class="badges-container">
                    <span class="badge badge-mode">Mixte</span>
                    <span class="badge badge-disponible"><i class="fas fa-check-circle"></i> Disponible</span>
                </div>
            </div>
            <div class="professionnel-footer">
                <div class="delai-reponse"><i class="fas fa-clock"></i> Délai : <strong>96h</strong></div>
                <a href="RDV.php?professionnel=11" class="btn-rdv"><i class="fas fa-calendar-check"></i> Prendre RDV</a>
            </div>
        </div>

        <!-- 🌍 THÉRAPIES INTÉGRATIVES & APPROCHES INNOVANTES -->
        <div class="professionnel-card">
            <div class="professionnel-header">
                <h3 class="professionnel-nom">Mélanie Weber</h3>
                <p class="professionnel-specialite">Thérapeute ACT</p>
            </div>
            <div class="professionnel-content">
                <div class="professionnel-info">
                    <div class="info-item"><i class="fas fa-map-marker-alt"></i><span>Metz</span></div>
                    <div class="info-item"><i class="fas fa-laptop-house"></i><span>Visio et présentiel</span></div>
                    <div class="info-item"><i class="fas fa-user-md"></i><span>Spécialité : Acceptation, Engagement</span></div>
                </div>
                <div class="professionnel-description">Thérapie d'Acceptation et d'Engagement pour développer la flexibilité psychologique.</div>
                <div class="badges-container">
                    <span class="badge badge-mode">Mixte</span>
                    <span class="badge badge-disponible"><i class="fas fa-check-circle"></i> Disponible</span>
                </div>
            </div>
            <div class="professionnel-footer">
                <div class="delai-reponse"><i class="fas fa-clock"></i> Délai : <strong>48h</strong></div>
                <a href="RDV.php?professionnel=21" class="btn-rdv"><i class="fas fa-calendar-check"></i> Prendre RDV</a>
            </div>
        </div>

        <!-- 💼 SPÉCIALISTES EN MILIEU PROFESSIONNEL -->
        <div class="professionnel-card">
            <div class="professionnel-header">
                <h3 class="professionnel-nom">Julie Fournier</h3>
                <p class="professionnel-specialite">Psychologue QVT</p>
            </div>
            <div class="professionnel-content">
                <div class="professionnel-info">
                    <div class="info-item"><i class="fas fa-map-marker-alt"></i><span>Paris 10e</span></div>
                    <div class="info-item"><i class="fas fa-laptop-house"></i><span>Visio et messagerie</span></div>
                    <div class="info-item"><i class="fas fa-user-md"></i><span>Spécialité : Qualité de vie au travail</span></div>
                </div>
                <div class="professionnel-description">Expert en qualité de vie au travail et prévention des risques psychosociaux en entreprise.</div>
                <div class="badges-container">
                    <span class="badge badge-mode">Visio</span>
                    <span class="badge badge-disponible"><i class="fas fa-check-circle"></i> Disponible</span>
                </div>
            </div>
            <div class="professionnel-footer">
                <div class="delai-reponse"><i class="fas fa-clock"></i> Délai : <strong>24h</strong></div>
                <a href="RDV.php?professionnel=31" class="btn-rdv"><i class="fas fa-calendar-check"></i> Prendre RDV</a>
            </div>
        </div>
    </div>
</section>

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
                    <li><a href="#apropos">