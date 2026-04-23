# Laravel 13 Upgrade Implementation Plan

> **For Claude:** REQUIRED SUB-SKILL: Use superpowers:executing-plans to implement this plan task-by-task.

**Goal:** Upgrade this portfolio project from Laravel 11 to Laravel 13 (plus all composer deps), keep the Pest smoke tests green, and install `laravel/boost` to prep for Claude Code-driven work.

**Architecture:** Single feature branch (`upgrade/laravel-13`). Direct jump, no incremental per-major stops. Commit per logical checkpoint so any bad step is cheap to revert. Tests are the acceptance gate — the suite must be green before each commit after the initial bump.

**Tech Stack:** PHP 8.4 (Herd), Composer 2.9, Laravel 11→13, Livewire 3→4, Volt 1.6→1.10, Pest 2→4, SQLite.

**Design doc:** `docs/plans/2026-04-22-laravel-13-upgrade-design.md`

---

### Task 1: Pre-flight — branch, commit dirty file, verify baseline green

**Files:**
- Modify: `resources/views/components/header.blade.php` (currently dirty)

**Step 1: Inspect the dirty working-tree change**

Run: `git diff resources/views/components/header.blade.php`
Expected: a small content/markup diff. Decide: keep or revert.

**Step 2: Commit or revert based on Step 1**

If keeping:
```bash
git add resources/views/components/header.blade.php
git commit -m "Minor header tweaks before Laravel 13 upgrade"
```
If reverting: `git checkout resources/views/components/header.blade.php`

**Step 3: Create and switch to upgrade branch**

```bash
git checkout -b upgrade/laravel-13
```

**Step 4: Verify baseline test suite is green on Laravel 11**

Run: `./vendor/bin/pest`
Expected: all tests pass. If any fail, STOP and fix them on `master` first — we need a green baseline to detect upgrade regressions.

**Step 5: Confirm dev server still boots (sanity)**

Run: `php artisan --version`
Expected: `Laravel Framework 11.x.x`. No errors.

---

### Task 2: Bump composer.json constraints in one pass

**Files:**
- Modify: `composer.json`

**Step 1: Edit `require` block**

Change to:
```json
"require": {
    "php": "^8.2",
    "laravel/framework": "^13.0",
    "laravel/tinker": "^2.10",
    "livewire/livewire": "^4.0",
    "livewire/volt": "^1.10",
    "symfony/yaml": "^7.4"
},
```

**Step 2: Edit `require-dev` block**

Change to:
```json
"require-dev": {
    "fakerphp/faker": "^1.23",
    "laravel/pint": "^1.13",
    "laravel/sail": "^1.26",
    "mockery/mockery": "^1.6",
    "nunomaduro/collision": "^8.9",
    "pestphp/pest": "^4.0",
    "pestphp/pest-plugin-laravel": "^4.0",
    "spatie/laravel-ignition": "^2.4"
},
```

**Step 3: Do NOT commit yet** — wait until `composer update` resolves cleanly.

---

### Task 3: Run composer update and resolve conflicts

**Step 1: Run the upgrade**

Run: `composer update -W 2>&1 | tee /tmp/composer-upgrade.log`
Expected: resolver either finds versions or errors with a constraint conflict.

**Step 2: If resolver errors, read the error and narrow constraint**

The typical pattern: one package requires an older version of another. Identify the blocker, loosen or tighten accordingly, re-run. Common culprits on Laravel upgrades: `pestphp/pest-plugin-laravel` tracking Pest version, or a transitive dep on `symfony/*`.

**Step 3: Confirm Laravel 13 landed**

Run: `php artisan --version`
Expected: `Laravel Framework 13.x.x`

**Step 4: Commit the lockfile bump**

```bash
git add composer.json composer.lock
git commit -m "Bump composer dependencies for Laravel 13 upgrade"
```

---

### Task 4: Audit bootstrap/app.php for Laravel 13 changes

**Files:**
- Modify: `bootstrap/app.php` (if Laravel 12/13 shipped config diffs)

**Step 1: Compare current file against a fresh Laravel 13 skeleton**

Run:
```bash
curl -s https://raw.githubusercontent.com/laravel/laravel/13.x/bootstrap/app.php > /tmp/app.13.php
diff bootstrap/app.php /tmp/app.13.php
```
Expected: either no diff (current file already matches) or small additions (e.g., new `->withSchedule()` block).

**Step 2: Apply any additive changes from the diff**

Only add what the skeleton has and ours doesn't. Do NOT remove existing closures (`withMiddleware`, `withExceptions`) even if empty — they're valid anchor points.

**Step 3: Smoke test the boot**

Run: `php artisan route:list | head -20`
Expected: routes list without errors.

---

### Task 5: Audit config/ for new Laravel 13 keys

**Step 1: List our config files**

Run: `ls config/`

**Step 2: For each config file, diff against Laravel 13 skeleton**

Run for each file (example: `app.php`):
```bash
curl -s https://raw.githubusercontent.com/laravel/laravel/13.x/config/app.php > /tmp/app.config.13.php
diff config/app.php /tmp/app.config.13.php
```

**Step 3: Apply additive changes only**

Same rule as Task 4 — add new keys Laravel 13 introduced, leave our customizations alone. If a key was *renamed*, follow the rename.

**Step 4: Commit framework-fix changes**

```bash
git add bootstrap/app.php config/
git commit -m "Apply Laravel 13 skeleton changes to bootstrap/config"
```

---

