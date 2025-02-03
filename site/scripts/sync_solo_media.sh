#!/bin/bash

# Syncing only media files in Trellis & Bedrock-based WordPress environments
# Based on the original script by Ben Word
# This version ONLY syncs media files (uploads) and does NOT touch the database.

DEVDIR="web/app/uploads/"
DEVSITE="https://futurabasura.test"

PRODDIR="web@futurabasura.com:/srv/www/futurabasura.com/shared/uploads/"
PRODSITE="https://futurabasura.com"

STAGDIR="web@stage.futurabasura.com:/srv/www/futurabasura.com/shared/uploads/"
STAGSITE="https://stage.futurabasura.com"

LOCAL=false
POSITIONAL_ARGS=()

while [[ $# -gt 0 ]]; do
  case $1 in
    --local)
      LOCAL=true
      shift
      ;;
    --*)
      echo "Unknown option $1"
      exit 1
      ;;
    *)
      POSITIONAL_ARGS+=("$1")
      shift
      ;;
  esac
done

set -- "${POSITIONAL_ARGS[@]}"

if [ $# != 2 ]; then
  echo "Usage: $0 [--local] [ENV_FROM] [ENV_TO]"
  exit 1
fi

FROM=$1
TO=$2

bold=$(tput bold)
normal=$(tput sgr0)

case "$1-$2" in
  production-development) DIR="down ⬇️ ";  FROMSITE=$PRODSITE; FROMDIR=$PRODDIR; TOSITE=$DEVSITE;  TODIR=$DEVDIR; ;;
  staging-development)    DIR="down ⬇️ ";  FROMSITE=$STAGSITE; FROMDIR=$STAGDIR; TOSITE=$DEVSITE;  TODIR=$DEVDIR; ;;
  development-production) DIR="up ⬆️ ";    FROMSITE=$DEVSITE;  FROMDIR=$DEVDIR;  TOSITE=$PRODSITE; TODIR=$PRODDIR; ;;
  development-staging)    DIR="up ⬆️ ";    FROMSITE=$DEVSITE;  FROMDIR=$DEVDIR;  TOSITE=$STAGSITE; TODIR=$STAGDIR; ;;
  production-staging)     DIR="horizontally ↔️ "; FROMSITE=$PRODSITE; FROMDIR=$PRODDIR; TOSITE=$STAGSITE; TODIR=$STAGDIR; ;;
  staging-production)     DIR="horizontally ↔️ "; FROMSITE=$STAGSITE; FROMDIR=$STAGDIR; TOSITE=$PRODSITE; TODIR=$PRODDIR; ;;
  *) echo "usage: $0 [--local] production development | staging development | development staging | development production | staging production | production staging" && exit 1 ;;
esac

echo
echo "Would you really like to sync media files..."
echo "   from ${bold}$FROM${normal} ($FROMSITE)"
echo "   to ${bold}$TO${normal} ($TOSITE)?"
read -r -p " [y/N] " response

if [[ "$response" =~ ^([yY][eE][sS]|[yY])$ ]]; then
  cd ../ &&
  echo

  availfrom() {
    local AVAILFROM
    if [[ "$LOCAL" = true && $FROM == "development" ]]; then
      AVAILFROM=$(wp option get home 2>&1)
    else
      AVAILFROM=$(wp "@$FROM" option get home 2>&1)
    fi
    if [[ $AVAILFROM == *"Error"* ]]; then
      echo "❌  Unable to connect to $FROM"
      exit 1
    else
      echo "✅  Able to connect to $FROM"
    fi
  };
  availfrom

  availto() {
    local AVAILTO
    if [[ "$LOCAL" = true && $TO == "development" ]]; then
      AVAILTO=$(wp option get home 2>&1)
    else
      AVAILTO=$(wp "@$TO" option get home 2>&1)
    fi

    if [[ $AVAILTO == *"Error"* ]]; then
      echo "❌  Unable to connect to $TO $AVAILTO"
      exit 1
    else
      echo "✅  Able to connect to $TO"
    fi
  };
  availto

  echo "Syncing media files..."
  chmod -R 755 web/app/uploads/ &&
  if [[ $DIR == "horizontally"* ]]; then
    [[ $FROMDIR =~ ^(.*): ]] && FROMHOST=${BASH_REMATCH[1]}
    [[ $FROMDIR =~ ^(.*):(.*)$ ]] && FROMDIR=${BASH_REMATCH[2]}
    [[ $TODIR =~ ^(.*): ]] && TOHOST=${BASH_REMATCH[1]}
    [[ $TODIR =~ ^(.*):(.*)$ ]] && TODIR=${BASH_REMATCH[2]}

    ssh -o ForwardAgent=yes $FROMHOST "rsync -aze 'ssh -o StrictHostKeyChecking=no' --progress $FROMDIR $TOHOST:$TODIR"
  else
    rsync -az --progress "$FROMDIR" "$TODIR"
  fi

  echo -e "\n🔄  Media files sync from $FROM to $TO complete.\n\n    ${bold}$TOSITE${normal}\n"
fi
