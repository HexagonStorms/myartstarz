# CLAUDE.md - MyArtStarz Website Migration

## Project Overview
**Client:** MyArtStarz (Shelley Fluke) - Children's art school in San Antonio, TX
**Site:** myartstarz.com
**Contract Date:** January 31, 2026
**Target Launch:** February 23, 2026

Phased modernization and migration of myartstarz.com from legacy WordPress to a modern Full Site Editing (FSE) environment. The existing site must be **cloned first** - we are NOT building from scratch.

## Project Phases

### Phase 1: Migration & Core Infrastructure
- [ ] Clone existing site to local/staging environment
- [ ] Migrate hosting to new high-performance provider (zero downtime - keep old server live)
- [ ] Upgrade to WordPress 6.9 and PHP 8.3+
- [ ] Implement SSL certificate for secure payments
- [ ] Integrate Google Analytics

### Phase 2: Feature Retention & Functional Upgrades
- [ ] Retain all user accounts, login data, and registration history
- [ ] Preserve order history (users can view past orders)
- [ ] Maintain Stripe integration for payments
- [ ] Keep automated email notifications on registration
- [ ] Implement Guest Checkout
- [ ] Retain refund capabilities
- [ ] Remove/hide "Teachers" tab
- [ ] Remove/hide "Product" (art merchandise) page
- [ ] Simplify admin interface for staff (Lisa) to manage registrations

### Phase 3: Design & UI/UX
- [ ] Migrate to FSE theme (block-based editing for non-technical staff)
- [ ] Mobile optimization for "Class Locations" page (dropdowns/easy search)
- [ ] Retain existing logo (no rebrand)
- [ ] Modernize color palette
- [ ] Add prominent CTA button ("Register for Classes Now")
- [ ] Add Hero Video on homepage (children painting)
- [ ] Consider "Our Story" page to replace Teachers page

## Client Design Preferences (from Shelley)

### Design Inspiration Sites
| Site | What Shelley Likes |
|------|-------------------|
| swschool.org | Big banner/photo across homepage, basic format, static or rotating 3-4 photos |
| kidcreatestudio.com | Color usage (turquoise, orange, bright green), "boxes" for programs, user-friendly |
| deepspacesparkle.com | Fresh, bright color scheme that complements kids' art |

### Color Direction
- Turquoise
- Orange
- Bright green
- Fresh, bright colors that complement children's artwork

### Key UX Requirements
- **Staff ease of use is CRITICAL** - Lisa (assistant) needs to easily update semester dates
- Neither Shelley nor Lisa are technical - simplicity is paramount
- Current payment/registration flow works fine - don't break it
- Parents sign up for classes and pay supply fees - this must remain functional

## Technical Stack
- **CMS:** WordPress 6.9+
- **PHP:** 8.3+
- **Theme:** Custom FSE theme (block-based)
- **Payments:** Stripe (existing integration)
- **Email:** Automated notifications (existing)
- **Analytics:** Google Analytics
- **SSL:** Required for payment processing
- **Domain Registrar:** GoDaddy

## Access Required
- WordPress administrator credentials
- GoDaddy (Domain/DNS) login

## Development Workflow

### Local Development
```bash
# Clone will go here after site export
# Using Local by Flywheel, DDEV, or wp-env for local dev
```

### Commands
- `/validate` - Check theme/plugin compatibility
- `/lint` - PHP/JS linting

## File Structure
```
myartstarz/
├── CLAUDE.md                    # This file
├── .claude/commands/            # Project-specific commands
├── docs/
│   ├── CODEBASE_INDEX.md       # File registry (after clone)
│   └── plans/                   # Implementation plans
├── site-clone/                  # Cloned WordPress site (after export)
│   ├── wp-content/
│   │   ├── themes/
│   │   │   └── myartstarz-fse/ # New FSE theme
│   │   └── plugins/
│   └── ...
└── assets/                      # Design assets, hero video, etc.
```

## Important Notes
- **DO NOT** break existing payment/registration functionality
- **DO NOT** lose any user data or order history
- **ALWAYS** test on staging before production
- Keep original site live during entire development process
- Lisa must be able to update class dates without developer help

## Original Designer
Kyle Kennedy - may have additional context on legacy setup

## Contact
- **Client:** Shelley Fluke (info@myartstarz.com)
- **Agency:** Plaza Codes / Josue Plaza (hello@joshplaza.com)
