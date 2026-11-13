# Barangay Bulletin – Purok Valdepenas

## Logins (password: bulletin2026)
- lola.valdepenas@bulletin.test (resident)
- kagawad.valdepenas@bulletin.test (Kagawad)

## Tags
Purok Valdepenas, Urgent, Libre, Schedule, Event

## Relationships
- User hasOne Author: one login = one author profile
- Author hasMany Post: one author, many posts
- Post hasMany Comment: one post, many comments
- User hasMany Comment: one user, many comments
- Post belongsToMany Tag: many-to-many, so it needs the post_tag pivot
- Author hasManyThrough Comment: all comments on an author's posts

## How to run
```
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
npm install
npm run dev
php artisan serve
```