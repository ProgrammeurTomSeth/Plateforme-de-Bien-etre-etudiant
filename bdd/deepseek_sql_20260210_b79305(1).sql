-- ============================================
-- SCRIPT SQL COMPLET POUR LA BASE DE DONNÉES
-- ============================================

-- Création de la base de données
CREATE DATABASE IF NOT EXISTS consultation_db;
USE consultation_db;

-- Table: LIEU_CONSULTATION (doit être créée en premier car référencée par PROFESSIONEL)
CREATE TABLE LIEU_CONSULTATION (
    id_lieu INT PRIMARY KEY AUTO_INCREMENT,
    adresse VARCHAR(200) NOT NULL,
    code_postal VARCHAR(10) NOT NULL,
    ville VARCHAR(50) NOT NULL,
    latitude DECIMAL(10,8),
    longitude DECIMAL(11,8),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table: ETUDIANT
CREATE TABLE ETUDIANT (
    id_etudiant INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    telephone VARCHAR(15),
    code_postal VARCHAR(10),
    niveau_etude VARCHAR(50),
    date_inscription DATE NOT NULL,
    statu_compte VARCHAR(20) NOT NULL DEFAULT 'actif',
    statut_site VARCHAR(20) NOT NULL DEFAULT 'actif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_nom_prenom (nom, prenom)
);

-- Table: ADMINISTRATEUR
CREATE TABLE ADMINISTRATEUR (
    id_administrateur INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    mail VARCHAR(100) UNIQUE NOT NULL,
    telephone VARCHAR(15),
    statut_site VARCHAR(20) NOT NULL DEFAULT 'actif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_mail (mail)
);

-- Table: MEDECIN
CREATE TABLE MEDECIN (
    id_medecin INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    mail VARCHAR(100) UNIQUE NOT NULL,
    telephone VARCHAR(15),
    statut_site VARCHAR(20) NOT NULL DEFAULT 'actif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_mail (mail)
);

-- Table: PROFESSIONEL
CREATE TABLE PROFESSIONEL (
    id_professionel INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    mail VARCHAR(100) UNIQUE NOT NULL,
    telephone VARCHAR(15),
    specialiste VARCHAR(100) NOT NULL,
    mode_consultation VARCHAR(20) NOT NULL,
    description TEXT,
    delai_reponse INT,
    statut VARCHAR(20) NOT NULL DEFAULT 'disponible',
    code_postal VARCHAR(10),
    statut_site VARCHAR(20) NOT NULL DEFAULT 'actif',
    id_lieu INT,
    id_administrateur INT, -- Pour la relation d'embauche
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_lieu) REFERENCES LIEU_CONSULTATION(id_lieu) ON DELETE SET NULL,
    FOREIGN KEY (id_administrateur) REFERENCES ADMINISTRATEUR(id_administrateur) ON DELETE SET NULL,
    INDEX idx_mail (mail),
    INDEX idx_specialiste (specialiste),
    INDEX idx_statut (statut)
);

-- Table: RENDEZ_VOUS
CREATE TABLE RENDEZ_VOUS (
    id_rendez_vous INT PRIMARY KEY AUTO_INCREMENT,
    date_rdv DATETIME NOT NULL,
    mode_consultation VARCHAR(20) NOT NULL,
    status_rdv VARCHAR(20) NOT NULL DEFAULT 'demande',
    date_demande DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    id_etudiant INT NOT NULL,
    id_professionel INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_etudiant) REFERENCES ETUDIANT(id_etudiant) ON DELETE CASCADE,
    FOREIGN KEY (id_professionel) REFERENCES PROFESSIONEL(id_professionel) ON DELETE CASCADE,
    INDEX idx_date_rdv (date_rdv),
    INDEX idx_status_rdv (status_rdv),
    INDEX idx_etudiant_professionnel (id_etudiant, id_professionel),
    UNIQUE KEY uk_rdv_unique (id_professionel, date_rdv) -- Empêche les doublons de rendez-vous
);

