# Experiment Waterfall vs. Scrum – štartovací projekt M0

Tento repozitár obsahuje spoločný štartovací projekt pre experiment diplomovej práce zameraný na porovnanie metodík Waterfall a Scrum.

Projekt obsahuje iba spoločné technické prostredie. Samotná funkcionalita experimentálnych modulov bude implementovaná študentmi.

## Použité technológie

- PHP 8.5
- CodeIgniter 4.7.5
- MariaDB / MySQL
- Bootstrap 5
- Git
- GitHub

## Požiadavky

Pred spustením projektu je potrebné mať nainštalované:

- PHP
- Composer
- Git
- XAMPP alebo iné lokálne prostredie s MariaDB/MySQL
- Visual Studio Code alebo iný editor

Odporúčaná konfigurácia:

- PHP 8.5
- Composer 2.x
- CodeIgniter 4.7.5
- MariaDB/MySQL na porte 3306

## Prvé spustenie projektu

### 1. Naklonovanie repozitára

Naklonujte pridelený tímový repozitár:
git clone URL_REPOZITARA

Potom prejdite do priečinka projektu:
cd NAZOV_REPOZITARA

### Inštalácia závislostí
Spustite: composer install

Príkaz nainštaluje všetky potrebné PHP balíky podľa súboru composer.lock.

Počas experimentu nepoužívajte:
composer update
aby všetky tímy používali rovnaké verzie závislostí.

### Vytvorenie lokálneho .env
V koreňovom priečinku projektu sa nachádza súbor:
.env.example

Vytvorte jeho kópiu a pomenujte ju:
.env

Súbor .env sa neukladá do Git repozitára.

### Vytvorenie databázy
V phpMyAdmin alebo inom databázovom nástroji vytvorte databázu:
dp_experiment

Zatiaľ nie je potrebné vytvárať žiadne tabuľky.

Tabuľky konkrétneho modulu budú vytvorené počas implementácie.
### Nastavenie databázového pripojenia
V súbore .env skontrolujte:
CI_ENVIRONMENT = development

app.baseURL = 'http://localhost:8080/'

database.default.hostname = 127.0.0.1
database.default.database = dp_experiment
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.port = 3306

Ak používate iné databázové meno, heslo alebo port, upravte si tieto hodnoty podľa lokálneho prostredia.
### Spustenie databázového servera
Ak používate XAMPP, spustite:
- Apache
- MySQL
### Spustenie aplikácie
V termináli v koreňovom priečinku projektu spustite:
php spark serve

Aplikácia bude dostupná na adrese:
http://localhost:8080

Ak sa zobrazí úvodná stránka projektu M0, prostredie je pripravené.
### Štruktúra projektu
Najdôležitejšie priečinky:
app/
├── Controllers/
├── Database/
├── Models/
├── Views/
└── Config/

# Význam:
- Controllers – aplikačná logika
- Models – práca s databázou
- Views – používateľské rozhranie
- Database – migrácie a ďalšie databázové súbory
- Config – konfigurácia aplikácie
### Databázové migrácie
Databázová štruktúra má byť počas vývoja vytváraná pomocou CodeIgniter migrations.

Príklad vytvorenia migrácie:
php spark make:migration CreateExampleTable

Spustenie migrácií:
php spark migrate

Databázové tabuľky sa nemajú medzi členmi tímu prenášať iba manuálnym exportom z phpMyAdmin. Zmeny databázovej štruktúry majú byť uložené v Git repozitári prostredníctvom migrácií.

### Tabuľka učební a testovacie údaje (M1)
Tabuľka `rooms` sa vytvára migráciou a plní seederom. Oba príkazy sa spúšťajú v koreňovom priečinku projektu:

php spark migrate
php spark db:seed RoomSeeder

- `migrate` vytvorí tabuľku `rooms`.
- `db:seed RoomSeeder` vloží tri testovacie učebne (U101, U102, U103). Seeder je možné spustiť opakovane, existujúce kódy sa preskočia.
- `migrate:rollback` tabuľku zmaže, následným `migrate` sa vytvorí nanovo.

Tabuľka používa collation `utf8mb4_uca1400_as_ci`, na ktorú je potrebná MariaDB 10.10 alebo novšia. Pri staršej verzii migrácia skončí chybou `Unknown collation`. Verzia sa zistí príkazom `SELECT VERSION();`.

### Git workflow
Každá funkčná požiadavka má byť implementovaná v samostatnej branche.

Príklad:
git checkout -b feature/M1-P1-add-room

Po dokončení práce:
git add .
git commit -m "Implement M1-P1 add room"
git push