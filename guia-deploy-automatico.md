# Guía Completa: Deploy Automático de Sage 11 con Trellis, Bedrock y GitHub Actions

Esta guía describe paso a paso cómo configurar un flujo de despliegue continuo para un proyecto basado en Roots (Trellis + Bedrock + Sage 11) mediante GitHub Actions. Incluye la integración con un plugin Gutenberg personalizado gestionado como submódulo, y el uso seguro de claves SSH en entornos staging y producción.

---

## 1. Requisitos previos

- Repositorio Git organizado con la estructura Roots:

  ```bash
  futurabasura.com/
  ├── site/                # WordPress via Bedrock
  │   ├── web/app/themes/sage
  │   └── web/app/plugins/fb-blocks (submódulo)
  ├── trellis/             # Ansible + server config
  └── .github/             # workflows para despliegue
  ```

- GitHub CLI instalado y autenticado: `gh auth login`

- Droplet o VPS provisionado con Trellis (Ubuntu, DigitalOcean, etc.)

- Deploy key generada y asociada al repo en GitHub como "read-only deploy key"

---

## 2. Uso de `npm` en todo el proyecto

Aunque originalmente se usaba `yarn` (y aún puede encontrarse en algunas guías antiguas), en este proyecto se ha migrado completamente a **`npm`**, por los siguientes motivos:

- `@wordpress/scripts` y otras herramientas modernas de WordPress están diseñadas y testeadas para trabajar con `npm`.
- Sage 11 ha eliminado menciones explícitas a `yarn` en su documentación.
- Yarn 2+ (Berry) introduce un sistema Plug'n'Play incompatible con muchas herramientas del ecosistema.

### Pasos para migrar el tema y el plugin a `npm` en caso de estar usando yarn (no será así por defecto)

#### A) En el tema Sage

```bash
cd site/web/app/themes/sage
rm yarn.lock
npm install
```

#### B) En el plugin Gutenberg (submódulo)

```bash
cd site/web/app/plugins/fb-blocks
rm yarn.lock package-lock.json
npm install
```

Luego, ajusta los comandos en el workflow y el Makefile.

---

## 3. Clonar e integrar los workflows desde `trellis-github-deployment`

1. Clona el repositorio base:

```bash
git clone https://github.com/MWDelaney/trellis-github-deployment .github
```

2. Copia desde `.github/workflows/` los archivos `deploy-staging.yml` y `deploy-production.yml` al mismo directorio en tu repo.
3. Adapta los archivos YAML eliminando los pasos innecesarios y personalizando:

   - ruta del tema
   - rutas de compilación
   - uso de submódulos

> Ejemplo actualizado del workflow se encuentra más abajo.

---

## 4. Generar claves SSH para GitHub Actions con Trellis CLI

Ejecuta desde el directorio `trellis`:

```bash
trellis key generate
```

Esto hará lo siguiente:

- Genera una clave SSH privada en `~/.ssh/trellis_<slug>_ed25519`
- Crea su clave pública correspondiente en `trellis/public_keys/`
- Añade la deploy key al repositorio de GitHub (si tienes acceso)
- Crea automáticamente los siguientes secretos en GitHub:

  - `TRELLIS_DEPLOY_SSH_PRIVATE_KEY`
  - `TRELLIS_DEPLOY_SSH_KNOWN_HOSTS`

Opcionalmente, también puede subir la clave al servidor con:

```bash
trellis provision --tags=users staging
```

> Cada proyecto debe tener su propia clave. Trellis se encarga de nombrarlas correctamente para que no haya conflictos en `~/.ssh`.

---

## 5. Configurar secretos en GitHub

En tu repositorio en GitHub, accede a:
`Settings → Secrets and variables → Actions → New repository secret`

Agrega los siguientes secretos **si no los ha creado automáticamente** `trellis key generate`:

- `ANSIBLE_VAULT_PASSWORD`: el contenido de tu archivo `trellis/.vault_pass`
- `TRELLIS_DEPLOY_SSH_PRIVATE_KEY`: la clave privada deploy
- `TRELLIS_DEPLOY_SSH_KNOWN_HOSTS`: salida de `ssh-keyscan -H github.com`
- `GITHUB_TOKEN`: variable ya incluida por GitHub, no hace falta agregarla manualmente

> 💡 **Nota:** Los valores de los secretos no son visibles una vez guardados. Si no estás seguro de haberlos añadido correctamente, puedes volver a subirlos sin problema.

---

## 6. Archivo `.github/workflows/deploy-staging.yml`

