# 🧱 BASIC THEME STRUCTURE (Hello World)

## Directory Structure

```
test-theme/
│
├── style.css          (theme info + optional global styles)
├── index.php          (main page)
├── header.php         (top of site)
├── footer.php         (bottom of site)
│
├── css/
│   └── style.css      (your actual styling)
│
├── js/
│   └── script.js      (your JavaScript)
│
├── images/            (all images go here)
│
└── THEME_STRUCTURE_GUIDE.md  (this file!)
```

---

## 📄 WHAT GOES IN EACH FILE

### ✅ 1. style.css (REQUIRED for WordPress)

This makes WordPress recognize your theme. Located at ROOT of theme folder.

```css
/*
Theme Name: Test Theme
Theme URI: http://example.com
Description: A basic WordPress theme
Version: 1.0
Author: Your Name
License: GPL v2 or later
*/
```

### ✅ 2. header.php (top part of site)

Loaded via `<?php get_header(); ?>`

```php
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo( 'name' ); ?></title>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header>
        <h1><?php bloginfo( 'name' ); ?></h1>
        <p><?php bloginfo( 'description' ); ?></p>
    </header>
```

### ✅ 3. footer.php (bottom part)

Loaded via `<?php get_footer(); ?>`

```php
    <footer>
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?></p>
    </footer>
    <script src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>
    <?php wp_footer(); ?>
</body>
</html>
```

### ✅ 4. index.php (main content)

The main template file. This loads header and footer automatically.

```php
<?php get_header(); ?>

<main>
    <h1>Hello World</h1>
    <p>This is my WordPress site</p>
</main>

<?php get_footer(); ?>
```

### ✅ 5. css/style.css (your design)

This is where you add ALL your styling.

```css
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background: black;
    color: white;
    text-align: center;
    font-family: Arial, sans-serif;
}

header {
    padding: 20px;
    background: #222;
    border-bottom: 2px solid #444;
}

main {
    padding: 40px 20px;
}

footer {
    padding: 20px;
    background: #222;
    border-top: 2px solid #444;
    margin-top: 40px;
}
```

### ✅ 6. js/script.js (optional)

Add interactivity here.

```javascript
console.log("Script loaded!");

// Example: Button click handler
document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM is ready");
});
```

---

## 🧠 HOW EVERYTHING CONNECTS

```
index.php (main page)
    ↓
get_header() → loads header.php
    ↓
Display content from index.php
    ↓
get_footer() → loads footer.php
    ↓
CSS (css/style.css) styles everything
JS (js/script.js) adds behavior
```

**Flow:**
1. WordPress loads `index.php`
2. `get_header()` pulls in `header.php` (opens `<html>`, `<head>`, `<body>`)
3. Main content displays
4. `get_footer()` pulls in `footer.php` (closes `</body>`, `</html>`)
5. CSS styles everything
6. JS adds interactions

---

## ✏️ WHERE TO MAKE CHANGES (SUPER IMPORTANT)

### 🎨 Change design (colors, layout)

**👉 Edit:** `css/style.css`

Example: Change background color

```css
body {
    background: blue;  /* was: black */
}
```

### 🧱 Change content (text, structure)

**👉 Edit:** `index.php`

Example: Change the heading

```php
<h1>My New Title</h1>
```

### 🔝 Change top of site (logo, nav, meta)

**👉 Edit:** `header.php`

Example: Add a navigation menu

```php
<nav>
    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/about">About</a></li>
    </ul>
</nav>
```

### 🔻 Change bottom (scripts, footer text)

**👉 Edit:** `footer.php`

Example: Add copyright or additional scripts

```php
<footer>
    <p>&copy; 2024 My Site. All rights reserved.</p>
</footer>
```

### ⚙️ Add interactivity (buttons, clicks)

**👉 Edit:** `js/script.js`

Example: Button click handler

```javascript
document.addEventListener('DOMContentLoaded', function() {
    const button = document.querySelector('button');
    button.addEventListener('click', function() {
        alert('Button clicked!');
    });
});
```

### 🖼️ Add images

**👉 Put images in:** `images/`

**Use in HTML:**

```php
<img src="<?php echo get_template_directory_uri(); ?>/images/myimage.jpg" alt="My Image">
```

---

## 🔄 YOUR WORKFLOW

### Step 1: Edit
- Open Visual Studio Code
- Navigate to your test-theme folder
- Edit any file (header.php, css/style.css, js/script.js, etc.)
- Save the file (Ctrl+S)

### Step 2: Preview
- Go to your local WordPress site:
  ```
  http://first-test.local
  ```
  (or whatever your local domain is)

### Step 3: Refresh Browser
- Refresh the page (F5 or Ctrl+R)
- See your changes instantly!

### Step 4: Repeat
- Make more edits
- Save
- Refresh browser
- See updates

---

## ⚡ QUICK REFERENCE

| Need | File | Action |
|------|------|--------|
| Change colors/fonts | `css/style.css` | Edit CSS rules |
| Change page text | `index.php` | Edit HTML content |
| Add header/logo | `header.php` | Add HTML/PHP |
| Add footer/scripts | `footer.php` | Add HTML/PHP |
| Add interactivity | `js/script.js` | Add JavaScript |
| Add images | `images/` | Put images here, link in HTML |

---

## 🚀 COMMON TASKS

### Task 1: Change the page background color to blue

1. Open `css/style.css`
2. Find: `background: black;`
3. Change to: `background: blue;`
4. Save
5. Refresh browser

### Task 2: Add a new heading to the page

1. Open `index.php`
2. Add: `<h2>My New Section</h2>`
3. Save
4. Refresh browser

### Task 3: Add a button that does something

1. In `index.php`, add:
   ```php
   <button id="myButton">Click Me</button>
   ```

2. In `js/script.js`, add:
   ```javascript
   document.getElementById('myButton').addEventListener('click', function() {
       alert('You clicked the button!');
   });
   ```

3. Save both files
4. Refresh browser

---

## 📚 WordPress Functions Used

### In header.php / footer.php:
- `wp_head()` - WordPress header hook
- `wp_footer()` - WordPress footer hook
- `bloginfo()` - Get site info (name, description, charset)
- `language_attributes()` - HTML language attribute
- `body_class()` - Add CSS classes to body tag
- `get_template_directory_uri()` - Get theme folder URL

### In index.php / other templates:
- `get_header()` - Load header.php
- `get_footer()` - Load footer.php

These functions make WordPress handle everything properly!

---

## 💡 TIPS

- **Always save files** after editing (Ctrl+S)
- **Always refresh browser** to see changes
- **Use browser DevTools** (F12) to debug CSS/JS
- **Check WordPress errors** - if something breaks, check the WordPress admin panel
- **Keep it simple** - start basic, add complexity later
- **Comment your code** - add notes to remember what you did

---

## 📝 FILE CHECKLIST

Before you start, make sure you have:

- [ ] `style.css` - Theme info
- [ ] `index.php` - Main page
- [ ] `header.php` - Top part
- [ ] `footer.php` - Bottom part
- [ ] `css/` folder with `style.css`
- [ ] `js/` folder with `script.js`
- [ ] `images/` folder (empty)

That's it! You're ready to build! 🚀
