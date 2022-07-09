<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Little Chat API</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@0,300;0,600;1,300&display=swap" rel="stylesheet">
</head>

<body>
    <h1>Chat API Documentation</h1>
    <div class="about">
        <h2>About the API</h2>
        <h3>API services</h3>
        <p>This API allows anyone to develop a front-end chat based on the following provided services:</p>
        <ul>
            <li>Connection and disconnection</li>
            <li>Messages exchange with connected users</li>
            <li>Chat with a bot</li>
        </ul>
        <h3>Restrictions</h3>
        <p>Please notice the following thechnical aspects of the service:</p>
        <ul>
            <li>This API works with Cookie Authentication. It means you first need to login before being able to access any service
                and your browser must accept cookie storage.</li>
            <li>Requests made from "localhost:*" do not work, please use 127.0.0.1 instead if you want to test.</li>
            <li>All users are disconnected after five minutes of inactivity</li>
        </ul>
        <p>Here you can try <a href="https://dev.timothe-dione.ch/chat"> an example of a front end use of the API. </a></p>
    </div>
    <div class="endpoints">
        <h2>API Endpoints</h2>
        <div class="endpoint">
            <h3 class="endpoint-title">Login</h3>
            <ul>
            <li class="endpoint-desc-p">Accepted methods: GET</li>
            <li class="endpoint-desc-p">Parameters: user (String)</li>
            <li class="endpoint-desc-p">Description: Register or Log in a user with the specified username and stores a cookie in the user browser.</li>
            <li class="endpoint-desc-p">Url: https://dev.timothee-dione.ch/chat/api/login</li>
            <li class="endpoint-desc-p">Example: https://dev.timothee-dione.ch/chat/api/login?user=johndoe</li>
            </ul>
        </div>
        <div class="endpoint">
            <h3 class="endpoint-title">Logout</h3>
            <ul>
            <li class="endpoint-desc-p">Accepted methods: GET</li>
            <li class="endpoint-desc-p">Parameters: null</li>
            <li class="endpoint-desc-p">Description: Logout the user.</li>
            <li class="endpoint-desc-p">Note: user must logged in before using this service.</li>
            <li class="endpoint-desc-p">Url: https://dev.timothee-dione.ch/chat/api/logout</li>
            <li class="endpoint-desc-p">Example: https://dev.timothee-dione.ch/chat/api/logout</li>
            </ul>
        </div>
        <div class="endpoint">
            <h3 class="endpoint-title">Check connection</h3>
            <ul>
            <li class="endpoint-desc-p">Accepted methods: GET</li>
            <li class="endpoint-desc-p">Parameters: null</li>
            <li class="endpoint-desc-p">Description: Recieve user connection state and its data if the user is connected.</li>
            <li class="endpoint-desc-p">url: https://dev.timothee-dione.ch/chat/api/check-connection</li>
            <li class="endpoint-desc-p">example: https://dev.timothee-dione.ch/chat/check-connection</li>
            </ul>
        </div>
        <div class="endpoint">
            <h3 class="endpoint-title">Get messages</h3>
            <ul>
            <li class="endpoint-desc-p">Accepted methods: GET</li>
            <li class="endpoint-desc-p">Parameters: null</li>
            <li class="endpoint-desc-p">Description: Retrieve all messages exchanged since user's last connection and updates user's last activity property.</li>
            <li class="endpoint-desc-p">Note: user must logged in before using this service.</li>
            <li class="endpoint-desc-p">url: https://dev.timothee-dione.ch/chat/api/messages</li>
            <li class="endpoint-desc-p">example: https://dev.timothee-dione.ch/chat/api/messages</li>
            </ul>
        </div>
        <div class="endpoint">
            <h3 class="endpoint-title">Add message</h3>
            <ul>
            <li class="endpoint-desc-p">Accepted methods: GET</li>
            <li class="endpoint-desc-p">Parameters: msg (String)</li>
            <li class="endpoint-desc-p">Description: Stores the message in the database.</li>
            <li class="endpoint-desc-p">Note: user must logged in before using this service.</li>
            <li class="endpoint-desc-p">url: https://dev.timothee-dione.ch/chat/api/messages/add</li>
            <li class="endpoint-desc-p">example: https://dev.timothee-dione.ch/chat/api/messages/add?msg=hello</li>
            </ul>
        </div>
        <div class="endpoint">
            <h3 class="endpoint-title">Get online users</h3>
            <ul>
            <li class="endpoint-desc-p">Accepted methods: GET</li>
            <li class="endpoint-desc-p">Parameters: null</li>
            <li class="endpoint-desc-p">Description: Retrieve all online users.</li>
            <li class="endpoint-desc-p">Note: user must logged in before using this service.</li>
            <li class="endpoint-desc-p">url: https://dev.timothee-dione.ch/chat/api/online-users</li>
            <li class="endpoint-desc-p">example: https://dev.timothee-dione.ch/chat/online-users</li>
            </ul>
        </div>
    </div>
    <div class="contact">
        <h2>Contact</h2>
        <p>Please feel free to contact me using <a href="https://timothee-dione.ch/contact">this contact form</a> 
        if you have something you want to share. You can also <a href="https://github.com/timo247">visit my Github</a>,
        or <a>check the API source code</a>, or <a>the front-end chat source code</a>. I hope you enjoy!</p>
    </div>
</body>

</html>

<style>
    body {
        font-family: 'Source Code Pro';
        margin: 2rem 3rem 4rem 3rem;
    }

    h1,h2 {
        text-align: center;
    }

    .about, .endpoint {
        margin: 0 0 4rem 0;
    }

    .endpoint-desc-p {
        list-style-type: none;
    }

</style>