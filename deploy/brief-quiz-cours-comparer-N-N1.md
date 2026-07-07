# Brief : rédaction des quiz du cours « Comparer 2 périodes N et N-1 dans Excel »

> Document à transmettre tel quel à la conversation chargée de rédiger les quiz.
> Il est autonome : tout le contexte nécessaire est dedans.

## 1. Contexte

- Site : **excel-exercice.com** (WordPress), auteur Frédéric LE GUEN.
- LMS : **Fox LMS Pro** (AYS Pro). Quiz : **Quiz Maker Pro** (AYS Pro), intégré à Fox LMS.
- Le cours « Comparer 2 périodes N et N-1 dans Excel » (19,99 €) vient d'être migré
  depuis WatuPRO : 3 sections, 18 leçons, 4 vidéos YouTube. Il est en ligne.
- Objectif : créer **4 quiz** dans Quiz Maker, puis les insérer dans le course
  builder de Fox LMS (un quiz s'insère comme une « leçon » de type quiz, rendue
  par le shortcode `[ays_quiz id='X']`).
- Modèle de référence : le cours « Les fonctions conditionnelles » du même site
  intercale 5 quiz Quiz Maker entre ses sections.

## 2. Conventions de travail (à respecter par la conversation)

- Répondre **en français**.
- Questions de type **choix unique**, **choix multiple** ou **vrai/faux**
  uniquement (formats natifs Quiz Maker).
- Pour chaque question, fournir : l'énoncé, les propositions, la ou les bonnes
  réponses clairement marquées, et une **explication pédagogique** (affichée
  après la réponse — champ « explanation » de Quiz Maker).
- Ton : bienveillant mais précis ; 1 à 2 questions « piège » par quiz maximum.
- Livrable : un fichier par quiz (Markdown ou tableau), nommé en français sans
  espaces (ex. `quiz-1-donnees-power-pivot.md`), déposé dans `/deploy/` du dépôt
  de travail ET envoyé en pièce jointe dans la conversation.

## 3. Structure du cours (rappel du contenu réel des leçons)

**IMPORTANT : les questions doivent s'appuyer exclusivement sur les faits
ci-dessous, qui sont extraits mot pour mot des leçons. Ne rien inventer
au-delà (pas de notion absente du cours).**

### Section 1 — Préparer et charger vos données (8 leçons)

Faits enseignés :
- Un tableau de données doit présenter des données « brutes »/granulaires :
  sans colonne vide, sans ligne récapitulative (par mois, par catégorie...),
  une seule nature de donnée par colonne. Le détail unitaire (une facture par
  ligne) est INDISPENSABLE.
- Erreur classique : une même donnée éclatée sur plusieurs colonnes
  (ex. un mois par colonne). La bonne présentation : une colonne magasin,
  une colonne poste de dépense, une colonne date, une colonne montant.
- Pour réordonner des colonnes mal présentées : **Power Query > Dépivoter les
  colonnes** (vidéo dédiée dans le cours).
- Chargement : mettre les données dans une table (**Insertion > Tableau**),
  nommer le tableau (Création de Tableau > Nom du Tableau), puis
  **Données > À partir d'un Tableau ou d'une plage**.
- Dans Power Query, forcer la colonne des dates au type **Date** (pas
  Date et Heure) via l'icône de l'en-tête de colonne.
- Étape critique : **Fermer et Charger dans...** puis cocher « Ne créer que la
  connexion » ET SURTOUT **« Ajouter ces données au modèle de données »** —
  sans cette case, Power Pivot ne « voit » pas les données et rien ne fonctionne.
- Activer Power Pivot : Fichier > Options > Compléments > Compléments COM >
  Atteindre > cocher Microsoft Power Pivot. Le menu Power Pivot apparaît dans
  le ruban (bouton « Gérer »).
- Le modèle de données utilise le moteur **Vertipaq** : données en lecture
  seule, pas de limite de lignes, les onglets s'appellent des **Tables**, les
  calculs des **Mesures**, les dates s'affichent toujours avec l'heure en plus.

### Section 2 — La Table des Temps (5 leçons)

Faits enseignés :
- Power Pivot exige une table dédiée aux opérations sur les dates : la
  **Table des Temps** (table de dates).
