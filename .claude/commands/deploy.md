Deploy theme and plugin changes to the staging server.

Rsync the wp-content/themes/ directory to the Hetzner VPS:

```bash
rsync -avz --delete ~/Code/myartstarz/wp-content/themes/myartstarz-fse/ root@hetzner:/var/www/myartstarz.plaza.codes/public/wp-content/themes/myartstarz-fse/
```

After deploying, verify the site is loading correctly:

```bash
ssh hetzner "curl -sI https://myartstarz.plaza.codes/ | head -3"
```

If deploying plugin changes too:

```bash
rsync -avz ~/Code/myartstarz/wp-content/plugins/ root@hetzner:/var/www/myartstarz.plaza.codes/public/wp-content/plugins/
ssh hetzner "chown -R myartstarz_plaza_codes:myartstarz_plaza_codes /var/www/myartstarz.plaza.codes/public/wp-content/plugins/"
```

Always fix ownership after deploying:

```bash
ssh hetzner "chown -R myartstarz_plaza_codes:myartstarz_plaza_codes /var/www/myartstarz.plaza.codes/public/wp-content/themes/"
```
