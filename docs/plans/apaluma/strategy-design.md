# Apaluma Senior Engineer Application: Strategy & Design

**Date:** 2026-05-14
**Status:** Phase 0 message sent; Phase 1 (resume) draft v2 + Phase 4 (cover letter) v1 complete and soaking; Phases 2, 3, 5 designed but not executed
**Applicant:** Andrew Rhyand
**Target role:** Senior Engineer (Full-Stack, frontend-leaning) at Apaluma, Inc., Albuquerque NM
**Referral:** Friend at Apaluma (message sent; awaiting response)
**Companion artifacts:** `resume-draft.md`, `cover-letter-draft.md`

## Goal

Land the Senior Engineer role at Apaluma. The application package and downstream artifacts (LinkedIn, portfolio, interview prep) all flow from a single positioning thesis defined in this document. Content here is designed to be reusable: the resume PROFILE, AI-Assisted Engineering section, and project bullets feed LinkedIn, the cover letter, and interview talking points.

## Non-goals

- Rebuilding the portfolio site to match Apaluma's stack (Vue/Python). The site stays in Laravel/Volt as evidence of independent technical growth; pandering would read worse than authenticity.
- Listing every project Andrew has ever shipped. The resume curates 5 strong examples, not a complete history.
- Hiding WordPress experience. WordPress appears, but never as the headline. It's framed as one vertical the agency serves, not Andrew's identity.

## Company brief (Apaluma)

- **What they do:** AI document/data intelligence platform for state environmental regulators (air, water, waste, energy). AI agent named "Luma." Tagline "Intelligence Layer for Government Data."
- **Anchor customer:** New Mexico Environment Department via "Project Velocity": ~18M pages of regulatory docs digitized.
- **Stage:** Founded ~2024; ~$100K seed from NM Vintage Fund (April 2025); ~7 employees. Revenue from state contracts.
- **CEO:** Alicia J. Keyes: former NM Cabinet Secretary of Economic Development. Non-technical, political/business background.
- **CTO:** Tilan Ukwatta, PhD: astrophysics PhD, Los Alamos postdoc. Python/Django/AWS background. Data-science-leaning, not frontend.
- **Stack (per job listing):** Vue + TypeScript + Tailwind frontend; Python + FastAPI on AWS ECS; Postgres; S3.
- **Culture (per job listing):** Small team, low ceremony, AI tools required ("everyone uses LLMs, copilots"). Direct + kind communication. End users are non-power-users (regulators, scientists, program managers).
- **Marketing site signal:** Built with Lovable (no-code AI site builder). Indicates they don't currently have in-house frontend craft, likely why this role exists.
- **Context to be aware of (do NOT raise in cover letter):** Local investigative outlet The Candle has alleged Apaluma received no-bid NMED contracts (~$499K + ~$977K) arranged by NMED Secretary James Kenney, a former cabinet colleague of CEO Keyes. Revenue is concentrated in one politically-contested state agency relationship. Implication: "growth" likely means winning other states next. Reasonable interview question to ask: "What does the customer pipeline beyond NMED look like over the next 18 months?"

## Positioning thesis

Andrew is a **senior full-stack engineer, frontend-leaning, with broad modern-stack range and an active daily agentic-coding practice**. The thesis has four pillars:

1. **Range, not WordPress.** 5 years at a small Albuquerque agency where the work has spanned Vue, Svelte, React, Astro, Laravel, custom PHP APIs, performance/caching/CDN, queue infrastructure, and AI integration. WordPress is one vertical served, not the identity. He has been writing software since 2010.
2. **Senior judgment.** Architectural decisions during sales discovery (the "Business Strategist" half of his actual title), informal mentorship across the team, ownership across the stack.
3. **AI-native engineering practice.** Daily practitioner of agentic coding (Claude Code, Codex) since late 2025. Multi-agent workflows. Workflow discipline for catching agent drift. The senior insight: agentic coding doesn't change what senior engineers think about; it gives them bandwidth to do that thinking well instead of context-switching between strategy and typing.
4. **Local + warm.** Lives in Albuquerque (eliminates the quarterly-travel friction). Has a friend at the company. Both signals are real and underweighted if not surfaced.

## The four-pillar fit to Apaluma

- **Pillar 1 (range)** matches their need for actual frontend craft (their site is Lovable-built; they need someone who can own production Vue).
- **Pillar 2 (senior judgment)** matches the small-team need for someone who can think across product/architecture without managerial overhead.
- **Pillar 3 (AI-native practice)** matches their explicit cultural requirement that "everyone uses LLMs, copilots, and other AI-assisted tooling."
- **Pillar 4 (local + warm)** lowers risk and onboarding cost.

