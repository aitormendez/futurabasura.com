# Proyecto Futurabasura.com

Este proyecto usa el stack Roots (Trellis, Bedrock, Sage 11) con despliegue automatizado mediante GitHub Actions y un sistema de tareas simplificadas a través de Makefile.

---

## 🚀 Despliegue automatizado con GitHub Actions

El despliegue al servidor se realiza mediante workflows definidos en `.github/workflows/`, los cuales son ejecutados manualmente desde la interfaz web de GitHub o desde la terminal usando `gh`.

### Entornos

- `staging`: droplet en DigitalOcean con IP `178.128.168.215`
- `production`: definido en `hosts/production`, usa la misma clave SSH del proyecto

### Flujos definidos

#### 1. Deploy a staging

- Archivo: `.github/workflows/deploy-staging.yml`
- Disparador: manual (`workflow_dispatch`)
- Ejecución:

  - Desde GitHub: Actions → "Deploy to Staging" → Run workflow
  - Desde terminal:

    ```bash
    make deploy-staging
    ```

#### 2. Deploy a production

- Archivo: `.github/workflows/deploy-production.yml`
- Disparador: manual (`workflow_dispatch`)
- Ejecución:

  - Desde GitHub: Actions → "Deploy to Production" → Run workflow
  - Desde terminal:

    ```bash
    make deploy-production
    ```

### Requisitos

- Tener instalado y autenticado GitHub CLI:

  ```bash
  gh auth login
  ```

- Secretos definidos en GitHub:

  - `ANSIBLE_VAULT_PASSWORD`
  - `TRELLIS_DEPLOY_SSH_PRIVATE_KEY`
  - `TRELLIS_DEPLOY_SSH_KNOWN_HOSTS`

---

## ⚒️ Makefile

El archivo `Makefile` permite ejecutar tareas recurrentes de forma simple. Debe estar ubicado en la raíz del proyecto.

### Comandos disponibles

```bash
make build              # Compila tema Sage y plugin Gutenberg
make build-theme        # Compila solo el tema Sage
make build-plugin       # Compila solo el plugin Gutenberg
make deploy-staging     # Lanza deploy a staging (GitHub Actions)
make deploy-production  # Lanza deploy a producción (GitHub Actions)
```

> Nota: las tareas de deploy requieren tener `gh` instalado y los workflows definidos correctamente.

---

## 📃 Estructura del proyecto

```text
futurabasura.com/
├── Makefile
├── site/                  # Bedrock + WordPress
│   └── web/app/
│       ├── themes/sage/
│       └── plugins/fb-blocks/
├── trellis/               # Configuración de servidor y despliegue
│   └── public_keys/
└── .github/
    └── workflows/
        ├── deploy-staging.yml
        └── deploy-production.yml
```

---

## 💡 Buenas prácticas

- Usar `main` como rama única para staging y producción
- Hacer `Run workflow` manualmente según destino deseado
- Confirmar antes de desplegar que el entorno esté encendido
- Validar que la compilación con `make build` funciona correctamente antes de enviar cambios

---

Para cualquier modificación de clave o entorno, se recomienda ejecutar:

```bash
cd trellis
# Solo si hace falta regenerar la clave
trellis key generate
# Para actualizar el entorno remoto con la clave
trellis provision staging --tags=users
```
