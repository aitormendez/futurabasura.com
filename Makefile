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
	cd site/web/app/themes/sage && enable && yarn && yarn build

# Compilar plugin Gutenberg localmente
build-plugin:
	cd site/web/app/plugins/fb-blocks && yarn && yarn build

# Compilar todo localmente
build: build-theme build-plugin
