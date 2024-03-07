php spark make:controller BB --suffix

## Run Server:
php spark serve

## Run Tailwind:
npx tailwindcss -i ./public/css/input.css -o ./public/css/styles.css --watch

## Prepare for Production:
npx tailwindcss -o build.css --minify

## Run WebSocket
php public/index.php Websocket start