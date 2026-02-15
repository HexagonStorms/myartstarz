# CLAUDE.md - MyArtStarz Website Migration

## Project Overview
**Client:** MyArtStarz (Shelley Fluke) - Children's art school in San Antonio, TX
**Site:** myartstarz.com
**Contract Date:** January 31, 2026
**Target Launch:** February 23, 2026

Phased modernization and migration of myartstarz.com from legacy WordPress to a modern Full Site Editing (FSE) environment. The existing site must be **cloned first** - we are NOT building from scratch.

## Staging Server

The site is live on a Hetzner VPS managed by the `plaza-codes-vps` project (`~/Code/plaza-codes-vps/`).

- **Staging URL:** https://myartstarz.plaza.codes
- **Server IP:** 5.78.148.196
- **SSH:** `ssh hetzner` (root@5.78.148.196, key: ~/.ssh/hetzner_rsa)
- **Web root:** `/var/www/myartstarz.plaza.codes/public/`
- **Site user:** `myartstarz_plaza_codes`
- **Database:** `myartstarz_plaza_codes_db` (MariaDB, table prefix: `mas_`)
- **PHP:** 8.3-FPM
- **Current theme:** Function (WooThemes classic theme — being replaced with FSE)
- **WP-CLI:** Available as `sudo -u myartstarz_plaza_codes wp --path=/var/www/myartstarz.plaza.codes/public`
- **WordPress admin:** https://myartstarz.plaza.codes/wp-admin/

## Deployment Workflow

### Deploy theme changes to staging
```bash
# Deploy the FSE theme
rsync -avz --delete ~/Code/myartstarz/wp-content/themes/myartstarz-fse/ \
    root@hetzner:/var/www/myartstarz.plaza.codes/public/wp-content/themes/myartstarz-fse/

# Fix ownership
ssh hetzner "chown -R myartstarz_plaza_codes:myartstarz_plaza_codes /var/www/myartstarz.plaza.codes/public/wp-content/themes/"

# Verify
ssh hetzner "curl -sI https://myartstarz.plaza.codes/ | head -3"
```

Or use the `/deploy` command which does all of the above.

### Pull latest from server (if changes were made via wp-admin)
```bash
rsync -avz root@hetzner:/var/www/myartstarz.plaza.codes/public/wp-content/themes/ ~/Code/myartstarz/wp-content/themes/
```

### Run WP-CLI commands on the server
```bash
ssh hetzner "sudo -u myartstarz_plaza_codes wp plugin list --path=/var/www/myartstarz.plaza.codes/public"
ssh hetzner "sudo -u myartstarz_plaza_codes wp theme activate myartstarz-fse --path=/var/www/myartstarz.plaza.codes/public"
```

## Project Phases

### Phase 1: Migration & Core Infrastructure — DONE
- [x] Clone existing site to staging environment (Hetzner VPS)
- [x] Migrate hosting to new high-performance provider
- [x] Upgrade to WordPress 6.9 and PHP 8.3+
- [x] Implement SSL certificate for secure payments
- [ ] Integrate Google Analytics

### Phase 2: Feature Retention & Functional Upgrades
- [x] Retain all user accounts, login data, and registration history (migrated from Cloudways)
- [x] Preserve order history (users can view past orders)
- [x] Maintain Stripe integration for payments
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
- **Theme:** Custom FSE theme (block-based) — replacing legacy "Function" WooThemes theme
- **Payments:** Stripe (existing integration, live keys configured)
- **E-commerce:** WooCommerce
- **Email:** Automated notifications (existing)
- **Analytics:** Google Analytics (to be integrated)
- **SSL:** Let's Encrypt (auto-renewing)
- **Domain Registrar:** GoDaddy (DNS via Cloudflare)

## File Structure
```
myartstarz/
├── CLAUDE.md                    # This file
├── .gitignore                   # Ignores third-party themes/plugins, uploads
├── .claude/commands/
│   └── deploy.md               # /deploy — push theme changes to staging server
├── docs/
│   ├── CODEBASE_INDEX.md        # File registry
│   └── plans/                   # Implementation plans
├── wp-content/
│   └── themes/
│       └── myartstarz-fse/      # Custom FSE theme (this is what we develop)
│           ├── style.css
│           ├── theme.json
│           ├── templates/
│           └── parts/
└── Professional Service Agreement - MyArtStarz.pdf
```

## Important Notes
- **DO NOT** break existing payment/registration functionality
- **DO NOT** lose any user data or order history
- **ALWAYS** deploy to staging (myartstarz.plaza.codes) and verify before going to production
- Keep original Cloudways site live during entire development process
- Lisa must be able to update class dates without developer help
- The Function theme is old (2011, WooThemes) and throws PHP 8.3 deprecation warnings — this is expected and harmless
- reCAPTCHA will show "invalid domain" on staging — this is expected and resolves when moved to myartstarz.com

## Contact
- **Client:** Shelley Fluke (info@myartstarz.com)
- **Agency:** Plaza Codes / Josue Plaza (hello@joshplaza.com)
- **Original Designer:** Kyle Kennedy
