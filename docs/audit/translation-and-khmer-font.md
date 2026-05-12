# Translation & Khmer Font Audit

Audit date: 2026-05-09
Branch: `devin/1778515433-translation-khmer-audit`
Auditor: Devin (samnangtechnician + Devin pair-audit)

This document captures the findings of a full audit of the project's
translation coverage (English ↔ Khmer) and Khmer font rendering, plus
every fix applied on this branch.

---

## 1. Scope

Two dimensions were audited end-to-end:

1. **Translation coverage** — every user-facing string must be resolvable
   in both `en` and `km`. This covers:
   - Blade templates (`__('...')`, `@lang('...')`, `trans('...')`)
   - Vue components / JS plugins (`$t('...')`, `i18n.global.t('...')`)
   - Vue i18n JSON dictionaries (`lang/en.json`, `lang/km.json`)
   - Laravel framework strings (`auth`, `pagination`, `passwords`,
     `validation`)
2. **Khmer font rendering** — given any locale, all Khmer codepoints
   must render with a Khmer-capable typeface, never as Tofu boxes
   (`□□□`). This covers:
   - `@font-face` declarations and font files on disk
   - CSS cascade (Skodash theme `style.css` vs Vite `app.css`)
   - `<html lang="...">` attribute on every layout
   - `<meta charset="utf-8">` on every layout
   - First-paint behaviour (font preload)

---

## 2. Methodology

A scripted audit was run from `/tmp/audit_keys.php` and
`/tmp/audit_i18n.php`:

1. **Static usage scan** — every `__('module.key.path')` call in
   `resources/views/**/*.blade.php` is extracted via regex and looked
   up in both `lang/en/<module>.php` and `lang/km/<module>.php`.
2. **Parity scan** — every key present in `lang/en/*` is also looked
   up in `lang/km/*` (and vice versa).
3. **Heuristic untranslated detection** — every value in `lang/km/*`
   that contains only pure ASCII characters is flagged as
   "potentially untranslated".
4. **JSON parity** — `lang/en.json` keys are diffed against
   `lang/km.json` keys.
5. **CSS / HTML inspection** — `resources/css/app.css`,
   `public/assets/backend/assets/css/style.css`,
   `resources/views/admin/layouts/admin_partials/head.blade.php`,
   and `resources/views/layouts/auth.blade.php` were read by hand.
6. **Runtime smoke test** — `php artisan serve` was started locally,
   the `/login` page was fetched in both `en` and `km` locales, and
   the served HTML was grepped to confirm `<html lang="km">` and
   Khmer translation strings (`ចូល​គណនី` etc.) appear.

---

## 3. Findings — Translation Coverage (BEFORE fixes)

### 3.1 Missing translation files

| File                        | Status    | Impact                                                                 |
| --------------------------- | --------- | ---------------------------------------------------------------------- |
| `lang/en/companies.php`     | MISSING   | Every `__('companies.*')` call rendered the literal key text (e.g.     |
| `lang/km/companies.php`     | MISSING   | "companies.title") on the Companies module pages in both locales.      |
| `lang/km/pagination.php`    | MISSING   | Laravel pagination `« Previous / Next »` always rendered in English.   |
| `lang/km/passwords.php`     | MISSING   | Password-reset flash messages always rendered in English.              |
| `lang/km/validation.php`    | MISSING   | All form validation error messages always rendered in English.         |

### 3.2 Missing keys in existing files

The static usage scan revealed `__('module.key')` lookups that did not
resolve to anything in either `lang/en/<module>.php` or
`lang/km/<module>.php`. When a key has no value, Laravel renders the
literal key string (e.g. `attendance.fields.attendance_date`) to the
end user — visible to the user as raw English-with-dots text.

