# KÜLKAT - Különleges Lények Katasztere

## 📋 Projekt Leírás
Ez egy teljes körű full-stack webalkalmazás különleges lények (állatok, mitikus lények stb.) katalogizálására. A projekt Laravel backend API-t és Angular frontend SPA-t tartalmaz.

## 🏗️ Architektúra

### Backend (Laravel 12)
- **Framework:** Laravel 12.42.0
- **Adatbázis:** SQLite
- **Autentikáció:** Laravel Sanctum (Bearer Token)
- **Port:** http://127.0.0.1:8000

### Frontend (Angular 19)
- **Framework:** Angular 19
- **UI:** Modern gradient design (#667eea → #764ba2)
- **Port:** http://localhost:4200
- **Repository:** [kulkat-frontend](https://github.com/kiszol/kulkat-frontend)

## 📦 Backend Telepítés

```bash
cd kulkat-backend

# Composer függőségek telepítése
composer install

# .env fájl másolása
copy .env.example .env

# Adatbázis létrehozása
type nul > database/database.sqlite

# Migrációk futtatása
php artisan migrate

# Tesztadatok feltöltése
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=KategoriaSeeder
php artisan db:seed --class=KepessegSeeder

# Szerver indítása
php artisan serve
```

## 🔐 Teszt Felhasználók

- **Admin:** admin@kulkat.hu / password123
- **User:** test@kulkat.hu / password123

## 📊 Adatbázis Struktúra

### Táblák (7 db)
1. **users** - Felhasználók
2. **kategorias** - Kategóriák (Szárazföldi, Vízi, Légi, stb.)
3. **lenies** - Lények (fő tábla)
4. **kepessegs** - Képességek
5. **galeria_keps** - Galéria képek
6. **kapcsolati_uzenets** - Kapcsolati üzenetek
7. **leny_kepesseg** - Pivot tábla (Lény ↔ Képesség N:N)

### Kapcsolatok (5+ db)
- User → Lények (1:N)
- Lény → Kategória (N:1)
- Lény → Képességek (N:N)
- Lény → Galéria (1:N)

## 🛣️ API Endpointok

### Publikus
- `POST /api/register` - Regisztráció
- `POST /api/login` - Bejelentkezés
- `GET /api/creatures` - Lények listája
- `GET /api/kategoriak` - Kategóriák
- `GET /api/kepessegek` - Képességek
- `POST /api/contact` - Kapcsolatfelvétel

### Védett (auth:sanctum)
- `POST /api/logout` - Kijelentkezés
- `GET /api/user` - Aktuális felhasználó
- `POST /api/creatures` - Új lény
- `PUT /api/creatures/{id}` - Lény módosítása
- `DELETE /api/creatures/{id}` - Lény törlése
- `POST /api/galeria` - Galéria kép feltöltése

## 🎨 Frontend Komponensek

1. **LoginComponent** - Bejelentkezés
2. **RegisterComponent** - Regisztráció
3. **CreatureListComponent** - Lények listája
4. **CreatureFormComponent** - Lény létrehozása/szerkesztése
5. **CreatureDetailComponent** - Lény részletei
6. **ContactComponent** - Kapcsolatfelvétel

## 🚀 Indítás

```bash
# Backend
cd kulkat-backend
php artisan serve

# Frontend (másik terminálban)
cd kulkat-frontend
ng serve
```

Majd nyisd meg: http://localhost:4200

## 📝 Funkciók

✅ Regisztráció és bejelentkezés  
✅ Lények CRUD műveletek  
✅ Kategóriák és képességek kezelése  
✅ Galéria funkció  
✅ Kapcsolatfelvételi űrlap  
✅ Bearer Token autentikáció  
✅ Responsive design  
✅ Modern UI/UX  

## 👨‍💻 Fejlesztő

**Név:** kiszol  
**GitHub:** https://github.com/kiszol  
**Repository:** https://github.com/kiszol/kulkat

## 📅 Verzió

- **Dátum:** 2025.12.10
- **Verzió:** 1.0.0
- **Státusz:** ✅ Működő

---

*Ez a projekt egy teljes körű vizsga/beadandó feladat megoldása.*
