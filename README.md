Fin-Vista

# Installation
- git clone the repository
- run composer install on it
- copy .env.example into .env
- sail up -d
- sail artisan key:generate
- npm install
- get an api key from https://www.alphavantage.co/
  - save this in the env ALPHAVANTAGE_API_KEY

## Shortcuts taken
There are a number of shortcuts for the sake of simplicity and time constrictions.
I decided to list them here, as to document them and show awareness.
- relying on incremental ids instead of uuids
- using the aggregate root as also dto. Separating them would be smart as the app grows 
- value objects introduce value but also overhead. Decided against them
- using Mail facade instead of a wrapper. For a more purist approach, pass Mailer via DI
- mailer creates the actual email, which should belong to the presentation layer (UI)
- repositories assigning ids to the created objects, so the consumer does not need to do so
- same model for presenting data. I need to think about UI
