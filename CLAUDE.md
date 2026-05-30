# CLAUDE.md - MyArtStarz Website Migration

## Project Overview
**Client:** MyArtStarz (Shelley Fluke) - Children's art school in San Antonio, TX
**Site:** myartstarz.com
**Contract Date:** January 31, 2026
**Target Launch:** February 23, 2026

Phased modernization and migration of myartstarz.com from legacy WordPress to a modern Full Site Editing (FSE) environment. The existing site must be **cloned first** - we are NOT building from scratch.

## Production Server

The live site is **https://myartstarz.com**, hosted on the Hetzner VPS managed by the `plaza-codes-vps` project (`~/Code/plaza-codes-vps/`). The migration is complete — the FSE theme is active and myartstarz.com is served directly from this box. The old Cloudways host (see `deploy.sh`) is legacy and no longer the deploy target.

- **Live URL:** https://myartstarz.com (WordPress `siteurl`/`home` are both this)
- **Server IP:** 5.78.148.196 — **DNS:** myartstarz.com → 5.78.148.196
- **SSH:** `ssh hetzner` (root@5.78.148.196, key: ~/.ssh/hetzner_rsa)
- **Web root:** `/var/www/myartstarz.plaza.codes/public/` (directory name is historical; this IS production — do not delete it)
- **Site user:** `myartstarz_plaza_codes`
- **Database:** `myartstarz_plaza_codes_db` (MariaDB, table prefix: `mas_`)
- **PHP:** 8.3-FPM
- **Active theme:** `myartstarz-fse` (custom FSE theme — this is what we develop)
- **WP-CLI:** `sudo -u myartstarz_plaza_codes wp --path=/var/www/myartstarz.plaza.codes/public`
- **WordPress admin:** https://myartstarz.com/wp-admin/

### Decommissioned: myartstarz.plaza.codes

`myartstarz.plaza.codes` was a temporary staging alias. It pointed at the *same* docroot and database as production, so it was never a separate environment. **Torn down 2026-05-30** — its Nginx server block and SSL cert were removed (nginx conf backed up to `/root/teardown-backup-myartstarz-plaza-codes/` on the box); the docroot and database were left intact because they are production. A stale DNS record may still exist in Cloudflare. Do not recreate the alias.

## Deployment Workflow

Changes go straight to production (there is no separate staging environment). Sync the theme, fix ownership, verify.

```bash
# Deploy the FSE theme
rsync -avz --delete ~/Code/myartstarz/wp-content/themes/myartstarz-fse/ \
    root@hetzner:/var/www/myartstarz.plaza.codes/public/wp-content/themes/myartstarz-fse/

# Fix ownership
ssh hetzner "chown -R myartstarz_plaza_codes:myartstarz_plaza_codes /var/www/myartstarz.plaza.codes/public/wp-content/themes/"

# Verify
ssh hetzner "curl -sI https://myartstarz.com/ | head -3"
```

Or use the `/deploy` command which does all of the above. **Pull server changes back into the repo first** (next section) — the live theme has been edited out-of-band before, and `--delete` will clobber anything not in git.

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
- Deploys go straight to production (myartstarz.com). There is no separate staging — verify on the live site after each deploy, ideally off-hours.
- The live theme has been edited out-of-band (directly on the server) before. **Always pull the server theme into the repo before deploying** so `rsync --delete` doesn't clobber untracked changes.
- Lisa must be able to update class dates without developer help

## Contact
- **Client:** Shelley Fluke (info@myartstarz.com)
- **Agency:** Plaza Codes / Josue Plaza (hello@joshplaza.com)
- **Original Designer:** Kyle Kennedy
