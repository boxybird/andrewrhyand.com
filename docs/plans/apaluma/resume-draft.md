# Apaluma Resume: Draft v3

**Date:** 2026-05-14
**Status:** v3 synced from `Andrew_Rhyand_Resume.docx` (final Google Docs polish)
**Strategy doc:** `strategy-design.md`
**Companion:** `cover-letter-draft.md`
**Format:** content only; file-type and visual treatment decisions deferred

This file is the editable, reusable artifact. Content here will be sliced and remixed for LinkedIn (Phase 2), the cover letter (Phase 4), and the portfolio site (Phase 3).

---

## ANDREW RHYAND

Albuquerque, NM  ·  andrew.rhyand@gmail.com  ·  (503) 505-8485
andrewrhyand.com  ·  github.com/boxybird  ·  linkedin.com/in/andrew-rhyand

## PROFILE

Senior full-stack engineer, business strategist. Writing software since 2010; shipping production web applications professionally since 2021. Work goes deep where the problem demands it: reverse-engineering undocumented legacy codebases, designing vector-search architectures, tuning production caching layers, bridging on-premise systems to modern stacks. Built across modern frameworks (Vue, Svelte, React, Astro, Laravel) with test-driven, convention-enforced practices. Use agentic-coding workflows daily to keep engineering time at the architectural-decision level rather than line-by-line.

## TECHNOLOGIES

| Category | Stack |
|---|---|
| AI / ML | Agentic coding (Claude Code, Codex), LLM integration, vector embeddings, MCP servers |
| Frontend | Vue, Svelte, React, Astro, HTMX, TypeScript, Tailwind, Livewire, Inertia.js |
| Backend | Laravel, PHP, Python, REST APIs, custom integrations |
| Data | PostgreSQL, PostGIS, MySQL, SQLite, Redis, Meilisearch |
| Infrastructure | AWS, DigitalOcean, CloudFlare, OpenVPN, Linux, queue systems |

## AI-ASSISTED ENGINEERING

Daily practitioner of agentic coding (Claude Code, Codex) since late 2025, on production work at Gecko and personal projects. The output is ordinary, well-crafted code. The change is in how engineering time is spent: orchestrating multi-agent runs, recognizing when an agent is drifting, and holding attention at the architectural and business-domain level rather than line-by-line authoring. Concrete patterns include custom MCP servers for structured agent context, and Playwright verification loops so agents check their own frontend changes before completion.

## EXPERIENCE

### Senior Software Engineer & Business Strategist
**The Gecko Agency** · Missoula, MT · March 2021–Present

One of three senior engineers at a 10-person Missoula agency. Own technical architecture decisions across the client portfolio, evaluate and recommend stacks during sales conversations, and serve as the team's de facto reference for design and engineering questions.

- Built an AI-powered semantic search experience for Movie Madness, an independent Portland video rental business with a 100,000+ title catalog. Designed a vector-embedding search layer using Meilisearch over a normalized PHP/HTMX stack, enabling lookup by mood, theme, and partial recall instead of exact-match titles. Now serves tens of thousands of searches per month in production.

- Designed and built a custom REST API bridging an on-premise legacy database to a modern Laravel e-commerce storefront for an agricultural tire wholesaler, plus a B2B wholesaler portal on the same backend. Provisioned the DigitalOcean Linux host and established a persistent OpenVPN tunnel into the client network for real-time product, inventory, and order sync. Built collaboratively in Claude Code.

- Establish performance, caching, and delivery patterns across the client portfolio (CloudFlare CDN, Redis caching layers, queue-based async processing, image pipelines) to keep interfaces responsive under variable load.

- Lead architectural recommendations during sales discovery, selecting stacks (Laravel/Inertia, Astro/Svelte, custom PHP, WordPress) that match client constraints and long-term maintainability. Informal team reference: designers and developers consult on technical and product questions.

## SELECTED PROJECTS

### Groundtruth: New Mexico Water Data Aggregation Platform
*Laravel · PostgreSQL 16 + PostGIS · React via Inertia.js*

Independent project. Consumer-facing platform unifying New Mexico's fragmented public water data (groundwater levels, well permits, water rights) into a single address-searchable interface. Built data ingestion pipelines pulling from disparate state agency file systems, library archives, and legacy APIs. Used AI to normalize heterogeneous records into a unified schema, replacing what is otherwise a manual, labor-intensive process. Implemented PostGIS geospatial queries for address-based lookup, coordinate-system transformations, and point-in-polygon checks against water rights boundaries. Built with agentic coding tools.

### Loci: Mobile Companion for Gaming Sessions
*Capacitor · On-device vector embeddings · SQLite*

Independent app, live at locicodex.com. Captures in-game moments (photos, notes, voice) and recalls them later by mood, topic, or partial memory. Built local-first with on-device vector embeddings, suited to the offline and low-connectivity reality of gaming sessions and travel. Architectural counterpoint to the cloud-based Movie Madness search: same problem class (semantic recall over user content), different deployment constraints (mobile, on-device, no network round-trip).

### Guild Cinema: Independent Theater Ticketing Prototype
*Astro (Svelte islands) · DigitalOcean*

Self-directed prototype for an underserved venue type. Researched small-theater operational pain points (checkout friction, expensive integrations, thin margins), designed the full UX from scratch, and built the application end-to-end with agentic AI design and coding tools. Features tailored to small-venue economics: round-up-to-donate checkout, pre-purchase concessions, rewards, gift cards, and private rental inquiries.

### Alibi.com: Legacy CMS Reverse Engineering and Migration
*Custom PHP (legacy) · WordPress · MySQL*

Independent pro bono modernization of a long-running Albuquerque alternative weekly publication. Reverse engineered an opaque, single-developer legacy PHP codebase (no framework, no documentation) to derive the content model from source, then extracted, normalized, and migrated decades of editorial content into WordPress with image attributions, captions, and bylines preserved. Designed and built the new site end-to-end. Previous developers had attempted and abandoned the migration; project had stalled for years before delivery.

---

## Notes for revision

- **v3 was synced from `Andrew_Rhyand_Resume.docx`** (final polish in Google Docs)
- **Things to fix in the docx itself:**
  - Spacing typo: "Missoula,MT" missing space after comma
  - Editing artifact: "Fum" appears in the AI-ASSISTED ENGINEERING section followed by a duplicate of the PROFILE paragraph (visible when text-extracting the docx); needs removal

## Reuse map (content → downstream artifacts)

| Section here | Reused in |
|---|---|
| PROFILE | LinkedIn About; cover letter opening; portfolio `/resume` header |
| AI-ASSISTED ENGINEERING | LinkedIn About expansion; cover letter middle paragraph; portfolio `/resume`; interview talking points |
| Gecko bullets | LinkedIn job entry; cover letter selective quotes; interview STAR stories |
| Selected Projects | LinkedIn Featured; portfolio case studies; interview deep-dives |