-- Table: CONVERSATION
CREATE TABLE CONVERSATION (
    id_message INT PRIMARY KEY AUTO_INCREMENT,
    contenu TEXT NOT NULL,
    date_envoi DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    emetteur VARCHAR(20) NOT NULL, -- 'etudiant' ou 'professionnel'
    id_etudiant INT NOT NULL,
    id_professionel INT NOT NULL,
    lu BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_etudiant) REFERENCES ETUDIANT(id_etudiant) ON DELETE CASCADE,
    FOREIGN KEY (id_professionel) REFERENCES PROFESSIONEL(id_professionel) ON DELETE CASCADE,
    INDEX idx_date_envoi (date_envoi),
    INDEX idx_emetteur (emetteur),
    INDEX idx_etudiant_professionnel (id_etudiant, id_professionel),
    INDEX idx_lu (lu)
);

-- Table: ENTRETIEN (table ternaire) - CORRECTION ICI
CREATE TABLE ENTRETIEN (
    id_entretien INT PRIMARY KEY AUTO_INCREMENT,
    id_administrateur INT NOT NULL,
    id_professionel INT NOT NULL,
    id_medecin INT NOT NULL,
    date_entretien DATETIME NOT NULL,
    statut VARCHAR(20) NOT NULL DEFAULT 'planifie',
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_administrateur) REFERENCES ADMINISTRATEUR(id_administrateur) ON DELETE CASCADE,
    FOREIGN KEY (id_professionel) REFERENCES PROFESSIONEL(id_professionel) ON DELETE CASCADE,
    FOREIGN KEY (id_medecin) REFERENCES MEDECIN(id_medecin) ON DELETE CASCADE,
    INDEX idx_date_entretien (date_entretien),
    INDEX idx_statut (statut),
    UNIQUE KEY uk_entretien_unique (id_administrateur, id_professionel, id_medecin, date_entretien)
);

-- ============================================
-- INSERTION DE DONNÉES DE TEST
-- ============================================

-- Insertion de lieux de consultation
INSERT INTO LIEU_CONSULTATION (adresse, code_postal, ville, latitude, longitude) VALUES
('123 Rue de la Santé', '75001', 'Paris', 48.856614, 2.3522219),
('456 Avenue des Médecins', '69001', 'Lyon', 45.764043, 4.835659),
('789 Boulevard du Soin', '13001', 'Marseille', 43.296482, 5.369780);

-- Insertion d'administrateurs
INSERT INTO ADMINISTRATEUR (nom, prenom, mail, telephone) VALUES
('Dupont', 'Jean', 'jean.dupont@admin.fr', '0123456789'),
('Martin', 'Sophie', 'sophie.martin@admin.fr', '0234567891');

-- Insertion de médecins
INSERT INTO MEDECIN (nom, prenom, mail, telephone) VALUES
('Bernard', 'Pierre', 'pierre.bernard@medecin.fr', '0345678912'),
('Petit', 'Marie', 'marie.petit@medecin.fr', '0456789123');

-- Insertion de professionnels
INSERT INTO PROFESSIONEL (nom, prenom, mail, telephone, specialiste, mode_consultation, description, delai_reponse, code_postal, id_lieu, id_administrateur) VALUES
('Durand', 'Paul', 'paul.durand@pro.fr', '0567891234', 'Psychologue', 'en_ligne', 'Spécialiste en thérapie cognitive', 24, '75001', 1, 1),
('Lefevre', 'Julie', 'julie.lefevre@pro.fr', '0678912345', 'Nutritionniste', 'presentiel', 'Expert en nutrition sportive', 48, '69001', 2, 1),
('Moreau', 'Thomas', 'thomas.moreau@pro.fr', '0789123456', 'Coach sportif', 'mixte', 'Coach certifié en fitness', 12, '13001', 3, 2);

-- Insertion d'étudiants
INSERT INTO ETUDIANT (nom, prenom, email, telephone, code_postal, niveau_etude, date_inscription) VALUES
('Robert', 'Alice', 'alice.robert@etu.fr', '0891234567', '75015', 'Master 2', '2024-01-15'),
('Simon', 'Lucas', 'lucas.simon@etu.fr', '0912345678', '69003', 'Licence 3', '2024-02-20'),
('Laurent', 'Emma', 'emma.laurent@etu.fr', '0123456790', '13008', 'Doctorat', '2024-03-10');

