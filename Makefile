# make deploy            # deploy to staging (default)
# make deploy ENV=production
# make deploy-staging
# make build-theme
# make deploy-watch          # deploy to staging and watch it
# make deploy-watch ENV=production   # same, for production


# Variables globales
BRANCH ?= main
ENV ?= staging
THEME_PATH := site/web/app/themes/sage

# Colores para mensajes (opcional, solo para estética)
GREEN := \033[0;32m
NC := \033[0m

# Mostrar ayuda
help:
	@echo ""
	@echo "Usage: make [target] [ENV=staging|production]"
	@echo ""
	@echo "Targets:"
	@echo "  build-theme          Compile Sage theme"
	@echo "  deploy               Trigger deploy only (default: staging)"
	@echo "  deploy-watch         Trigger deploy and watch until finished"
	@echo "  deploy-staging       Shortcut to deploy to staging"
	@echo "  deploy-production    Shortcut to deploy to production"
	@echo ""

# Compilar tema Sage
build-theme:
	@echo "$(GREEN)> Building Sage theme...$(NC)"
	cd $(THEME_PATH) && npm install && npm run build

# Desplegar al entorno indicado (sin esperar)
deploy:
	@echo "$(GREEN)> Deploying to $(ENV)...$(NC)"
	gh workflow run deploy-$(ENV).yml --ref $(BRANCH)

# Desplegar y ver progreso en terminal
deploy-watch:
	@echo "$(GREEN)> Triggering deploy to $(ENV)...$(NC)"
	gh workflow run deploy-$(ENV).yml --ref $(BRANCH)
	@echo "$(GREEN)> Waiting for workflow to start...$(NC)"
	sleep 5
	@RUN_ID=$$(gh run list --workflow=deploy-$(ENV).yml --limit=1 --json databaseId --jq '.[0].databaseId'); \
	echo "$(GREEN)> Watching deploy run $$RUN_ID...$(NC)"; \
	gh run watch $$RUN_ID

# Atajos específicos para staging y production
deploy-staging:
	$(MAKE) deploy ENV=staging

deploy-production:
	$(MAKE) deploy ENV=production
