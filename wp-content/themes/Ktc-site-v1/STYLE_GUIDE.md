# KTC – Kuruman Tuition Centre · Site Style Guide

> **Version 1.1 · March 2026**  
> This document defines the visual language and design principles of the KTC website.  
> It must be consulted before any new page, component, or style change is made.

---

## 1 · Design Philosophy

The site blends **two complementary identities**:

| Layer | Character |
|---|---|
| **Personality** | Fun, warm, and child-friendly. Rounded headings, gold accents, school-themed illustrations. Approachable but never childish. |
| **Refinement** | Apple-inspired: clean, spacious, premium dark mode. Every element intentional. No clutter. Generous whitespace. |

The result is a school site that feels **trustworthy and sophisticated to parents** while remaining **exciting and welcoming to children**.

---

## 2 · Color Palette

### Backgrounds (Dark Scale — never pure black)
| Token | Hex | Usage |
|---|---|---|
| `--bg-base` | `#111113` | Page base background |
| `--bg-raised` | `#1C1C1F` | Header, footer, about section |
| `--bg-elevated` | `#242428` | Cards, grid items |
| `--bg-overlay` | `#2C2C31` | Hover states, logo wrap |
| `--bg-glass` | `rgba(28,28,31,0.72)` | Sticky header, mobile nav, coming-soon box |

### Gold Palette (Primary Brand Accent)
| Token | Hex | Usage |
|---|---|---|
| `--gold` | `#FFB830` | Main CTA buttons, headings, dividers |
| `--gold-light` | `#FFD166` | Hover states, quote text |
| `--gold-dark` | `#C98A00` | Gradient low end, active states |
| `--gold-glow` | `rgba(255,184,48,0.30)` | Button glow, logo shadows |
| `--gold-glow-sm` | `rgba(255,184,48,0.15)` | Subtle card borders |

### Text
| Token | Hex | Usage |
|---|---|---|
| `--white` | `#F5F5F7` | Primary headings, max contrast |
| `--off-white` | `#E8E8ED` | Body copy, card text |
| `--text-secondary` | `#9898A4` | Subtitles, card descriptions, nav links |
| `--text-muted` | `#6E6E7A` | Helper text, copyright, footer taglines |

> ⚠️ **Never use pure `#FFFFFF` or pure `#000000`.** Pure white causes eye strain in dark mode; pure black loses depth.

---

## 3 · Typography

### Heading Font — Fredoka One
Used for all `h1`–`h4`, nav items are the only exception.  
Gives the site its friendly, rounded, school personality.

```css
font-family: 'Fredoka One', 'Arial Rounded MT Bold', Arial, cursive;
```

### Body Font — Apple System Stack
Used for all body text, nav links, badges, and buttons.  
Crisp, readable, and renders perfectly on every device at no cost.

```css
font-family: -apple-system, BlinkMacSystemFont, "SF Pro Text", "Segoe UI",
             Roboto, Helvetica, Arial, sans-serif;
```

### Scale
| Element | Size | Weight | Color |
|---|---|---|---|
| Hero title | `clamp(2.4rem, 5.5vw, 4rem)` | Fredoka One | `--white` + `--gold` span |
| Section h2 | `clamp(1.9rem, 3.5vw, 2.7rem)` | Fredoka One | `--gold` |
| Card h3 | `1.15rem` | Fredoka One | `--gold` |
| Body | `16px` / `1.7` line-height | 400 | `--off-white` |
| Secondary | `0.88rem` | 400 | `--text-secondary` |
| Labels/tags | `0.78rem` uppercased, `1.4px` spacing | 600 | `--text-muted` |

---

## 4 · Spacing & Layout

- Maximum content width: **1200px** (sections) / **1100px** (grids)
- Section padding: **88px top/bottom, 32px left/right** (desktop)
- Section padding mobile: **68px top/bottom, 20px left/right**
- Gap between grid items: **20px**
- Use generous whitespace — when in doubt, add more space, not less.

### Grid System
```
Desktop  (>900px):  3-col gallery | 4-col values | 2-col about
Tablet   (≤900px):  2-col gallery | 2-col values | 1-col about
Mobile   (≤540px):  1-col everything
```

---

## 5 · Border Radius

| Token | Value | Usage |
|---|---|---|
| `--radius` | `18px` | Cards, placeholders, image frames |
| `--radius-sm` | `10px` | Small elements, mobile nav links |
| `--radius-pill` | `100px` | Buttons, tags, nav pills |
| Coming-soon box | `28px` | Larger, more prominent |

Rounded corners reinforce the friendly, approachable feel. Never use sharp 0px corners on interactive elements.

---

## 6 · Shadows & Depth

Apple dark mode uses **soft glows** — not hard drop shadows.