-- Insertion de rendez-vous
INSERT INTO RENDEZ_VOUS (date_rdv, mode_consultation, status_rdv, date_demande, id_etudiant, id_professionel) VALUES
('2024-04-15 10:00:00', 'en_ligne', 'confirme', '2024-04-01 09:00:00', 1, 1),
('2024-04-16 14:30:00', 'presentiel', 'demande', '2024-04-02 10:30:00', 2, 2),
('2024-04-17 16:00:00', 'mixte', 'annule', '2024-04-03 11:45:00', 3, 3);

-- Insertion de conversations
INSERT INTO CONVERSATION (contenu, date_envoi, emetteur, id_etudiant, id_professionel, lu) VALUES
('Bonjour, je souhaite prendre rendez-vous pour une consultation.', '2024-04-01 09:00:00', 'etudiant', 1, 1, TRUE),
('Bonjour Alice, je suis disponible le 15 avril à 10h. Cela vous convient-il?', '2024-04-01 10:30:00', 'professionnel', 1, 1, TRUE),
('Oui, parfait. Merci beaucoup!', '2024-04-01 11:00:00', 'etudiant', 1, 1, FALSE);

-- ============================================
-- CORRECTION : INSERTION D'ENTRETIENS AVANT LA CRÉATION DES VUES
-- ============================================

-- Désactiver temporairement les vérifications de clés étrangères
SET FOREIGN_KEY_CHECKS = 0;

-- Insertion d'entretiens - CORRECTION ICI
INSERT INTO ENTRETIEN (id_administrateur, id_professionel, id_medecin, date_entretien, statut, notes) VALUES
(1, 1, 1, '2024-03-01 14:00:00', 'termine', 'Entretien très positif, compétences confirmées'),
(1, 2, 2, '2024-03-15 10:00:00', 'planifie', 'Entretien d''embauche initial'),
(2, 3, 1, '2024-04-01 16:00:00', 'annule', 'Reporté à la demande du candidat'),
(2, 1, 2, '2024-04-10 11:00:00', 'termine', 'Entretien de suivi annuel'),
(1, 3, 2, '2024-04-20 09:30:00', 'planifie', 'Entretien d''évaluation');

-- Réactiver les vérifications de clés étrangères
SET FOREIGN_KEY_CHECKS = 1;

-- ============================================
-- CRÉATION DES VUES UTILES
-- ============================================

-- Vue pour les rendez-vous à venir
CREATE OR REPLACE VIEW V_RENDEZ_VOUS_A_VENIR AS
SELECT 
    r.id_rendez_vous,
    r.date_rdv,
    r.mode_consultation,
    r.status_rdv,
    CONCAT(e.prenom, ' ', e.nom) AS etudiant,
    CONCAT(p.prenom, ' ', p.nom) AS professionnel,
    p.specialiste
FROM RENDEZ_VOUS r
JOIN ETUDIANT e ON r.id_etudiant = e.id_etudiant
JOIN PROFESSIONEL p ON r.id_professionel = p.id_professionel
WHERE r.date_rdv > NOW()
AND r.status_rdv IN ('demande', 'confirme')
ORDER BY r.date_rdv;

-- Vue pour les conversations non lues
CREATE OR REPLACE VIEW V_MESSAGES_NON_LUS AS
SELECT 
    c.id_message,
    c.contenu,
    c.date_envoi,
    c.emetteur,
    CONCAT(e.prenom, ' ', e.nom) AS etudiant,
    CONCAT(p.prenom, ' ', p.nom) AS professionnel,
    c.lu
FROM CONVERSATION c
JOIN ETUDIANT e ON c.id_etudiant = e.id_etudiant
JOIN PROFESSIONEL p ON c.id_professionel = p.id_professionel
WHERE c.lu = FALSE
ORDER BY c.date_envoi DESC;

-- Vue pour les entretiens à venir
CREATE OR REPLACE VIEW V_ENTRETIENS_A_VENIR AS
SELECT 
    e.id_entretien,
    e.date_entretien,
    e.statut,
    e.notes,
    CONCAT(a.prenom, ' ', a.nom) AS administrateur,
    CONCAT(p.prenom, ' ', p.nom) AS professionnel,
    p.specialiste,
    CONCAT(m.prenom, ' ', m.nom) AS medecin
FROM ENTRETIEN e
JOIN ADMINISTRATEUR a ON e.id_administrateur = a.id_administrateur
JOIN PROFESSIONEL p ON e.id_professionel = p.id_professionel
JOIN MEDECIN m ON e.id_medecin = m.id_medecin
WHERE e.date_entretien > NOW()
AND e.statut IN ('planifie', 'confirme')
ORDER BY e.date_entretien;

