#!/bin/sh
set -eu
PORT="${PORT:-8080}"
DOMAIN="${PUBLIC_URL:-${RAILWAY_PUBLIC_DOMAIN:-}}"
if [ -z "${BOT_TOKEN:-}" ]; then
  echo "ERROR: BOT_TOKEN is not set in Railway Variables."
  exit 1
fi
if [ -z "${DOMAIN}" ]; then
  echo "ERROR: Generate a Railway public domain or set PUBLIC_URL."
  exit 1
fi
DOMAIN="${DOMAIN#https://}"
DOMAIN="${DOMAIN#http://}"
DOMAIN="${DOMAIN%/}"
WEBHOOK="https://${DOMAIN}/bot.php"
echo "Registering webhook: ${WEBHOOK}"
RESPONSE="$(curl -fsS -X POST "https://api.telegram.org/bot${BOT_TOKEN}/setWebhook" --data-urlencode "url=${WEBHOOK}")"
echo "Telegram: ${RESPONSE}"
echo "${RESPONSE}" | grep -q '"ok":true' || {
  echo "ERROR: Telegram did not accept the webhook."
  exit 1
}
exec php -S "0.0.0.0:${PORT}" -t /app