| File                     | Missing keys                                                                                                        |
| ------------------------ | ------------------------------------------------------------------------------------------------------------------- |
| `attendance.php`         | `fields.attendance_date`, `fields.working_hours`                                                                    |
| `payslips.php`           | `fields.payslip_no`                                                                                                 |
| `employees.php`          | `fields.full_name`, `fields.country`, `tabs.personal`, `tabs.employment`, `tabs.compensation`                       |
| `payroll_runs.php`       | `fields.payroll_no`, `fields.gross_amount`, `fields.total_deduction`, `fields.net_amount`, `fields.approved_at`     |
| `leave_types.php`        | `fields.default_entitlement_days`, `fields.country`, `fields.allow_half_day`, `fields.requires_attachment`          |
| `users.php`              | `fields.linked_employee`, `password_help`                                                                           |
| `public_holidays.php`    | `fields.is_recurring`                                                                                               |
| `shifts.php`             | `fields.shift_code`, `fields.is_night_shift`, `fields.late_grace_minutes`, `fields.early_leave_grace_minutes`       |
| `leave_requests.php`     | `fields.leave_no`, `fields.total_days`, `fields.is_half_day`, `fields.half_day_period`, `fields.approval_note`, `half.morning`, `half.afternoon` |
| `payroll_periods.php`    | `fields.period_code`, `fields.payment_date`, `fields.country`                                                       |

### 3.3 Pure-ASCII Khmer values (potentially untranslated)

| File             | Key                   | km value      | Verdict                                                          |
| ---------------- | --------------------- | ------------- | ---------------------------------------------------------------- |
| `countries.php`  | `fields.iso2`         | `ISO2`        | OK — universal ISO standard code, leave as-is                    |
| `countries.php`  | `fields.iso3`         | `ISO3`        | OK — universal ISO standard code, leave as-is                    |
| `roles.php`      | `fields.guard_name`   | `Guard`       | FIX — translated to `ប្រភេទ​សិទ្ធិ​សុវត្ថិភាព`                   |
| `validation.php` | `custom.attribute-name.rule-name` | `custom-message` | OK — Laravel scaffold placeholder, never rendered     |

### 3.4 Hard-coded English text in Blade

| File                                                              | Issue                                                                                                                                                            | Fix                                                                                                                                  |
| ----------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------ |
| `admin/layouts/admin_partials/header.blade.php`                   | Language chip showed the English word `"Khmer"` even when the active locale was Khmer (`{{ app()->getLocale() === 'km' ? 'Khmer' : 'English' }}`).               | Now shows `"ខ្មែរ"` for km and `"English"` for en. `lang="km"` annotation added so the font CSS picks the Khmer face for the chip. |
| `auth/login.blade.php`                                            | Locale toggle was rendered as `<a href="?lang=en">` / `<a href="?lang=km">`, but `SetLocale` middleware only reads session / cookie — the query string was ignored. | Replaced with POST forms to `route('locale.store')` so the click actually persists the locale. Khmer button has `lang="km"` annotation. |

### 3.5 Vue / JS strings

All Vue components (`LanguageSwitcher`, `TranslatableText`,
`DataTableContainer`) already use `$t()` from `vue-i18n`. All JS plugin
strings (`delete-confirm.js`, `datatables.js`) already have a complete
`{ en, km }` dictionary keyed off `document.documentElement.getAttribute('lang')`.
Status: **no changes required**.

### 3.6 JSON dictionary parity

`lang/en.json` and `lang/km.json` are already at full key parity.
Status: **no changes required**.

---

## 4. Findings — Khmer Font

### 4.1 Font files on disk

| File                                                            | Size  | Status   |
| --------------------------------------------------------------- | ----- | -------- |
| `public/assets/backend/assets/fonts/NotoSansKhmer.ttf`          | 359KB | Present  |
| `public/assets/backend/assets/fonts/Moul-Regular.ttf`           | 166KB | Present  |

### 4.2 CSS cascade — the actual bug

`public/assets/backend/assets/css/style.css` (the Skodash theme)
contains the following declaration on line 33:

```css
body {
    font-size: 14px;
    color: #4c5258;
    letter-spacing: .5px;
    font-family: Roboto, sans-serif;
    ...
}
```

Roboto contains **no Khmer glyphs**. Because this rule targets the
`body` element directly, descendants inherit it; the previous
`resources/css/app.css` rule only targeted the `<html>` element:

