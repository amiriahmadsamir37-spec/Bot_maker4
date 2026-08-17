# Railway setup

1. Upload the entire contents of this ZIP to GitHub.
2. Deploy the repository in Railway.
3. In Railway Variables add:
   BOT_TOKEN = your current Telegram bot token
   ADMIN_ID = 7575502917
4. Generate a public domain.
5. Redeploy.

The project keeps the bot/sub-bot source folders. Sub-bots still require their
template files and a public webhook URL. The code must only report a sub-bot
as started after Telegram accepts its webhook.
