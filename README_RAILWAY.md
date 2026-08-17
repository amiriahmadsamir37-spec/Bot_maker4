# Railway

1. Put the whole project in a GitHub repository.
2. Deploy it in Railway and generate a public domain.
3. In Railway Variables add `BOT_TOKEN` containing the current token of the main bot.
4. Redeploy. `start.sh` registers the main webhook at `/bot.php`.
5. New sub-bots use the Railway public URL for their webhook instead of the old hosting domain.

Keep the GitHub repository private so the bot token is not exposed.