```css
html[lang="km"], [lang="km"] {
    font-family: 'Noto Sans Khmer', 'Roboto', sans-serif;
}
```

That rule sets the font on `<html lang="km">` but the body's own
`font-family: Roboto` immediately overrides the inheritance, so all
Khmer text in `<body>` rendered with whatever Khmer fallback the OS
happened to ship — on most Windows machines this is Tofu boxes.

### 4.3 HTML head configuration

| File                                                                    | `<meta charset>` | `<html lang>`                                  | Status |
| ----------------------------------------------------------------------- | ---------------- | ---------------------------------------------- | ------ |
| `resources/views/admin/layouts/admin_partials/head.blade.php`           | utf-8            | `{{ app()->getLocale() }}` (dynamic)           | OK     |
| `resources/views/layouts/auth.blade.php`                                | utf-8            | `{{ app()->getLocale() }}` (dynamic)           | OK     |

### 4.4 No font preload

Neither layout preloaded `NotoSansKhmer.ttf`. With `font-display: swap`
that meant Khmer text would first render with the fallback (Tofu) for
several frames until the font finished downloading. On a slow
connection this was very visible.

---

## 5. Fixes Applied on This Branch

### 5.1 Translation fixes

1. **Created `lang/en/companies.php` and `lang/km/companies.php`** with
   14 keys each, covering every `companies.*` lookup in the Companies
   module views (index, create, edit, _form).
2. **Created `lang/km/pagination.php`** translating `Previous` / `Next`
   to `មុន` / `បន្ទាប់`.
3. **Created `lang/km/passwords.php`** translating all 5 password
   broker messages (`reset`, `sent`, `throttled`, `token`, `user`) to
   Khmer.
4. **Created `lang/km/validation.php`** — a full Khmer translation of
   Laravel's default validation messages (≈ 110 rules including the
   nested `between`, `gt`, `gte`, `lt`, `lte`, `max`, `min`, `size`,
   and `password` groups).
5. **Added missing keys to 11 existing lang files** (`attendance`,
   `payslips`, `employees`, `payroll_runs`, `leave_types`, `users`,
   `public_holidays`, `shifts`, `leave_requests`, `payroll_periods`) in
   both `en/` and `km/`. After this change the static usage scan
   reports `All translation keys used in views exist in BOTH en and
   km.`.
6. **Fixed `roles.fields.guard_name`** from literal `"Guard"` to
   `"ប្រភេទ​សិទ្ធិ​សុវត្ថិភាព"` in km.
7. **Fixed header language chip** to show `ខ្មែរ` (native name) when
   locale is km, with `lang="km"` annotation so the Khmer font CSS
   applies to it.
8. **Fixed login-page locale toggle** to POST to `route('locale.store')`
   instead of relying on an unsupported `?lang=` query string. Khmer
   link has `lang="km"` annotation.

### 5.2 Font fixes (`resources/css/app.css`)

Replaced the previous single-rule font configuration with a complete
ruleset:

```css
:root {
    --app-font-stack:
        'Noto Sans Khmer',
        'Roboto',
        system-ui,
        -apple-system,
        'Segoe UI',
        'Helvetica Neue',
        Arial,
        sans-serif;
}

html, body, .top-header, .top-header .navbar,
.sidebar-wrapper, .sidebar-wrapper .metismenu,
.page-content, .page-wrapper, .card, .modal-content,
.dataTables_wrapper, table.dataTable,
.form-control, .form-select, .input-group-text, .btn,
.dropdown-menu, .swal2-popup, .swal2-container,
.ts-wrapper, .ts-dropdown, .flatpickr-calendar {
    font-family: var(--app-font-stack);
}

html[lang="km"], html[lang="km"] body,
[lang="km"], [lang="km"] * {
    font-family: var(--app-font-stack) !important;
}
```

Key points:

