importScripts('https://www.gstatic.com/firebasejs/3.9.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/3.9.0/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing in the
// messagingSenderId.
firebase.initializeApp({
    'messagingSenderId': '873708787367'
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();

//const receiveEvent = new Event('messageReceived');

var listener = new BroadcastChannel('bgListener');

messaging.setBackgroundMessageHandler(function(payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);
    // Customize notification here
    const notificationTitle = payload.data.title;
    const notificationOptions = {
        click_action: "https://google.com",
        body: payload.data.body,
        icon: payload.data.icon,

    };

    listener.postMessage(payload.data);

    return self.registration.showNotification(notificationTitle,
        notificationOptions);
});