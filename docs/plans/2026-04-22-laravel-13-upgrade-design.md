# Laravel 13 Upgrade — Design

**Date:** 2026-04-22
**Branch:** `upgrade/laravel-13` (to be created)
**Scope:** Composer-only upgrade. npm/Tailwind out of scope.

## Goal

Move this portfolio project from Laravel 11 to the latest Laravel (13.6+), upgrade all related composer dependencies, then install `laravel/boost` to prepare the project for Claude Code-assisted work.

## Approach

Direct jump (not incremental per-major). The project is small, has a smoke-test suite, and is on a personal branch — risk of stalling mid-upgrade is low. If a specific package causes trouble we stop and fix; otherwise we do the whole bump in one pass.

## Target Version Matrix

| Package | From | To | Risk |
|---|---|---|---|
| `laravel/framework` | ^11.0 | ^13.0 | Medium — `bootstrap/app.php`, config diffs |
| `livewire/livewire` | ^3.4 | ^4.0 | Medium — major bump, API review needed |
| `livewire/volt` | ^1.6 | ^1.10 | Low — minor |
| `pestphp/pest` | ^2.0 | ^4.0 | Medium — two major versions |
| `pestphp/pest-plugin-laravel` | ^2.0 | ^4.0 | Low — tracks Pest |
| `nunomaduro/collision` | ^8.0 | ^8.9 | Low |
| `laravel/tinker` | ^2.9 | ^2.10 | Low |
| `spatie/laravel-ignition` | ^2.4 | latest ^2 | Low |
| `laravel/sail` | ^1.26 | latest ^1 | Low |
| `laravel/boost` | (new) | ^1.0 | N/A — install last |

## Execution Steps

1. **Safety net.** Commit dirty `header.blade.php`, branch `upgrade/laravel-13`, confirm `./vendor/bin/pest` is green on v11 before touching anything.
2. **Edit `composer.json`** with all target constraints in one pass.
3. **Run `composer update`.** Resolve constraint conflicts by reading the resolver error.
4. **Fix Laravel 12/13 breaking changes.** Expect diffs in `bootstrap/app.php`, config files, and a handful of renamed helpers.
5. **Fix Livewire 4 breaking changes.** Audit Volt components for deprecated syntax/hooks.
6. **Fix Pest 4 breaking changes.** Existing tests are simple smoke tests — low risk.
7. **Run `./vendor/bin/pest`** until green.
8. **Run `./vendor/bin/pint`** to normalize style drift.
9. **Manual smoke.** `php artisan serve` + `npm run dev`, eyeball home, blog index, a post, and 404.
10. **Install `laravel/boost`** and run its post-install command.
11. **Commit at logical checkpoints** (per major package upgrade) for cheap rollback.

## Stop Conditions

- If Livewire 4 proves incompatible with Volt 1.10 → pause and reassess (maybe stay on Livewire 3 until Volt catches up).
- If a test failure can't be traced to a specific package in ~30 min → bisect by rolling back one package at a time.

## Non-Goals

- npm / Tailwind 4 upgrade.
- Feature work.
- Refactoring toward framework idioms (that's a follow-up after Boost is installed).