- Noto Sans Khmer is now the **first font in the global stack**, even
  on English locale. Browsers do per-glyph font matching — Latin code
  points fall through to Roboto / system, Khmer code points render with
  Noto Sans Khmer. This means **Khmer employee names entered on an
  English UI page also render correctly**, not just the translated
  strings.
- The `[lang="km"] *` rule with `!important` ensures any third-party
  stylesheet that hard-codes a Latin-only font on a child element is
  still overridden when the document locale is Khmer.

Also added a second `@font-face` declaration for `Moul-Regular.ttf`
exposed via the `.khmer-display` class so decorative Khmer headings can
opt in to that face.

### 5.3 Font preload (head.blade.php, auth.blade.php)

```html
<link rel="preload"
      href="{{ asset('assets/backend/assets/fonts/NotoSansKhmer.ttf') }}"
      as="font" type="font/ttf" crossorigin>
```

Both the admin layout and the login layout now preload Noto Sans Khmer
so the very first paint has the font available — no Tofu flash.

---

## 6. Verification

After the fixes:

- `php /tmp/audit_keys.php` reports
  `"All translation keys used in views exist in BOTH en and km."`.
- `php /tmp/audit_i18n.php` reports only the three intentional
  ASCII-only values (`countries.iso2`, `countries.iso3`,
  `validation.custom.attribute-name.rule-name`).
- `vendor/bin/pint --test` → passed.
- `npm run build` → built successfully; compiled CSS contains
  `--app-font-stack: "Noto Sans Khmer", "Roboto", ...`.
- `php artisan serve` + `curl /login` → `<html lang="en">` initially;
  after `POST /locale (locale=km)`, the next GET `/login` returns
  `<html lang="km">` and renders the Khmer translation
  (`ចូល​គណនី​របស់​អ្នក`).
- `<link rel="preload" ... NotoSansKhmer.ttf ...>` is emitted in
  every page's `<head>`.

---

## 7. Translation coverage summary (after)

| Surface                          | Coverage   |
| -------------------------------- | ---------- |
| Blade views (`__()`)             | 100 % EN / 100 % KM (parity verified by script) |
| Vue components (`$t()`)          | 100 % EN / 100 % KM (JSON parity already in place) |
| JS plugins (delete-confirm, DataTables) | 100 % EN / 100 % KM (inline dictionaries) |
| Laravel framework lang files     | 100 % EN / 100 % KM (auth, pagination, passwords, validation) |
| Per-module lang files            | 19 EN files, 19 KM files (all paired) |

The only remaining English text in Khmer locale is intentional:

- Language endonyms (e.g. `English` in the locale picker, `ខ្មែរ` in
  the chip)
- ISO country codes (`ISO2`, `ISO3`)
- Currency codes (`USD`, `KHR`, `EUR`, …) — the symbols are localised
  (`$`, `៛`, `€`), but the 3-letter ISO 4217 code is the same in every
  language.
- Database-stored data the user entered themselves (employee codes,
  branch addresses, etc.). These should be entered in the user's
  preferred script; the system is multilingual but not auto-translating.

---

## 8. Recommendations for the future

1. **Add an automated CI check** that runs the audit script in a
   GitHub Action so missing keys are caught on every PR. Two `php`
   scripts (`audit_keys.php`, `audit_i18n.php`) exist in `/tmp/` on
   the audit branch — these can be committed to `tools/audit/` and
   wired into CI.
2. **Consider switching from local TTF to a self-hosted WOFF2 of Noto
   Sans Khmer** — WOFF2 is ≈ 40 % smaller than TTF and is the recommended
   web font format.
3. **Lazy-load Moul** — `Moul-Regular.ttf` is 166 KB but is only used by
   the optional `.khmer-display` decorative class. It is already
   `font-display: swap` so the cost is moderate, but if it is not used
   anywhere yet, removing the second `@font-face` declaration would
   save 166 KB on first paint.
4. **Translate currency symbols/codes if locale-specific formats are
   required** — e.g. Khmer Riel `៛` is already present; consider
   formatting numbers with the Khmer numeral set (`០១២៣៤៥៦៧៨៩`) when
   locale is km for a fully localised feel.