- La méthode recommandée : la créer dans **Power Query** (Données > Obtenir des
  données > À partir d'autres sources > Requête vide, puis coller un script
  fourni dans l'Éditeur avancé). Raison : chargée une seule fois dans le
  modèle, alors qu'une table de temps créée par mesures dans Power Pivot
  serait reconstruite à chaque calcul (mauvaise optimisation).
- Une table des temps contient une colonne de dates **sans un seul jour
  manquant** (week-ends et fériés compris), puis une colonne par composant de
  la date (année, mois en chiffre, mois en lettres, jour de la semaine...).
- Il faut ensuite la recharger dans le modèle de données, puis **la déclarer** :
  interface Power Pivot > menu **Conception > Marquer en tant que table de
  dates**, et indiquer la colonne qui contient les dates (colonne Date).
- Tri des mois : sans intervention, Power Pivot ne sait pas que janvier vient
  en premier. Sélectionner la colonne des mois en lettres > menu Accueil >
  **Trier par colonne** > trier par la colonne numérique des mois. À refaire
  pour les mois courts et les jours.
- Liaison des 2 tables (glisser le champ date d'une table sur l'autre) ;
  conditions impératives : **types de données identiques** entre les deux
  champs, et **valeurs uniques dans l'une des deux tables** (c'est le cas de
  la Table des Temps). Sinon la liaison est impossible.

### Section 3 — Les mesures et le tableau de bord (5 leçons)

Faits enseignés :
- Une mesure s'écrit sous les données dans Power Pivot, dans n'importe quelle
  cellule. Syntaxe : `NomMesure:=FONCTION(...)` (nom séparé par `:=`).
  Toutes les fonctions sont **en anglais**.
- Mesure des ventes de l'année en cours : `Ventes:=SUM([Total])`.
- Une mesure ne prend son sens que dans un **TCD** : pour chaque combinaison
  Année + Mois placée en ligne, la mesure est recalculée selon ce « contexte »
  (notion centrale du cours).
- Une mesure se distingue des autres champs du TCD par le symbole **fx**.
- Mesure N-1 : `Ventes N-1:=CALCULATE([Ventes];DATEADD(Table_Temps[Date];-1;YEAR))`
  - `CALCULATE` « altère » le résultat d'une mesure existante ;
  - `DATEADD` applique le décalage : 1er paramètre **obligatoirement la colonne
    Date de la Table des Temps** (c'est la raison d'être de cette table),
    puis `-1`, puis la période `YEAR` (on aurait pu mettre `MONTH` ou `QUARTER`).
- Mesure de variation : `Var N-1:=DIVIDE([Ventes]-[Ventes N-1]; [Ventes N-1])`
  - `DIVIDE` plutôt qu'une division simple car sur la **première année du
    modèle** il y aurait une division par 0 (donc erreur) ; DIVIDE gère ce cas.
  - Le résultat s'affiche en pourcentage via le **symbole % du ruban Power
    Pivot**.
- Comportement observable : le montant des ventes de 2020 se reporte dans la
  colonne « Ventes N-1 » sur la ligne 2021.

## 4. Les 4 quiz à rédiger

### Quiz 1 (fin de section 1) — « Vos données sont-elles prêtes pour Power Pivot ? »
6-7 questions. Thèmes : reconnaître un tableau mal construit ; définition de
donnée granulaire ; quand dépivoter ; type Date vs Date et Heure ; la case
« Ajouter ces données au modèle de données » (question piège recommandée) ;
où activer le complément Power Pivot.

### Quiz 2 (fin de section 2) — « Maîtrisez-vous la Table des Temps ? »
6-7 questions. Thèmes : rôle de la table des temps ; continuité des dates
(vrai/faux) ; pourquoi la créer dans Power Query plutôt qu'en mesures ;
« Marquer en tant que table de dates » (où, quelle colonne) ; tri des mois ;
les 2 conditions d'une liaison entre tables.

### Quiz 3 (fin de section 3) — « Les mesures DAX et la comparaison N/N-1 »
7-8 questions. Thèmes : syntaxe d'une mesure (repérer l'erreur) ; notion de
contexte dans un TCD ; rôles de CALCULATE et DATEADD ; la colonne obligatoire
dans DATEADD ; adapter au trimestre/mois ; pourquoi DIVIDE ; affichage en %.

### Quiz 4 (fin de cours) — « Validez votre maîtrise complète »
10 questions transversales, orientées cas pratiques. Exemples de situations :
« Votre TCD affiche des valeurs vides en colonne N-1 pour la première année,
est-ce normal ? » (oui — pas d'année antérieure dans le modèle) ; « La liaison
entre vos deux tables échoue : citez les 2 causes possibles » ; « Vos mois
s'affichent par ordre alphabétique : que faire ? » ; « Power Pivot ne voit pas
vos données : quelle case avez-vous oubliée ? ».

## 5. Après rédaction (pour information)

Frédéric saisira les quiz dans Quiz Maker Pro, puis les insérera dans le course
builder Fox LMS à la fin de chaque section. Si une automatisation de l'import
des questions est souhaitée, lui demander le zip du plugin Quiz Maker Pro pour
en analyser les tables (`wpmg_aysquiz_quizes`, `wpmg_aysquiz_questions`,
`wpmg_aysquiz_answers`) — c'est la même approche qui a servi à générer le
fichier d'import Fox LMS du cours.