## Sequencing (5 phases)

| Phase | Workstream | Status |
|---|---|---|
| 0 | Activate the referral | designed, not executed |
| 1 | Resume (anchor artifact) | v2 draft complete; soaking |
| 2 | LinkedIn modernization | not yet designed |
| 3 | Portfolio site tweaks (surgical) | not yet designed |
| 4 | Application package (cover letter + submit) | not yet designed; partially dependent on Phase 0 intel |
| 5 | Interview prep | not yet designed |

**Sequencing principles:**
- Each phase ends with a checkpoint; re-decide whether the next phase still makes sense or needs to shift.
- Phase 0 first because intel from the friend could reshape the resume, cover letter, and interview prep.
- Resume before LinkedIn because the resume content (PROFILE, AI section, project bullets) feeds LinkedIn.
- Cover letter waits for Phase 0 intel (e.g., what the CTO actually cares about).
- LinkedIn modernization is broader than this single application. Andrew has expressed it doesn't currently represent him well even within his current role. Optimize for the broader job-search market, not just Apaluma.

## Phase 0 design: Activate the referral

**Goal:** Convert a job-listing tip into actionable intel and (if possible) internal advocacy.

**Three-layer ask** (in increasing cost to the friend):

1. **Insider intel** (free for them): What's the team actually struggling with? What is Tilan like to work for? Is the Vue codebase well-architected or Lovable-stage prototype? Interview process shape? Comp range? Pipeline beyond NMED? Any unwritten must-haves?
2. **Soft endorsement** (low cost): Would they mention Andrew's name to Tilan/Alicia before the application lands? Not advocacy, just visibility. At a 7-person company this alone moves the resume to the top of the pile.
3. **Active intro** (higher cost): A 15-min informal call with Tilan before formal application, or hand-walk resume in.

**Important:** Do NOT lead with #3. Start with a casual "saw the listing, seriously interested, can we chat 20 min" and let the level of help emerge naturally.

**Channel:** Whatever Andrew normally uses with the friend (text > Slack > LinkedIn > email > phone). Don't formalize the relationship.

**Tone:** Confident and specific, not hat-in-hand.

**What Andrew brings to the conversation:**
- 30-second articulation of why Apaluma specifically (not "I'm just looking")
- 2–3 sharp prepared questions from the intel list
- A short answer to "what are you up to these days" that lands his actual range (not a WordPress recap). This is itself a rehearsal for the cover letter and interview.

**Output:** Intel that may reshape downstream artifacts. Possibly an internal warm path. Time: one conversation, one week max.

## Phase 1 design: Resume

The full v2 draft lives in `resume-draft.md`. Design decisions captured here:

### Strategic moves

- **"Senior full-stack engineer, frontend-leaning"** as the lead, which mirrors the job title language without sycophantic copying.
- **Two-story arc**: Experience (Gecko) for stability + range; Selected Projects for initiative + self-driven growth. Half-and-half framing matches reality.
- **Top-of-page positioning**: PROFILE → TECHNOLOGIES → AI-ASSISTED ENGINEERING → EXPERIENCE. The dedicated AI section is between TECHNOLOGIES and EXPERIENCE so it lands before the work history sets a frame.
- **AI mentioned in two distinct ways**: (a) "AI feature integration" = building AI INTO products (PROFILE + bullets), (b) "agentic-coding workflows" = using AI to build products (PROFILE + dedicated section). These are different competencies; both matter for Apaluma.
- **No name-dropping in PROFILE.** Tool names (Claude Code, Codex) live in the dedicated AI-Assisted Engineering section and the AI/ML tech row. The PROFILE talks practice; the section names tools.
- **The senior insight**, written tight: *"The output is ordinary, well-crafted code. The change is in how engineering time is spent: orchestrating multi-agent runs, recognizing when an agent is drifting, and holding attention at the architectural and business-domain level rather than line-by-line authoring."* This is the differentiator at a glance.
- **WordPress mentioned once in Gecko bullets** as an agency vertical, not as identity. Appears once more as one stack option among many in the architecture-recommendations bullet.
- **No Education section.** "Self-taught software developer since 2010" folds into PROFILE. High school omitted; at senior level with 16 years experience, this is clean, not a gap.
- **No prior-experience section.** Cell phone retail sales and pre-Gecko freelance both excluded. The PROFILE handles the "I've been doing this longer than 5 years" beat.
- **Title kept as written:** "Senior Software Engineer & Business Strategist." Confirmed by Andrew as his actual offer-letter title. The "Business Strategist" half earns its keep via the sales-discovery architecture bullet.
- **Length target:** 1–1.5 pages. Senior + Selected Projects justifies the length; we don't force one page.