-- Vue pour les statistiques des professionnels
CREATE OR REPLACE VIEW V_STATISTIQUES_PROFESSIONNELS AS
SELECT 
    p.id_professionel,
    CONCAT(p.prenom, ' ', p.nom) AS professionnel,
    p.specialiste,
    p.statut,
    COUNT(DISTINCT r.id_rendez_vous) AS nb_rendez_vous,
    COUNT(DISTINCT c.id_message) AS nb_messages,
    COUNT(DISTINCT e.id_entretien) AS nb_entretiens,
    AVG(p.delai_reponse) AS delai_reponse_moyen
FROM PROFESSIONEL p
LEFT JOIN RENDEZ_VOUS r ON p.id_professionel = r.id_professionel
LEFT JOIN CONVERSATION c ON p.id_professionel = c.id_professionel
LEFT JOIN ENTRETIEN e ON p.id_professionel = e.id_professionel
GROUP BY p.id_professionel, p.prenom, p.nom, p.specialiste, p.statut;

-- ============================================
-- CRÉATION DES PROCÉDURES STOCKÉES
-- ============================================

-- Procédure pour prendre un rendez-vous
DELIMITER //
CREATE PROCEDURE PrendreRendezVous(
    IN p_id_etudiant INT,
    IN p_id_professionel INT,
    IN p_date_rdv DATETIME,
    IN p_mode_consultation VARCHAR(20)
)
BEGIN
    DECLARE v_disponible BOOLEAN;
    DECLARE v_professionnel_statut VARCHAR(20);
    
    -- Vérifier le statut du professionnel
    SELECT statut INTO v_professionnel_statut
    FROM PROFESSIONEL
    WHERE id_professionel = p_id_professionel;
    
    IF v_professionnel_statut != 'disponible' THEN
        SELECT 'Le professionnel n''est pas disponible pour de nouveaux rendez-vous' AS message, NULL AS id_rendez_vous;
    ELSE
        -- Vérifier si le professionnel est disponible à cette heure
        SELECT COUNT(*) = 0 INTO v_disponible
        FROM RENDEZ_VOUS
        WHERE id_professionel = p_id_professionel
        AND date_rdv = p_date_rdv
        AND status_rdv NOT IN ('annule', 'termine');
        
        IF v_disponible THEN
            INSERT INTO RENDEZ_VOUS (date_rdv, mode_consultation, date_demande, id_etudiant, id_professionel)
            VALUES (p_date_rdv, p_mode_consultation, NOW(), p_id_etudiant, p_id_professionel);
            
            SELECT 'Rendez-vous pris avec succès' AS message, LAST_INSERT_ID() AS id_rendez_vous;
        ELSE
            SELECT 'Le professionnel n''est pas disponible à cette heure' AS message, NULL AS id_rendez_vous;
        END IF;
    END IF;
END //
DELIMITER ;

-- Procédure pour créer un nouvel entretien
DELIMITER //
CREATE PROCEDURE CreerEntretien(
    IN p_id_administrateur INT,
    IN p_id_professionel INT,
    IN p_id_medecin INT,
    IN p_date_entretien DATETIME,
    IN p_notes TEXT
)
BEGIN
    DECLARE v_disponible BOOLEAN;
    
    -- Vérifier si tous les participants sont disponibles
    SELECT COUNT(*) = 0 INTO v_disponible
    FROM ENTRETIEN
    WHERE (id_administrateur = p_id_administrateur 
           OR id_professionel = p_id_professionel
           OR id_medecin = p_id_medecin)
    AND date_entretien = p_date_entretien
    AND statut IN ('planifie', 'confirme');
    
    IF v_disponible THEN
        INSERT INTO ENTRETIEN (id_administrateur, id_professionel, id_medecin, date_entretien, notes)
        VALUES (p_id_administrateur, p_id_professionel, p_id_medecin, p_date_entretien, p_notes);
        
        SELECT 'Entretien créé avec succès' AS message, LAST_INSERT_ID() AS id_entretien;
    ELSE
        SELECT 'Un ou plusieurs participants ne sont pas disponibles à cette heure' AS message, NULL AS id_entretien;
    END IF;
END //
DELIMITER ;

