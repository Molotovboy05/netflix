<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noflix</title>
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
</head>
<body>
    




<script>
    // SIMULATION DE L'ENVIRONEMENT DE TELEGRAM
function createMockTelegramWebApp() {
    return {
        initDataUnsafe: {
            user: { id: 123, first_name: 'aiko', username: 'aikowoop' },
            chat: { id: 456, type: 'private' }
        },
        showAlert: (message) => console.log('Alert:', message),
        showConfirm: (message, callback) => {
            console.log('Confirm:', message);
            callback(true); // Simule toujours une confirmation positive
        },
        // Ajoutez d'autres méthodes selon vos besoins
    };
}

// Utilisation
if (!window.Telegram) {
    window.Telegram = { WebApp: createMockTelegramWebApp() };
}


const tg = window.Telegram.WebApp;
tg.showAlert ('salut , je fait une alert ') ;

tg.showConfirm("Êtes-vous sûr de vouloir continuer ?", (confirmed) => {
    if (confirmed) {
        console.log("L'utilisateur a confirmé");
        // Exécuter l'action confirmée
    } else {
        console.log("L'utilisateur a annulé");
        // Gérer l'annulation
    }
});

</script>
</body>
</html>