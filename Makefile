# make deploy            # deploy to staging (default)
# make deploy ENV=production
# make deploy-staging
# make build-theme


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
	@echo "  deploy               Deploy to specified environment (default: staging)"
	@echo "  deploy-staging       Shortcut to deploy to staging"
	@echo "  deploy-production    Shortcut to deploy to production"
	@echo ""

# Compilar tema Sage
build-theme:
	@echo "$(GREEN)> Building Sage theme...$(NC)"
	cd $(THEME_PATH) && npm install && npm run build

# Desplegar al entorno indicado
deploy:
	@echo "$(GREEN)> Deploying to $(ENV)...$(NC)"
	gh workflow run deploy-$(ENV).yml --ref $(BRANCH)

# Atajos específicos para staging y production
deploy-staging:
	$(MAKE) deploy ENV=staging

deploy-production:
	$(MAKE) deploy ENV=production
