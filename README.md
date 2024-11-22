<p
    align="center"
    style="text-align: center">
    <img src="./resources/images/logo/logo.svg" style="width: 600px;">
</p>

<h1 style="text-align: center;">Bookopia</h1>

## Build and Run

To build the application you should install **composer** and **node** packages:

```bash
composer install
npm install
```

After that, you should run the servers to use the application:

```bash
npm run dev
```

and in another terminal:

```bash
php artisan serv
```

## Troubleshoot

If an error appear saying that there is no method called `is_admin()`,
run the following line:

```bash
composer dump-autoload
```
