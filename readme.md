# Proyecto Futurabasura.com

Este proyecto usa el stack Roots (Trellis, Bedrock, Sage 11) con despliegue automatizado mediante GitHub Actions y un sistema de tareas simplificadas a través de Makefile. También integra un plugin Gutenberg personalizado gestionado como submódulo Git y el uso de claves SSH seguras mediante Ansible Vault.

---

## 🚀 Despliegue automatizado con GitHub Actions

El despliegue al servidor se realiza mediante workflows definidos en `.github/workflows/`, ejecutados manualmente desde la interfaz web de GitHub o desde la terminal usando `gh`.

### Entornos

- `staging`: droplet en DigitalOcean con IP `178.128.168.215`
- `production`: definido en `hosts/production`, usa la misma clave SSH del proyecto

### Workflows disponibles

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

### Seguridad con Ansible Vault

La clave SSH privada utilizada por el servidor para clonar el repositorio de GitHub está almacenada en Vault de forma segura:

```yaml
vault_github_deploy_key: |
  -----BEGIN OPENSSH PRIVATE KEY-----
  ...
  -----END OPENSSH PRIVATE KEY-----
```

Esta clave se escribe automáticamente en el servidor mediante tareas añadidas a `roles/deploy/tasks/main.yml`.

### Submódulo `fb-blocks`

El plugin Gutenberg personalizado `fb-blocks` está gestionado como submódulo Git en:

```
site/web/app/plugins/fb-blocks
```

Para que esté disponible durante los despliegues en GitHub Actions, se ha habilitado la opción `submodules: recursive` en el paso `actions/checkout@v3` de cada workflow. Esto permite que se clone automáticamente junto con el repositorio principal.

Asegúrate de que el submódulo está actualizado y apuntando a una rama o commit válido antes de lanzar un deploy.

---

## ⚙️ Makefile

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
│       └── plugins/fb-blocks/  # Submódulo Git
├── trellis/               # Configuración de servidor y despliegue
│   ├── public_keys/
│   └── roles/deploy/tasks/main.yml (modificado)
└── .github/
    └── workflows/
        ├── deploy-staging.yml
        └── deploy-production.yml
```

---

## 💡 Buenas prácticas

- Usar `main` como rama única para staging y producción (si se desea simplificar)
- Hacer `Run workflow` manualmente según destino deseado
- Confirmar antes de desplegar que el entorno esté encendido
- Validar que la compilación con `make build` funciona correctamente antes de enviar cambios
- Asegurarse de que el submódulo `fb-blocks` esté actualizado antes del deploy
- Utilizar Vault para guardar claves privadas y no exponerlas en el repo

---

Para cualquier modificación de clave o entorno, se recomienda ejecutar:

```bash
cd trellis
# Solo si hace falta regenerar la clave
trellis key generate
# Para actualizar el entorno remoto con la clave
trellis provision --tags=users staging
```

---

¡Despliegue automatizado y seguro listo para producción!
