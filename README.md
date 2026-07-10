# Portfolio site

A developer portfolio built as a single themed "code editor" — line numbers,
a git-log timeline for experience, and a terminal-style contact form.

## Requirements

- PHP 8.1+
- No database needed. No external services needed to run it.

## Run it locally

From this folder:

```bash
php -S localhost:8000
```

Then open `http://localhost:8000` in your browser.

## Deploy it

Upload the whole folder to any standard PHP host (shared hosting, a VPS,
etc.) and point the domain at `index.php`. Just make sure the `data/`
folder is writable by the web server (`chmod 755 data` is usually enough;
`chmod 777 data` if your host is strict about it) — that's where contact
form submissions get saved, as `data/messages.json`.

## Customize it

Everything you'd actually want to change — your name, bio, skills,
projects, work history, and contact links — lives in **`config.php`**.
Open it and edit the arrays; `index.php` just loops over whatever is there,
so adding a new project or job is as simple as adding a new array entry.

## Contact form

Submissions are saved to `data/messages.json` rather than emailed, since
most dev/shared hosts don't have an outgoing mail server configured, and
`mail()` fails silently in that case. To send real email instead, open
`contact-handler.php` and swap the `file_put_contents()` block for `mail()`
or a transactional email API (Postmark, SES, Resend, etc).

## Files

```
index.php              Main page — renders everything from config.php
config.php              Your editable content (name, projects, etc.)
contact-handler.php     Validates + stores contact form submissions
assets/style.css        All styling
assets/script.js        Scroll-spy nav + form "sending" state
data/messages.json      Where contact form submissions are saved
```
