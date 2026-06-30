# 🚗 Drive Mart — Laravel Car Marketplace

A modern, high-performance car marketplace application built with **Laravel 11**, **Tailwind CSS**, and **Vite**. Features premium UX animations, multi-image upload integration via **Cloudinary**.

---

## ⚡ Features

- **🔐 Secure Authentication:** Full session and user management, custom profiles, and authenticated listing management.
- **🖼️ Multi-Image Picker:** Beautiful custom-built drag-and-drop preview picker allowing up to 5 images per car, with instant client-side deletion.
- **☁️ Cloudinary Storage:** Direct cloud image uploading and optimization driver, perfectly tailored for ephemeral/serverless environments.
- **🔍 Advanced Search & Filters:** Filter listings dynamically by Maker, Model, Year, Price range, Fuel type, and location.
- **⭐ Watchlist System:** Toggle favorite cars to a dedicated watchlist page.


---

## 🛠️ Tech Stack

- **Framework:** Laravel 11 (PHP 8.3+)
- **Frontend Assets:** Tailwind CSS v4, Vite, Vanilla JS
- **Database:** MySQL / Aiven Cloud Database (via SSL CA)
- **File Storage:** Cloudinary CDN


---

## 🚀 Local Quickstart

### 1. Clone the repository
```bash
git clone https://github.com/widushan/Laravel-Car-Marketplace.git
cd Laravel-Car-Marketplace/laravel-CarMarketPlace
```

### 2. Configure Environment Variables
Copy the `.env.example` file to `.env` and fill in your Aiven Database and Cloudinary credentials:
```bash
cp .env.example .env
```

### 3. Run Setup Script
Run the automated composer, NPM, migration, and build processes:
```bash
composer run setup
```

### 4. Start Development Server
```bash
composer run dev
```
Visit `http://localhost:8000` to start exploring!

---
<img width="1897" height="1025" alt="Image" src="https://github.com/user-attachments/assets/72b02875-9b90-4518-8382-35ff7bdaffab" />

<img width="1901" height="1005" alt="Image" src="https://github.com/user-attachments/assets/5987bee7-20dd-4bab-b510-9981f665de8c" />

<img width="1893" height="1030" alt="Image" src="https://github.com/user-attachments/assets/941efb23-ab3b-453e-b52d-8b32748b93fe" />

1. Push your code to GitHub.
2. Link your repository in the Vercel Dashboard.
3. In the Vercel project **Settings > General**:
   - Set **Root Directory** to `laravel-CarMarketPlace`.
4. Under **Settings > Environment Variables**, add your production env values (e.g., `APP_KEY`, `DB_HOST`, `CLOUDINARY_URL`, `MYSQL_SSL_CA_CERT`).
5. Trigger your deployment!

---
Made with ❤️ by [Widushan](https://github.com/widushan)
