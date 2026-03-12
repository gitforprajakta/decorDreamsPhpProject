# Decor Dreams — Deployment on Bluehost (prajaktatech.com)

Follow these steps to host the Decor Dreams website on your domain **prajaktatech.com** using Bluehost.

---

## 1. Prerequisites

- Bluehost account with **prajaktatech.com** (or your domain) pointed to it
- FTP/SFTP credentials or Bluehost File Manager access
- PHP enabled (Bluehost supports PHP by default)

---

## 2. Prepare the Project

On your computer:

1. **Zip the website folder** (optional but convenient):
   - Select all files and folders inside `CMPE272-HWProject` (or the folder containing the site):
     - `index.php`, `about.php`, `products.php`, `news.php`, `contacts.php`
     - `css/` (with `style.css`)
     - `includes/` (with `header.php`, `footer.php`, `config.php`)
     - `data/` (with `contacts.txt`)
     - `images/` (all luxury decor images — run `bash scripts/download-images.sh` if missing)
   - Create a ZIP file (e.g. `decordreams.zip`).

2. **Or** keep the folder structure as-is and upload via FTP/File Manager.

---

## 3. Log In to Bluehost

1. Go to [bluehost.com](https://www.bluehost.com) and log in.
2. Open the **Hosting** tab and click **Advanced** (or **cPanel** / **Manage** depending on your panel).

---

## 4. Upload Files to the Web Root

Your website files must go in the **document root** for prajaktatech.com. On Bluehost this is usually:

- **`public_html`** — if prajaktatech.com is your primary domain  
- Or **`public_html/prajaktatech.com`** (or a subfolder) if you added the domain as an addon

### Option A: File Manager (recommended)

1. In cPanel, open **File Manager**.
2. Go to `public_html` (or the folder that is the document root for prajaktatech.com).
3. To start clean, you can delete or rename existing files (e.g. default `index.html`) if you want this site to be the main site.
4. **Upload**:
   - Either upload `decordreams.zip`, then right‑click it and choose **Extract**; move the extracted files so they sit directly inside `public_html` (not inside an extra folder like `decordreams`).
   - Or upload each folder and file: `index.php`, `about.php`, `products.php`, `news.php`, `contacts.php`, and the `css/`, `includes/`, and `data/` folders with their contents.

### Option B: FTP

1. In cPanel, note your **FTP** username and set a password if needed.
2. Use an FTP client (FileZilla, Cyberduck, etc.):
   - Host: your Bluehost FTP host (e.g. `ftp.prajaktatech.com` or the server name Bluehost gives you).
   - Username and password: your FTP credentials.
3. Connect and go to `public_html` (or the correct document root).
4. Upload:
   - All `.php` files in the root of the project into the root of `public_html`.
   - The `css`, `includes`, and `data` folders with all their files, keeping the same structure.

---

## 5. Final Folder Structure on Server

The structure under your document root (e.g. `public_html`) should look like:

```
public_html/
├── index.php
├── about.php
├── products.php
├── news.php
├── contacts.php
├── css/
│   └── style.css
├── includes/
│   ├── header.php
│   ├── footer.php
│   └── config.php
├── data/
│   └── contacts.txt
└── images/
    └── (hero.jpg, living-room.jpg, furniture-*.jpg, etc.)
```

Do **not** put the site inside an extra subfolder (e.g. `public_html/decordreams/`) unless you want the URL to be `prajaktatech.com/decordreams/`.

---

## 6. Set Permissions (if needed)

- **Folders**: usually `755`.
- **Files**: usually `644`.
- `data/` must be readable by the web server so PHP can read `contacts.txt`. If contacts don’t load, set `data` to `755` and `data/contacts.txt` to `644`.

In File Manager: right‑click the file/folder → **Change Permissions**.

---

## 7. Set Default Index (optional)

If visiting `prajaktatech.com` shows a different page:

- Ensure `index.php` is in the document root. Most Bluehost setups will serve `index.php` when you request the root URL.
- If your host prefers a different default, you can add or edit `.htaccess` in the document root with:

```apache
DirectoryIndex index.php index.html
```

---

## 8. Test the Site

1. Open **https://prajaktatech.com** (or **http://** if SSL isn’t set yet).
2. Check:
   - **Home**: main page and links.
   - **About**: company description.
   - **Products/Services**: products and services.
   - **News**: latest news.
   - **Contacts**: all contact info is shown and is loaded from `data/contacts.txt` (emails/phones/links clickable).

If the Contacts page is blank or errors, verify:

- `data/contacts.txt` exists and has content.
- Path in `includes/config.php`: `dirname(__DIR__) . '/data/contacts.txt'` points to that file (it does when the structure above is used).

---

## 9. Updating Contact Information Later

- Edit **`data/contacts.txt`** on the server (File Manager → edit, or re-upload the file).
- Use the same format (sections with `--- Section Name ---` and `Label: value` lines). No code change is needed; PHP reads the file each time.

---

## 10. SSL (HTTPS) on Bluehost

- In Bluehost/cPanel, look for **SSL/TLS** or **Let’s Encrypt**.
- Install a free certificate for `prajaktatech.com`.
- After SSL is active, use **https://prajaktatech.com** and consider forcing HTTPS via .htaccess:

```apache
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

---

## Quick Checklist

- [ ] All PHP and asset files uploaded to document root (e.g. `public_html`)
- [ ] `css/`, `includes/`, and `data/` folders and files in place
- [ ] `data/contacts.txt` present and readable
- [ ] Home, About, Products, News, and Contacts pages load correctly
- [ ] Contacts page shows data from the text file
- [ ] SSL enabled and tested (optional but recommended)

If you use a subdomain or a subfolder (e.g. `prajaktatech.com/decordreams`), put the same structure inside that subfolder and use that URL for testing.
