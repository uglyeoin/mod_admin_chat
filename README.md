# Admin Chat

A Joomla administrator module that puts your support chat inside the admin, so
site editors can reach you without leaving Joomla.

Supported services:

- **Tawk.to**: paste the property/widget ID, or the whole embed snippet.
- **Crisp**: paste the website ID, or the whole snippet.
- **WhatsApp**: a floating "Support on WhatsApp" button that opens a chat with
  your number, with an optional opening message.

The Messenger option was removed in 5.1.0. Meta retired the Messenger chat plugin
in 2024. Sites still set to Messenger see a prompt to pick another service.

## Requirements

- Joomla 5.0 or later (tested on Joomla 6)
- PHP 8.1 or later

## Setup

1. Install the zip in System > Install > Extensions.
2. Open Content > Administrator Modules, find **Admin Chat**, and publish it in
   an admin position (for example `status` or `cpanel`).
3. Choose the chat service and fill in its details.

Updates come through the Joomla updater from kindofuseful.com.
