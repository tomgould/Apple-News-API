#!/usr/bin/env bash
# Build the PHPDoc reference and publish it to https://applenews.dealmobile.co.uk
#
#   tools/deploy-docs.sh               generate, add the analytics beacon, upload
#   tools/deploy-docs.sh --build-only  generate into a temporary folder and stop
#
# The HTML is generated fresh into a temporary folder, never into git. Cloudflare
# Web Analytics is added to every .html file there, on a real deploy only, so
# the docs you open locally (docs/html) never load it.
#
# Needs tools/phpDocumentor.phar (composer docs:install). Upload is rsync over
# SSH; the login comes from ~/.config/dealmobile/hosting.env (SSH_HOST, SSH_USER,
# SSH_PORT), plus SSH_KEY (a private key path) if set there or in the environment. Nothing
# secret is printed.
set -euo pipefail

HERE="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
ENV_FILE="${DEALMOBILE_ENV:-$HOME/.config/dealmobile/hosting.env}"
REMOTE_BASE="${REMOTE_BASE:-additional_domains/applenews.dealmobile.co.uk/public_html}"
SITE_ORIGIN="https://applenews.dealmobile.co.uk"
# Cloudflare Web Analytics site token: public by design, it is sent to every visitor
CF_BEACON_TOKEN="${CF_BEACON_TOKEN:-717799c0f58d40e388c19030b5f25a1e}"
BUILD_ONLY=0
[[ "${1:-}" == "--build-only" ]] && BUILD_ONLY=1

[[ -f "$HERE/tools/phpDocumentor.phar" ]] || { echo "tools/phpDocumentor.phar is missing: run composer docs:install" >&2; exit 1; }

WORK="$(mktemp -d)"
trap 'rm -rf "$WORK"' EXIT
OUT="$WORK/html"

echo "== Generating the reference"
(cd "$HERE" && php tools/phpDocumentor.phar run -d src -t "$OUT" \
    --cache-folder "$WORK/cache" --title='Apple News API PHP Client' --no-interaction -q)
COUNT="$(find "$OUT" -name '*.html' | wc -l)"
[[ "$COUNT" -gt 0 ]] || { echo "no HTML was generated" >&2; exit 1; }
echo "$COUNT pages"

if [[ $BUILD_ONLY == 1 ]]; then
    echo "Built into $OUT (removed on exit); no analytics added, nothing uploaded"
    exit 0
fi

echo "== Adding Cloudflare Web Analytics to every page"
export BEACON="<!-- Cloudflare Web Analytics --><script type='module' src='https://static.cloudflareinsights.com/beacon.min.js' data-cf-beacon='{\"token\": \"$CF_BEACON_TOKEN\"}'></script><!-- End Cloudflare Web Analytics -->"
find "$OUT" -name '*.html' -print0 | xargs -0 perl -0pi -e 's#</body>#$ENV{BEACON}\n</body>#'
MISSING="$(grep -L 'static.cloudflareinsights.com' -r "$OUT" --include='*.html' | wc -l)"
[[ "$MISSING" == 0 ]] || { echo "$MISSING pages have no </body> to inject before" >&2; exit 1; }

echo "== Uploading"
[[ -f "$ENV_FILE" ]] || { echo "credentials file not found: $ENV_FILE" >&2; exit 1; }
set -a
# shellcheck disable=SC1090
source "$ENV_FILE"
set +a
: "${SSH_HOST:?missing}" "${SSH_USER:?missing}" "${SSH_PORT:?missing}"
SSH_CMD=(ssh -o BatchMode=yes -p "$SSH_PORT")
# SSH_KEY is optional: without it ssh uses its normal keys and agent
[[ -n "${SSH_KEY:-}" ]] && SSH_CMD+=(-i "$SSH_KEY")
# --delete clears removed pages; cgi-bin and the site's .htaccess are left alone
rsync -rlt --delete --exclude=/cgi-bin/ --exclude=/.htaccess --chmod=D755,F644 \
    -e "${SSH_CMD[*]}" \
    "$OUT/" "$SSH_USER@$SSH_HOST:$REMOTE_BASE/" 2> >(grep -v tput >&2)

echo "== Checking"
curl -fsS -m 20 "$SITE_ORIGIN/" | grep -q 'static.cloudflareinsights.com' && echo "ok  beacon is on $SITE_ORIGIN/"
echo "Published to $SITE_ORIGIN"
