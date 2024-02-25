Fin-Vista*-
| 

- [ ] Backend to-do list:
  - [x] Users can create companies with name, description, address
    - [ ] add logo with aws s3
    - [ ] redirect unauthorized users 
  - [ ] Users can see companies
  - [x] Users can register
  - [ ] Registered users can login
    - [x] an email with login token is sent
    - [ ] logging token can be used to authenticate
  
- [ ] Frontend to-do list:
  - [ ] Landing page
  - [ ] Company listing
    - [ ] add realtime stock value from NASDAQ
  - [ ] Create company page
  - [ ] Add login page/modal
  - [ ] Add register page/modal

## Shortcuts taken
There are a number of shortcuts for the sake of simplicity and time constrictions.
I decided to list them here, as to document them and show awareness.
- relying on incremental ids instead of uuids
- using the aggregate root as also dto. Separating them would be smart as the app grows 
- value objects introduce value but also overhead. Decided against them
- using Mail facade instead of a wrapper. For a more purist approach, pass Mailer via DI
- mailer creates the actual email, which should belong to the presentation layer (UI)
- repositories assigning ids to the created objects, so the consumer does not need to do so