-- ============================================
-- CRÉATION DES DÉCLENCHEURS (TRIGGERS)
-- ============================================

-- Trigger pour mettre à jour automatiquement le statut du rendez-vous si la date est passée
DELIMITER //
CREATE TRIGGER tr_update_rdv_status_after_date
BEFORE UPDATE ON RENDEZ_VOUS
FOR EACH ROW
BEGIN
    IF NEW.date_rdv < NOW() AND NEW.status_rdv NOT IN ('termine', 'annule') THEN
        SET NEW.status_rdv = 'termine';
    END IF;
END //
DELIMITER ;

-- Trigger pour archiver les rendez-vous annulés
DELIMITER //
CREATE TRIGGER tr_archive_rdv_annule
AFTER UPDATE ON RENDEZ_VOUS
FOR EACH ROW
BEGIN
    IF NEW.status_rdv = 'annule' AND OLD.status_rdv != 'annule' THEN
        INSERT INTO RENDEZ_VOUS_ARCHIVE 
        SELECT *, NOW() FROM RENDEZ_VOUS WHERE id_rendez_vous = NEW.id_rendez_vous;
    END IF;
END //
DELIMITER ;

-- Trigger pour mettre à jour le statut d'un professionnel après un entretien réussi
DELIMITER //
CREATE TRIGGER tr_update_professionnel_after_entretien
AFTER UPDATE ON ENTRETIEN
FOR EACH ROW
BEGIN
    IF NEW.statut = 'termine' AND OLD.statut != 'termine' THEN
        UPDATE PROFESSIONEL 
        SET statut = 'embauche'
        WHERE id_professionel = NEW.id_professionel;
    END IF;
END //
DELIMITER ;

-- ============================================
-- CRÉATION DE LA TABLE D'ARCHIVAGE
-- ============================================

CREATE TABLE RENDEZ_VOUS_ARCHIVE (
    id_rendez_vous INT,
    date_rdv DATETIME NOT NULL,
    mode_consultation VARCHAR(20) NOT NULL,
    status_rdv VARCHAR(20) NOT NULL,
    date_demande DATETIME NOT NULL,
    id_etudiant INT NOT NULL,
    id_professionel INT NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    date_archivage TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_date_archivage (date_archivage)
);

-- ============================================
-- CRÉATION DES INDEX SUPPLÉMENTAIRES
-- ============================================

-- Index pour les recherches par code postal
CREATE INDEX idx_etudiant_code_postal ON ETUDIANT(code_postal);
CREATE INDEX idx_professionel_code_postal ON PROFESSIONEL(code_postal);

-- Index pour les recherches par spécialité et mode de consultation
CREATE INDEX idx_professionel_specialite_mode ON PROFESSIONEL(specialiste, mode_consultation);

-- Index pour les statistiques
CREATE INDEX idx_rdv_statut_date ON RENDEZ_VOUS(status_rdv, date_rdv);

-- Index pour les entretiens
CREATE INDEX idx_entretien_date_statut ON ENTRETIEN(date_entretien, statut);

-- ============================================
-- TESTS DE VÉRIFICATION
-- ============================================

-- Vérification que les entretiens sont bien insérés
SELECT '=== VÉRIFICATION DES DONNÉES ===' AS test;
SELECT 'Nombre d\'entretiens insérés:' AS description, COUNT(*) AS valeur FROM ENTRETIEN;
SELECT '=== DÉTAILS DES ENTRETIENS ===' AS test;
SELECT 
    e.id_entretien,
    e.date_entretien,
    e.statut,
    CONCAT(a.prenom, ' ', a.nom) AS administrateur,
    CONCAT(p.prenom, ' ', p.nom) AS professionnel,
    CONCAT(m.prenom, ' ', m.nom) AS medecin
FROM ENTRETIEN e
JOIN ADMINISTRATEUR a ON e.id_administrateur = a.id_administrateur
JOIN PROFESSIONEL p ON e.id_professionel = p.id_professionel
JOIN MEDECIN m ON e.id_medecin = m.id_medecin
ORDER BY e.date_entretien;

-- Test de la vue des entretiens à venir
SELECT '=== ENTRETIENS À VENIR ===' AS test;
SELECT * FROM V_ENTRETIENS_A_VENIR;

-- ============================================
-- FIN DU SCRIPT SQL
-- ============================================