```css
/* Card resting */
box-shadow: 0 2px 16px rgba(0,0,0,.30);

/* Card hover */
box-shadow: 0 20px 48px rgba(0,0,0,.40), 0 0 0 1px rgba(255,184,48,.10);

/* Button glow */
box-shadow: 0 0 0 6px rgba(255,184,48,.12), 0 12px 36px rgba(255,184,48,.45);

/* Glass surface */
box-shadow: 0 2px 0 rgba(255,255,255,.04) inset, 0 32px 64px rgba(0,0,0,.55);
```

> ⚠️ **Never use `box-shadow: 0 4px 8px rgba(0,0,0,0.8)`. Heavy black shadows look dated and break the premium feel.**

---

## 7 · Glass / Frosted Surfaces

The sticky header, mobile nav dropdown, and coming-soon boxes use a glass effect:

```css
background: rgba(28, 28, 31, 0.72);
backdrop-filter: blur(20px) saturate(180%);
-webkit-backdrop-filter: blur(20px) saturate(180%);
border: 1px solid rgba(255, 184, 48, 0.18);
```

Use glass sparingly — only for floating/overlay surfaces, not for in-page cards.

---

## 8 · Transitions & Animation

### Easing Curves
| Token | Value | Use case |
|---|---|---|
| `--ease` | `cubic-bezier(0.25, 0.46, 0.45, 0.94)` | All standard transitions |
| `--ease-spring` | `cubic-bezier(0.34, 1.56, 0.64, 1)` | Button hover, card lift (slight overshoot = alive feel) |

### Duration Scale
| Token | Value | Use case |
|---|---|---|
| `--t-fast` | `0.2s` | Color changes, opacity |
| `--t-base` | `0.35s` | Transforms, shadows |
| `--t-slow` | `0.6s` | Scroll reveals, page-level fades |

### Scroll Reveal
All major sections use `.reveal` / `.is-visible` classes driven by `IntersectionObserver`.  
Elements start at `opacity: 0; transform: translateY(28px)` and ease in when they scroll into view.

Staggered with delay classes:
```
.reveal-delay-1 → 0.1s
.reveal-delay-2 → 0.2s
.reveal-delay-3 → 0.3s
.reveal-delay-4 → 0.4s
```

**Always** wrap new sections/cards with `.reveal` (and optionally a delay class).

### Reduced Motion
All custom animations (scroll reveal, heroFloat, bg shapes) are fully disabled via:
```css
@media (prefers-reduced-motion: reduce) { ... }
```

---

## 9 · Animated Background Shapes

Subtle school-related emoji icons float in the background of each section.  
They are purely decorative (`aria-hidden="true"`) and must not interfere with content.

Rules:
- Opacity: **0.18 desktop / 0.11 mobile**
- Add `.hide-mobile` to any shape above 4 per section on mobile
- Use different `animation-duration` values (9s–18s) and negative `animation-delay` per shape so they never look synchronised
- Available animation classes: `.bfa` `.bfb` (float), `.bda` `.bdb` (drift), `.bsw` (sway), `.bpu` (pulse)
- Place inside `<div class="bg-shapes" aria-hidden="true">` at the top of the section

---

## 10 · Buttons

### Primary CTA
```css
background: var(--gold);
color: #0B0B0C;           /* near-black — never pure white text on gold */
font-weight: 700;
border-radius: var(--radius-pill);
padding: 15px 42px;
```

Hover: `scale(1.04) translateY(-3px)` + gold glow ring.

### Secondary (Back to Home, etc.)
Same styles, slightly smaller padding `13px 36px`.

> ⚠️ **Never use `Fredoka One` on body-size buttons** — it reduces legibility at small sizes. Use the system font stack with `font-weight: 700`.

---

## 11 · Logo Usage

| File | Usage |
|---|---|
| `images/logo-full.png` | Header (58px), Hero (175px), Footer (90px), Coming-soon (110px) |
| `images/logo-black.png` | About section column — CSS `filter: invert(1)` makes it appear white on dark bg |

Always use `drop-shadow(...)` not `box-shadow` on logos (transparent PNG edges).

---

## 12 · Do's and Don'ts

| ✅ Do | ❌ Don't |
|---|---|
| Add generous padding and whitespace | Cram elements together |
| Use soft glows for depth | Use harsh black shadows |
| Use `--text-secondary` for descriptions | Use pure `#FFFFFF` for all text |
| Keep borders at 1px, subtle opacity | Use thick `3px` solid borders on large surfaces |
| Animate with spring easing | Use `linear` or abrupt transitions |
| Wrap new content in `.reveal` | Add visible elements without scroll reveal |
| Use `--bg-glass` for floating surfaces | Apply `backdrop-filter` to in-page cards |
| Keep background shapes subtle (opacity < 0.2) | Make decorative elements compete with content |
