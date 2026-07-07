# CLAUDE.md

## Contexte

Ce dépôt est le fork de `wordpress-seo` (plugin Yoast) utilisé par Frédéric LE GUEN
comme espace de travail pour les tâches liées à ses sites **excel-exercice.com** (FR)
et **excel-exercise.com** (EN). Les sites WordPress eux-mêmes ne sont pas dans ce
dépôt : les contenus arrivent via des exports (phpMyAdmin, exports de plugins)
fournis en cours de session.

## Conventions

- **Langue** : répondre en français.
- **Livrables** : tout fichier destiné à être récupéré par Frédéric (JSON d'import,
  scripts SQL, prévisualisations HTML, exports...) doit être placé dans le
  répertoire **`/deploy/`** à la racine du dépôt, puis commité et poussé sur la
  branche de travail de la session. En plus de l'envoi en pièce jointe dans la
  conversation.
- Nommer les fichiers de façon explicite, en français, sans espaces
  (ex. `foxlms-import-comparer-N-N1.json`).
- **Code PHP pour le site** : Frédéric utilise le plugin **Code Snippets**
  (pas de mu-plugins, pas d'édition de functions.php). Fournir dans la
  conversation : le titre du snippet, le code sans balise `<?php`, et le
  réglage d'exécution (partout / admin / front).

## Écosystème des sites

- LMS : **Fox LMS Pro** (AYS Pro) — vente des cours via le paiement intégré
  (type « paynow », Stripe/PayPal).
- Quiz : **Quiz Maker Pro** (AYS Pro), intégré à Fox LMS.
- Ancien système de quiz/cours : **WatuPRO** (tables `wpmg_watupro_*`),
  en cours de migration vers Fox LMS.
- E-commerce : WooCommerce présent ; les cours restent vendus via Fox LMS.
