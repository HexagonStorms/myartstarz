# Phase 1: Migration & Core Infrastructure

## Status: Not Started

## Prerequisites
- [ ] WordPress admin credentials from Shelley
- [ ] GoDaddy login access
- [ ] Meeting with Kyle Kennedy (original designer) for context

## Tasks

### 1. Site Clone & Local Setup
- [ ] Install local WordPress environment (Local by Flywheel, DDEV, or wp-env)
- [ ] Export existing database via phpMyAdmin or WP-CLI
- [ ] Download full wp-content directory via SFTP/SSH
- [ ] Import to local environment
- [ ] Verify site runs locally with all functionality

### 2. Audit Existing Setup
- [ ] Document all active plugins
- [ ] Document current theme
- [ ] Identify custom code
- [ ] Map database structure (especially registration/order tables)
- [ ] Document Stripe integration method
- [ ] Document email notification system

### 3. Staging Environment
- [ ] Set up staging server on new host
- [ ] Deploy cloned site to staging
- [ ] Configure staging domain (e.g., staging.myartstarz.com)
- [ ] Test all functionality on staging

### 4. WordPress & PHP Upgrade
- [ ] Test WordPress 6.9 compatibility locally
- [ ] Test PHP 8.3 compatibility locally
- [ ] Update all plugins to latest versions
- [ ] Fix any deprecation warnings
- [ ] Deploy upgrades to staging
- [ ] Full regression test

### 5. SSL & Security
- [ ] Verify SSL on new host
- [ ] Configure HTTPS redirects
- [ ] Test Stripe payments over HTTPS
- [ ] Security audit (basic hardening)

### 6. Google Analytics
- [ ] Get GA tracking ID from Shelley (or create new)
- [ ] Install via Site Kit or manual integration
- [ ] Verify tracking on staging

## Acceptance Criteria
- Site runs on staging with WordPress 6.9 and PHP 8.3+
- All existing functionality works (registration, payment, user accounts)
- SSL active and payments work securely
- Google Analytics tracking verified
- Original site remains live and unaffected