```yaml
name: 🚀 Deploy to Staging

on:
  workflow_dispatch:

jobs:
  deploy:
    name: Deploy to Staging
    runs-on: ubuntu-latest

    steps:
      # Clona el repositorio y los submódulos
      - name: Checkout repo (with submodules)
        uses: actions/checkout@v3
        with:
          submodules: recursive

      # Instala la clave SSH y known_hosts
      - name: Install SSH key and known_hosts
        uses: shimataro/ssh-key-action@v2
        with:
          key: ${{ secrets.TRELLIS_DEPLOY_SSH_PRIVATE_KEY }}
          known_hosts: ${{ secrets.TRELLIS_DEPLOY_SSH_KNOWN_HOSTS }}
          if_key_exists: replace

      # Instala y configura Trellis CLI
      - name: Setup Trellis CLI
        uses: roots/setup-trellis-cli@v1
        with:
          ansible-vault-password: ${{ secrets.ANSIBLE_VAULT_PASSWORD }}
          repo-token: ${{ secrets.GITHUB_TOKEN }}

      # Compila el tema Sage 11
      - name: Build Sage 11 Theme
        run: |
          cd site/web/app/themes/sage
          npm install
          npm run build

      # Instala dependencias PHP del tema
      - name: Install Sage PHP dependencies
        run: |
          cd site/web/app/themes/sage
          composer install --no-dev --no-interaction --optimize-autoloader

      # Compila el plugin Gutenberg
      - name: Build FB Blocks Plugin
        run: |
          cd site/web/app/plugins/fb-blocks
          npm install
          npm run build

      # Ejecuta el deploy con Trellis
      - name: Deploy to staging
        run: trellis deploy staging
```

> Crea un archivo similar para `deploy-production.yml`, cambiando `staging` por `production`.

---

## 7. Añadir claves SSH al Vault global

Editar el archivo:

```bash
ansible-vault edit trellis/group_vars/all/vault.yml
```

Añadir:

```yaml
vault_github_deploy_key: |
  -----BEGIN OPENSSH PRIVATE KEY-----
  tu-clave-aqui...
  -----END OPENSSH PRIVATE KEY-----
```

---

## 8. Modificar tareas del rol `deploy` para escribir la clave en el servidor

Editar `trellis/roles/deploy/tasks/main.yml`:

Insertar justo antes de `- import_tasks: initialize.yml`:

```yaml
- name: Ensure .ssh directory exists
  file:
    path: "/home/{{ web_user }}/.ssh"
    state: directory
    owner: "{{ web_user }}"
    group: "{{ web_group }}"
    mode: "0700"

- name: Write GitHub deploy key from Vault
  copy:
    content: "{{ vault_github_deploy_key }}"
    dest: "/home/{{ web_user }}/.ssh/github_deploy_key"
    owner: "{{ web_user }}"
    group: "{{ web_group }}"
    mode: "0600"

- name: Configure SSH to use GitHub deploy key
  copy:
    content: |
      Host github.com
        IdentityFile /home/{{ web_user }}/.ssh/github_deploy_key
        IdentitiesOnly yes
    dest: "/home/{{ web_user }}/.ssh/config"
    owner: "{{ web_user }}"
    group: "{{ web_group }}"
    mode: "0644"
```

---

## 9. Asegurar que la URL del repo usa formato SSH

Edita el archivo `trellis/group_vars/staging/wordpress_sites.yml` y asegúrate de que contenga algo similar a lo siguiente:

```yaml
wordpress_sites:
  futurabasura.com:
    site_hosts:
      - canonical: stage.futurabasura.com
    local_path: ../site
    branch: main
    repo: git@github.com:aitormendez/futurabasura.com.git
    repo_subtree_path: site
    multisite:
      enabled: false
    ssl:
      enabled: true
      provider: letsencrypt
    cache:
      enabled: true
      duration: 30s
      skip_cache_uri: "/wp-admin/|/wp-json/.*|/xmlrpc.php|wp-.*.php|/feed/|index.php|sitemap(_index)?.xml|/store.*|/cart.*|/my-account.*|/checkout.*|/addons.*|/checkout/"
      skip_cache_cookie: comment_author|wordpress_[a-f0-9]+|wp-postpass|wordpress_no_cache|wordpress_logged_in|woocommerce_cart_hash|woocommerce_items_in_cart|wp_woocommerce_session_|edd_items_in_cart
```

Haz lo mismo para `production` si lo estás usando.

> 💡 **Nota:** `repo_accepts_https` no es necesario cuando usas `git@github.com:...` como URL del repositorio.

---

## 10. Añadir `Makefile` para facilitar los comandos

```makefile
# Variables
BRANCH=main

# Deploy a staging via GitHub CLI
deploy-staging:
	gh workflow run deploy-staging.yml --ref $(BRANCH)

# Deploy a production via GitHub CLI
deploy-production:
	gh workflow run deploy-production.yml --ref $(BRANCH)

# Compilar tema Sage localmente
build-theme:
	cd site/web/app/themes/sage && npm install && npm run build

# Compilar plugin Gutenberg localmente
build-plugin:
	cd site/web/app/plugins/fb-blocks && npm install && npm run build

# Compilar todo localmente
build: build-theme build-plugin
```

---

## 11. Buenas prácticas

- Evita guardar claves privadas en archivos planos (usa Vault).
- Usa submódulos con `submodules: recursive`.
- No uses agent-forwarding con GitHub Actions.
- Verifica siempre que staging esté encendido antes de desplegar.
- Prefiere `npm` para máxima compatibilidad con WordPress y el ecosistema actual.

---

## 12. Resultado final

Al ejecutar:

```bash
make deploy-staging
```

GitHub Actions:

- Clona el repo
- Compila Sage 11 y el plugin Gutenberg
- Instala las dependencias PHP del tema
- Provisiona la clave en el servidor
- Despliega el sitio a staging con Trellis

Todo ello **de forma segura, reproducible y automatizada**.
