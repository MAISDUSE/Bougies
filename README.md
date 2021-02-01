# TP PHP  - Bougies

## IMR 1 - 2020 - 2021

**Auteurs :**
- DUSÉ Mathieu
- PONTACQ Hugo

**Disclaimer :**
- Ce TP est basé sur un framework codé main par nos soins dans le cadre du projet et basé sur certains aspects sur Laravel.
    Ce projet n'utilise donc pas de frameworks existants ni repris d'anciens TP.

---

## Instructions

- Renommer app/config/ConfigExample.php en app/config/Config.php
  - Renommer la Classe ConfigExample en Config
  - Adapter la configuration
    - `config['db_****']` -> configuration de la base de donnée
    - `config['template_key']` -> mot clé du générateur de template (`default: 'layout'`, ce tp utilise le mot clé par défaut)
    - `config['debug']`
        - `true` -> Affiche les exceptions
        - `false` -> Affiche seulement une page d'erreur avec le code erreur
    
- Lancer le serveur php à la racine du projet à l'aide de `php -S localhost:8000 -t ./public`

- Point d'entrée public/index.php   
    - Serveur lancé dans public -> restriction d'accès aux autres dossiers


---

## Arborescence

- app -> Concerne l'instance du framework
    - config -> Contient le fichier de configuration
    - controllers -> Contient tous les controllers
    - models -> Contient tous les models
    
- core -> Contient tout le noyau du framework

- public -> Contient le point d'entrée et les ressources strictement accessible par le client, les autres dossiers lui sont impossible d'accès

- resources -> Contient toutes les ressources du framework
    - views -> Contient toutes les vues

- routes -> Contient les routes
