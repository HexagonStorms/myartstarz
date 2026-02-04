# MyArtStarz Codebase Index

## Status: Pre-Clone
The existing site has not yet been cloned. This index will be populated after site export.

## Pending: Site Clone Steps
1. Export database from existing WordPress
2. Download wp-content (themes, plugins, uploads)
3. Document existing plugins and their purposes
4. Document existing theme structure
5. Identify custom code vs standard plugins

## Expected Structure (Post-Clone)

### Core Files
| Path | Purpose |
|------|---------|
| `site-clone/` | Full WordPress installation |
| `site-clone/wp-content/themes/` | Current theme(s) |
| `site-clone/wp-content/plugins/` | Active plugins |
| `site-clone/wp-content/uploads/` | Media files |

### New Theme (To Be Created)
| Path | Purpose |
|------|---------|
| `site-clone/wp-content/themes/myartstarz-fse/` | New FSE theme |
| `site-clone/wp-content/themes/myartstarz-fse/theme.json` | Global styles & settings |
| `site-clone/wp-content/themes/myartstarz-fse/templates/` | Block templates |
| `site-clone/wp-content/themes/myartstarz-fse/parts/` | Template parts (header, footer) |
| `site-clone/wp-content/themes/myartstarz-fse/patterns/` | Block patterns |

## Plugins to Audit
After clone, document:
- [ ] WooCommerce or custom registration system?
- [ ] Stripe plugin name and version
- [ ] Email notification plugin
- [ ] Any custom plugins
- [ ] SEO plugin
- [ ] Caching plugin
- [ ] Security plugin

## Database Tables to Preserve
- `wp_users` - User accounts
- `wp_usermeta` - User metadata
- Order/registration tables (identify after clone)
- Any custom tables

## Integration Points
- Stripe API keys (get from client)
- Email service configuration
- Google Analytics tracking ID
