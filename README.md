# 🛒 Deal Kart — Mobile Shopping Platform

![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=flat&logo=bootstrap&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=flat&logo=javascript&logoColor=black)

A full-stack e-commerce web application for mobile phone shopping, built with PHP and MySQL. Features user authentication, product browsing, shopping cart, and payment processing — with an integrated IBM Watson chatbot for customer support.

## ✨ Features

- 🔐 **User Authentication** — Sign up & sign in with session management
- 📱 **Product Catalog** — Browse phones with special prices, new arrivals, and top sales
- 🛍️ **Shopping Cart** — Add/remove items with real-time cart count
- 💳 **Payment Processing** — Checkout flow with order confirmation
- 🤖 **Watson Chatbot** — Integrated IBM Watson Assistant for customer support
- 🎠 **Responsive UI** — Owl Carousel banners, Font Awesome icons, Bootstrap layout

## 🛠️ Tech Stack

| Layer | Technology |
|-------|-----------|
| **Backend** | PHP, MySQL |
| **Frontend** | HTML, CSS, JavaScript, Bootstrap 4 |
| **Libraries** | Owl Carousel, Font Awesome, jQuery |
| **Chatbot** | IBM Watson Assistant |
| **Database** | MySQL (schema in `shopee.sql`) |

## 📁 Project Structure

```
├── index.php            # Home page
├── header.php           # Navigation & session handling
├── footer.php           # Footer & scripts
├── cart.php             # Shopping cart page
├── payment.php          # Payment/checkout page
├── signin.php           # Sign in page
├── signup.php           # Sign up page
├── signinphp.php        # Sign in backend logic
├── signupphp.php        # Sign up backend logic
├── dbh.php              # Database connection
├── shopee.sql           # Database schema
├── index.js             # Frontend JavaScript
├── style.css            # Main styles
├── signup-style.css     # Auth page styles
├── template/            # Page section templates
│   ├── banner-area.php
│   ├── special-price.php
│   ├── new-phones.php
│   ├── top-sale.php
│   ├── _cart-template.php
│   └── _products.php
└── assets/              # Images & media
```

## 🚀 Getting Started

### Prerequisites

- PHP 7.x+
- MySQL
- Apache/Nginx (or XAMPP/WAMP)

### Setup

1. Clone the repository
   ```bash
   git clone https://github.com/Sanjays2402/Deal-Cart-Mobile-shopping-platform.git
   ```
2. Import `shopee.sql` into your MySQL database
3. Update database credentials in `dbh.php`
4. Start your local server and navigate to `index.php`

## 👤 Author

**Sanjay Santhanam**

---

⭐ Star this repo if you found it useful!

## Terms & Disclaimer

By using this project you agree to the following.

- **No warranty.** This software is provided "as is", without warranty of any kind, express or implied, including merchantability, fitness for a particular purpose, and non-infringement.
- **No liability.** To the maximum extent permitted by law, the author and contributors are not liable for any claim, loss, or damage (direct, indirect, incidental, or consequential, including lost data or profits) arising from its use.
- **Your responsibility.** You use it at your own risk and are responsible for complying with the laws that apply to you.
- **Demo only.** Prices and deals shown are sample data, not real offers. Store and brand names are trademarks of their owners.
- **Third parties.** Names, logos, APIs, and services of others belong to their owners and are used for identification only; no affiliation or endorsement is implied.
- **Your statutory rights.** Nothing here limits rights that cannot be waived by agreement, including under consumer-protection laws in the USA, Canada (including Quebec), and India (Consumer Protection Act, 2019).
- **License.** Use, copying, and distribution are governed by the [LICENSE](LICENSE) file; if anything here conflicts with it, the license controls.
