# Apartmani PHP - Projektna Struktura

## Reorganizovana struktura foldera

```
apartmant2/
├── admin/                    # Admin panel fajlovi
│   ├── apartment-delete.php  # Brisanje apartmana
│   ├── apartment-edit.php    # Dodavanje/editovanje apartmana
│   ├── apartments.php        # Admin prikaz svih apartmana
│   ├── audit.php             # Audit log
│   ├── db.php                # Admin baza podataka konekcija
│   ├── index.php             # Admin dashboard
│   ├── init.php              # Admin inicijalizacija
│   ├── login.php             # Admin prijava
│   ├── logout.php            # Admin odjava
│   ├── migrate.php           # Migracija admin baze
│   ├── register.php          # Admin registracija
│   ├── settings.php          # Admin podešavanja
│   └── setup.php             # Admin setup skript
├── api/                      # REST API endpointi
│   ├── apartment.php         # API - jedan apartman
│   └── apartments.php        # API - lista apartmana
├── assets/                   # Statički resursi
│   ├── css/
│   │   ├── cta.css           # CTA komponenta stilovi
│   │   ├── location.css      # Lokacija stilovi
│   │   └── style.css         # Glavni stilovi
│   ├── images/
│   │   ├── about/            # About stranica slike
│   │   ├── beds.svg          # Ikona kreveta
│   │   ├── baths.svg         # Ikona kupaonica
│   │   ├── guests.svg        # Ikona gostiju
│   │   └── sofabeds.svg      # Ikona sofa kreveta
│   └── js/
│       ├── apartment-detail.js  # Detalji apartmana JS
│       ├── calendar.js          # Kalendarsko biranje datuma
│       ├── featured-carousel.js # Karusel za preporučene
│       └── slider.js            # Slider komponenta
├── config/                   # Konfiguracija
│   ├── bootstrap.php         # Bootstrap: učitava sve potrebne fajlove
│   ├── database.php          # Baza podataka konekcije
│   └── i18n.php              # Lokalizacija (jezici)
├── includes/                 # Delovi stranica
│   ├── cta.php               # CTA sekcija
│   ├── featured-apartments.php # Preporučeni apartmani
│   ├── hero.php              # Hero sekcija
│   ├── layout.php            # Layout: header, footer, HTML struktura
│   └── location.php          # Lokacija sekcija
├── lang/                     # Jezički fajlovi
│   ├── de.php                # Nemački
│   ├── en.php                # Engleski
│   ├── fr.php                # Francuski
│   └── hr.php                # Hrvatski
├── migrations/               # SQL migracije
│   ├── 001_create_mysql_schema.sql    # Kreiranje apartmani baze
│   ├── 002_seed_mysql.sql             # Početni podaci
│   └── 003_create_admin_schema.sql    # Kreiranje admin baze
├── pages/                    # Glavne stranice
│   ├── index.php             # Početna stranica
│   ├── apartments.php        # Lista apartmana
│   ├── apartment.php         # Detalji apartmana
│   ├── about.php             # O nama stranica
│   └── contact.php           # Kontakt stranica
├── src/                      # Core logika
│   ├── data.php              # Funkcije za učitavanje podataka
│   └── db.php                # Baza podataka helper funkcije
├── index.php                 # Root entry point → pages/index.php
├── .htaccess                 # Apache URL rewrite pravila
└── .git/                     # Git repozitorijum
```

## Ključne izmene

### 1. **Reorganizacija Stranica**
   - Sve glavne stranice (`index.php`, `apartments.php`, `apartment.php`, `about.php`, `contact.php`) su premještene u `pages/` folder
   - U rootu ostaje samo `index.php` koji redirekcuje na `pages/index.php`
   - Apache `.htaccess` pravila čuvaju backward compatibility sa starim URL-ovima
   - Sve putanje u kodu su ažurirane da koriste `pages/` folder

### 2. **Obrisani Prazni Folderi**
   - `data/` - bio je prazan
   - `database/` - bio je prazan
   - `scripts/` - bio je prazan

### 3. **Ispravljena Greška u Kodu**
   - `db_exec()` funkcija je zamjenjena sa `db_execute()` u:
     - `admin/apartment-edit.php`
     - `admin/apartment-delete.php`

### 4. **Ažurirani Linkovi**
   - `includes/layout.php` - svi linkovi na stranice ažurirani na `/pages/` putanje
   - `includes/featured-apartments.php` - linkovi na `apartment.php` → `pages/apartment.php`
   - `includes/cta.php` - linkovi na stranice koriste `url('pages/...')` putanje
   - `pages/apartments.php` - linkovi na detalje apartmana
   - `pages/apartment.php` - linkovi na listu apartmana

## Kako funkcionira struktura

### Root Entry Point
```php
// index.php (root)
<?php
require_once __DIR__ . '/pages/index.php';
// Učitava stvarnu stranicu iz pages/index.php
```

### Apache URL Rewrite
`.htaccess` fajl omogućava:
- `/` → `/pages/index.php`
- `/apartments.php` → `/pages/apartments.php`
- `/apartment.php` → `/pages/apartment.php`
- `/about.php` → `/pages/about.php`
- `/contact.php` → `/pages/contact.php`

Ovo čini aplikaciju fleksibilnom za različita okruženja (sa ili bez `.htaccess` podrške)

### Autoload kroz Bootstrap
1. Svaka stranica zahteva `/config/bootstrap.php`
2. Bootstrap automatski učitava:
   - Konfiguraciju (`config/database.php`, `config/i18n.php`)
   - Core podatke (`src/data.php`)
   - Layout (`includes/layout.php`)

## Nazive Fajlova i Organizacija

✅ **Logično organizovano po:**
- `admin/` - sve admin operacije
- `api/` - svi API endpointi
- `assets/` - statički resursi
- `config/` - konfiguracija
- `includes/` - delovi HTML stranica
- `lang/` - jezički stringovi
- `migrations/` - SQL sheme i podaci
- `pages/` - glavne stranice aplikacije
- `src/` - core logika, helper funkcije

## Provjera Greške

Nema grešaka ili upozorenja - sve putanje su ispravne i konzistentne.

## Kako Pokrenuti Aplikaciju

```bash
# 1. Postavljanje baze podataka
php admin/setup.php

# 2. Pristup aplikaciji
http://localhost:8000/

# 3. Admin pristup
http://localhost:8000/admin/login.php
```

## Nazivi Funkcija i Konvencije

- **Baza podataka:** `get_db()`, `db_fetch_all()`, `db_fetch_one()`, `db_execute()`
- **Layout:** `site_head()`, `site_footer()`
- **Lokalizacija:** `t('key.name')`, `current_lang()`, `set_lang()`
- **Admin:** `isAdminLoggedIn()`, `requireAdmin()`, `adminUser()`
- **URL:** `url('pages/apartment.php')` - generiše relativnu putanju sa APP_BASE
