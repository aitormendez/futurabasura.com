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
