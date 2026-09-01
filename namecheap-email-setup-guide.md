# Namecheap Domain, Hosting & Secure Email Setup Guide

This guide walks you through setting up your domain, hosting, and business email on **Namecheap** for **SOLOMART CONSTRUCTION LIMITED**.

---

## Step 1: Purchasing Domain & Hosting on Namecheap

1. Go to [Namecheap.com](https://www.namecheap.com/).
2. **Domain Registration**:
   - Search for your preferred domain (e.g. `solomartconstruction.com` or `solomartconstructiongh.com`).
   - Add to cart.
3. **Web Hosting**:
   - Choose **Shared Hosting** (e.g. *Stellar* or *Stellar Plus* plan).
   - Link it to your registered domain during checkout.
4. Complete payment and access your **Namecheap Dashboard**.

---

## Step 2: Creating Your Business Email Account in cPanel

1. From your Namecheap Dashboard, click **Go to cPanel** next to your hosting plan.
2. In cPanel, navigate to **Email** > **Email Accounts**.
3. Click **+ CREATE**.
4. Set:
   - **Username**: `info` (creating `info@solomartconstruction.com`)
   - **Password**: Set a strong password (keep this secure!).
   - **Storage Space**: Choose Unlimited or 5 GB+.
5. Click **Create**.

---

## Step 3: Configuring Webmail & Forwarding (Optional)

1. You can access your emails anytime by visiting:
   `https://solomartconstruction.com/webmail`
   or via Namecheap cPanel Webmail (Roundcube).
2. To forward incoming emails to your personal Gmail/Outlook:
   - Go to cPanel > **Email** > **Forwarders**.
   - Click **Add Forwarder**, enter `info`, and forward to your personal email address.

---

## Step 4: Uploading Website Files to Namecheap Hosting

1. In cPanel, open **File Manager**.
2. Navigate into the `public_html` directory.
3. Upload all files and folders from this project (`index.html`, `about.html`, `services.html`, `contact.html`, `form-process.php`, `css/`, `js/`, `images/`, etc.).
4. Ensure `index.html` is in the root of `public_html`.

---

## Step 5: How Contact Forms Work

- The contact forms submit directly to `form-process.php`.
- `form-process.php` is pre-configured with:
  - **Recipient**: `info@solomartconstruction.com`
  - **Honeypot Anti-Spam protection**
  - **Input Sanitization & Header Injection Prevention**
- Once uploaded to Namecheap cPanel, PHP's built-in mail server will automatically route incoming contact inquiries directly to your inbox.
