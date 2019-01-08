# A PDF to HTML Parsing application built on Laravel with Vue.js and Typescript.

This is a simple boilerplate for operating a site that converts PDF files to HTML files.

## Installation

First, let's grab our dependencies:

1. `composer install`
2. `yarn`

This application makes user of pusher and queues to offload heavy processing from the main thread. In order to make use of these technologies you must configure the following:

1. In your `.env` file set your `BROADCAST_DRIVER=pusher`.
2. In your `.env` file set your`QUEUE_DRIVER` set it to `redis`.
3. Create a free account at pusher.js and create an associated application, then fill in the following:

```env
PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=
```

4. As private channels require user authentication, default dummy users are created for our end-users. These can be made into real accounts after they've successfully converted their files. To support this, you must migrate your database:

```php
php artisan migrate
```

Finally, you must have installed the `plopper-utils` binary to perform the conversion. More detailed instructions can be found [https://github.com/garrensweet/pdf-to-html](https://github.com/garrensweet/pdf-to-html).

Once you've completed the above step, you must add the following settings to your `.env` file:

```env
PDFTOHTML_BIN_PATH=/usr/local/bin/pdftohtml
PDFINFO_BIN_PATH=/usr/local/bin/pdfinfo
```

## Closing Thoughts

That's it! You can now raise the application and run it.

If you have any problem feel free to submit an issue and I'll do what I can to help guide you.
