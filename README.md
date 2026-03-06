# PHP Project Setup Guide (XAMPP)

This guide explains how to run the PHP project using **XAMPP**.

---

## 1. Install XAMPP

Download XAMPP from the official website:

https://www.apachefriends.org

Run the installer and follow the default installation steps.

---

## 2. Start Apache Server

Open **XAMPP Control Panel** and start the Apache server.

Click:

Start → **Apache**

If Apache starts successfully, the status indicator will turn **green**.

---

## 3. Place Project in `htdocs`

All web project files must be placed inside the **htdocs** directory.

Default location:

```
C:\xampp\htdocs
```

Put project folder inside `htdocs`.

Example:

```
C:\xampp\htdocs\test\
```

Your project structure may look like:

```
htdocs
 └── test
      └── Solution.php
```


## 4. Run the Project in Browser

Open your browser and go to:

```
http://localhost/product-test/index.php
```

If the page displays:

```
PHP is running with XAMPP!
```

Then the PHP environment is running successfully.

---

## Notes

* Ensure **Apache is running** before accessing the project.
* All PHP files must be located inside the **htdocs** folder.
* If the page does not load, verify that **Apache is active in XAMPP Control Panel**.
