 Little Chat API 
 See the result App here: View the result on  this address: https://dev.timothee-dione.ch/mini-chat 

Chat API Documentation
======================

About the API
-------------

### API services

This API allows anyone to develop a front-end chat based on the following provided services:

* Connection and disconnection
* Messages exchange with connected users
* Chat with a bot

### Restrictions

Please notice the following thechnical aspects of the service:

* This API works with Cookie Authentication. It means you first need to login before being able to access any service and your browser must accept cookie storage.
* Requests made from "localhost:*" do not work, please use 127.0.0.1 instead if you want to test.
* All users are disconnected after five minutes of inactivity

Here you can try [an example of a front end use of the API.](https://dev.timothe-dione.ch/chat)

API Endpoints
-------------

### Login

* Accepted methods: GET
* Parameters: user (String)
* Description: Register or Log in a user with the specified username and stores a cookie in the user browser.
* Url: https://dev.timothee-dione.ch/chat/api/login
* Example: https://dev.timothee-dione.ch/chat/api/login?user=johndoe

### Logout

* Accepted methods: GET
* Parameters: null
* Description: Logout the user.
* Note: user must logged in before using this service.
* Url: https://dev.timothee-dione.ch/chat/api/logout
* Example: https://dev.timothee-dione.ch/chat/api/logout

### Check connection

* Accepted methods: GET
* Parameters: null
* Description: Recieve user connection state and its data if the user is connected.
* url: https://dev.timothee-dione.ch/chat/api/check-connection
* example: https://dev.timothee-dione.ch/chat/check-connection

### Get messages

* Accepted methods: GET
* Parameters: null
* Description: Retrieve all messages exchanged since user's last connection and updates user's last activity property.
* Note: user must logged in before using this service.
* url: https://dev.timothee-dione.ch/chat/api/messages
* example: https://dev.timothee-dione.ch/chat/api/messages

### Add message

* Accepted methods: GET
* Parameters: msg (String)
* Description: Stores the message in the database.
* Note: user must logged in before using this service.
* url: https://dev.timothee-dione.ch/chat/api/messages/add
* example: https://dev.timothee-dione.ch/chat/api/messages/add?msg=hello

### Get online users

* Accepted methods: GET
* Parameters: null
* Description: Retrieve all online users.
* Note: user must logged in before using this service.
* url: https://dev.timothee-dione.ch/chat/api/online-users
* example: https://dev.timothee-dione.ch/chat/online-users

Contact
-------

Please feel free to contact me using [this contact form](https://timothee-dione.ch/contact) if you have something you want to share.