### Project attribution (resolved)

| Project | Attribution | Section |
|---|---|---|
| Movie Madness | Gecko client work | Experience bullet |
| AG Tire | Gecko client work | Experience bullet |
| Groundtruth | Personal/independent | Selected Projects |
| Guild Cinema | Self-directed prototype | Selected Projects |
| Alibi.com | Independent pro bono | Selected Projects |
| andrewrhyand.com | Personal portfolio | Selected Projects |

### What's NOT on the resume (saved for elsewhere)

- **Custom inference / private hosted LLMs:** Andrew has explored these but doesn't want to claim expertise. Save for interview talking points where context lets him say "I've also been exploring X for cases where data sensitivity or cost makes vendor APIs the wrong fit." Lands beautifully in a conversation about Apaluma's government-data workload.
- **The educational/learning-journey narrative** for the agentic-coding practice: resume signals via the dedicated section; the narrative gets full expression in the cover letter and Phase 0 conversation.

## Phase 2 design: LinkedIn (preview, not yet executed)

Modernization is broader than just this application. Andrew has expressed his current LinkedIn doesn't represent him well even within his current role. Two goals:

1. **Honest representation of his actual scope and range at Gecko.** Current employer stays; the role description gets updated to reflect what he actually does, not the WordPress-shaped surface.
2. **Recruiter-readability** for the broader job-search market, not just for Apaluma.

Content reuse plan: LinkedIn About section mirrors resume PROFILE (with slight expansion since LinkedIn allows more space). Job description for Gecko mirrors the EXPERIENCE entry. Featured section can pull from Selected Projects.

To be designed in detail after Phase 1 is finalized.

## Phase 3 design: Portfolio site tweaks (preview)

Surgical, not a rebuild. Stays in Laravel/Volt.

**Likely candidates:**
- Better project case studies for the 4 Selected Projects items (Groundtruth, Guild Cinema, Alibi, possibly Movie Madness or AG Tire as a writeup with permission).
- A `/resume` page that renders the resume content as a digital, linkable artifact, which doubles as a frontend craft demo.
- Possibly a short writeup on the agentic-coding journey (this is the place for the educational-journey narrative Andrew wants to express).

**Explicitly NOT:** rebuilding in Vue to match Apaluma's stack. The Laravel/Volt site is itself evidence of independent technical growth and should remain that.

To be designed in detail after Phases 0–2.

## Phase 4 design: Application package (preview)

- Short cover letter (3 paragraphs) shaped around Apaluma's stated "illuminate dark data" mission, accessibility for non-power-users, and the AI-native workflow expectation.
- Names the friend (with their consent from Phase 0).
- Surfaces what's distinctive: agentic-coding practice + agency cross-functional execution + local.
- Does NOT raise the no-bid contract controversy. Does NOT lecture about their stack.

Depends on Phase 0 intel.

## Phase 5 design: Interview prep (preview)

- STAR stories mapped to the 5 projects in the resume.
- Performance / architecture examples translated from WordPress idiom into web-fundamentals language.
- Question bank for them: pipeline beyond NMED, codebase shape, PR/review culture, growth path, the team's frontend confidence level given Lovable-built marketing site.
- Talking points: custom inference, AI-native workflow journey, regulatory-data domain experience via Groundtruth.

To be designed after the application is sent.

## Key decisions (consolidated reference)

1. Phase 0 (referral) before Phase 1 (resume); intel may reshape the resume.
2. Two-story resume arc: Experience + Selected Projects.
3. WordPress is never the headline.
4. AI-Assisted Engineering is a marquee section, not a buried bullet.
5. PROFILE leads "Senior full-stack engineer, frontend-leaning"; mirrors job title.
6. No Education section; no prior-experience section.
7. Title preserved as "Senior Software Engineer & Business Strategist."
8. Custom inference is interview-only.
9. Tool names (Claude Code, Codex) live in dedicated section + tech row; not in PROFILE.
10. Portfolio site stays Laravel/Volt; no pandering rebuild.
11. LinkedIn optimized for the broader market, not Apaluma-specific.
12. Local + referral are real assets; surface both.

## Open questions / TBD

- Phase 0 conversation outcome (intel, advocacy level)
- Whether any additional Gecko projects should round out the Experience bullets after v2 sits
- Resume format/output decisions (file type, visual treatment, ATS-friendly layout, digital resume page on portfolio site)
- Whether the Groundtruth lack-of-public-URL needs any mitigation (current take: not on resume; address in interview with local staging walkthrough)
- Comp range Apaluma is willing to pay (expected from Phase 0)