### Task 6: Audit Volt/Livewire components for Livewire 4 breaking changes

**Files to inspect:**
- `resources/views/livewire/home.blade.php`
- `resources/views/livewire/posts/index.blade.php`
- `resources/views/livewire/posts/show.blade.php`

**Step 1: Check Livewire 4 upgrade guide**

Run: `curl -s https://livewire.laravel.com/docs/upgrading | head -200`
Or: WebFetch the Livewire 4 upgrade guide.
Note: look for renamed directives, lifecycle hook changes, removed properties.

**Step 2: Grep the codebase for known Livewire 3 → 4 breakage patterns**

Run: `grep -rn "wire:model.defer\|wire:model.lazy\|\$this->emit\|\$this->emitUp\|\$this->emitTo" resources/ app/ 2>/dev/null`
Expected: either no matches (clean) or a list of call sites to update.

**Step 3: Apply fixes per grep results and upgrade guide**

Edit each flagged file. Common replacements:
- `$this->emit(...)` → `$this->dispatch(...)` (already changed in Livewire 3, but confirm)
- `wire:model.defer` → `wire:model` (default is now deferred)
- `wire:model.lazy` → `wire:model.blur`

**Step 4: Commit Livewire fixes (even if empty — skip if no changes)**

```bash
git add resources/ app/
git commit -m "Update Livewire syntax for v4 compatibility" || echo "no livewire changes needed"
```

---

### Task 7: Audit Pest 2 → 4 breaking changes

**Files:**
- `tests/Pest.php`
- `tests/Feature/SmokeTest.php`
- `tests/Feature/ExampleTest.php`

**Step 1: Check Pest 4 release notes**

WebFetch: `https://pestphp.com/docs/upgrade-guide`
Note known breaks: stricter `expect()` typing, arch test changes, `beforeEach`/`afterEach` signatures.

**Step 2: Inspect each test file for outdated patterns**

Run: `cat tests/Pest.php tests/Feature/ExampleTest.php`
Expected: small files. Look for anything flagged in the upgrade guide.

**Step 3: Run the suite and observe failures**

Run: `./vendor/bin/pest 2>&1 | tee /tmp/pest-run.log`
Expected outcomes:
- All green → skip to Task 8.
- Failures → read them one at a time, fix the minimum in the test to pass, do NOT relax assertions to make failures go away.

**Step 4: Iterate until green**

Re-run `./vendor/bin/pest` after each fix. If a failure points at app code (not the test itself), that's a real framework regression — trace to the relevant Laravel/Livewire change and fix the app code.

**Step 5: Commit test fixes**

```bash
git add tests/
git commit -m "Update tests for Pest 4 compatibility" || echo "no test changes needed"
```

---

### Task 8: Run pint and commit style drift

**Step 1: Run formatter**

Run: `./vendor/bin/pint`
Expected: either no changes or a list of reformatted files.

**Step 2: Commit if there are changes**

```bash
git add -A
git commit -m "Pint formatting after Laravel 13 upgrade" || echo "nothing to format"
```

---

### Task 9: Manual browser smoke test

**Step 1: Start dev server and vite in parallel**

In one terminal: `php artisan serve`
In another: `npm run dev`

**Step 2: Hit each route and eyeball**

- `http://127.0.0.1:8000/` — home page renders
- `http://127.0.0.1:8000/posts` — blog index renders with post list
- Click into at least one post — content renders
- `http://127.0.0.1:8000/posts/does-not-exist` — 404 page renders

**Step 3: Open browser devtools, check console + network**

Expected: no 500s, no Livewire JS errors, no Vite HMR errors.

**Step 4: Stop servers, report findings**

If anything broke visually that tests don't cover, go back to the relevant task and fix.

---

### Task 10: Install laravel/boost

**Step 1: Install**

Run: `composer require laravel/boost --dev`
Expected: package installed with no conflicts.

**Step 2: Run Boost's installer**

Run: `php artisan boost:install`
Expected: Boost scaffolds whatever it needs (guidelines, MCP server config, etc.). Follow any interactive prompts.

**Step 3: Verify**

Run: `php artisan list | grep boost`
Expected: Boost's artisan commands are listed.

**Step 4: Run the full test suite one more time**

Run: `./vendor/bin/pest`
Expected: still green.

**Step 5: Commit**

```bash
git add -A
git commit -m "Install laravel/boost for Claude Code integration"
```

---

### Task 11: Final verification and handoff

**Step 1: Confirm versions**

Run:
```bash
php artisan --version
composer show laravel/framework livewire/livewire livewire/volt pestphp/pest laravel/boost | grep "^versions\|^name" 
```
Expected: Laravel 13.x, Livewire 4.x, Volt 1.10.x, Pest 4.x, Boost installed.

**Step 2: Full test run**

Run: `./vendor/bin/pest --ci`
Expected: all green.

**Step 3: Clean git status**

Run: `git status`
Expected: clean working tree.

**Step 4: Report**

Summarize what landed in which commits. User can then `git merge` to master or open a PR.

---

## Stop / Escalate Conditions

- **Livewire 4 incompatible with Volt 1.10** → stop, relax `livewire/livewire` to `^3.6` and flag for later.
- **Pest 4 upgrade fails on a specific assertion style we lean on heavily** → stop at Pest 3 (`^3.0`) rather than 4.
- **Any test fails and the cause can't be identified in ~30 min** → bisect by rolling one package back at a time.
- **Unexpected 500 on a real page** (tests only check status codes, not rendering) → debug before committing Boost install.
