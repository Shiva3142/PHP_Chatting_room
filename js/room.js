let id = 0

async function getMessage() {
    try {
        let response = await fetch('http://localhost/SK_PHP_PROJECTS/PHP_Chatting_room/get.php', {
            method: 'POST',
            headers: {
                'Content-Type': "Application/json"
            },
            body: JSON.stringify({
                id
            })
        })
        let result = await response.json();
        console.log(result);
        if (result.status != true) {
            left_the_chat();
            window.location = '/SK_PHP_PROJECTS/PHP_Chatting_room/deleted.html';
        } else {
            if (result.id != id) {
                let messageContainer = document.getElementsByClassName('message_container')[0];
                let isscrolltime = (messageContainer.scrollHeight - messageContainer.scrollTop - messageContainer.clientHeight) == 0 || (messageContainer.scrollHeight - messageContainer.scrollTop - messageContainer.clientHeight) < 150;


                
                messageContainer.innerHTML = messageContainer.innerHTML + result.result_html;
                if (isscrolltime) {
                    messageContainer.scrollTop = messageContainer.scrollHeight;
                    console.log('scrolled');
                }
                if (id == 0) {
                    messageContainer.scrollTop = messageContainer.scrollHeight;
                }
                id = result.id;
            }
        }
        console.log(id);
    } catch (error) {
        console.log(error);
    }
}
async function getUsersList() {
    try {
        let response = await fetch('http://localhost/SK_PHP_PROJECTS/PHP_Chatting_room/get_users_list.php', {method: 'POST',})
        let result = await response.json();
        console.log(result);
        if (result.status != true) {
            left_the_chat();
            window.location = '/SK_PHP_PROJECTS/PHP_Chatting_room/deleted.html';
        } else {
                let userlists = document.getElementById('userlists');
                userlists.innerHTML = result.result_html;
        }
    } catch (error) {
        console.log(error);
    }
}

getMessage()
getUsersList()
async function sendMessage(event) {
    event.preventDefault();
    // console.log(event);
    massage = document.getElementById('message');
    // console.log(message);
    messageText = message.value
    message.value = "";
    if (messageText == "") {
        console.log('not send');
    } else {
        console.log('send');
        try {
            // let httprequest=new XMLHttpRequest()
            // httprequest.open('post','http://localhost/SK_PHP_PROJECTS/PHP_Chatting_room/send.php')
            // httprequest.setRequestHeader('Content-type','application/json')
            // httprequest.onload=function(){
            //     console.log(JSON.parse(this.responseText));
            // }
            // httprequest.send(JSON.stringify({message:messageText}));
            let response = await fetch('http://localhost/SK_PHP_PROJECTS/PHP_Chatting_room/send.php', {
                method: 'POST',
                headers: {
                    "Content-Type": "Application/json"
                },
                body: JSON.stringify({
                    message: messageText
                })
            })
            console.log(response);
            let result = await response.json()
            console.log(result);
            getMessage();
        } catch (error) {
            console.log(error);
        }
    }
}



if (performance.navigation.type == performance.navigation.TYPE_RELOAD) {
    console.info("This page is reloaded");
    // left_the_chat()
} else {
    console.info("This page is not reloaded");
    notify_chat('join');
}

async function notify_chat(element) {
    let response = await fetch('http://localhost/SK_PHP_PROJECTS/PHP_Chatting_room/notify.php', {
        method: 'POST',
        headers: {
            "Content-Type": "Application/json"
        },
        body: JSON.stringify({
            message: element
        })
    })
}
async function left_the_chat() {
    notify_chat('left')
    let response = await fetch('http://localhost/SK_PHP_PROJECTS/PHP_Chatting_room/left.php', {
        method: 'POST'
    });
    window.location = '/SK_PHP_PROJECTS/PHP_Chatting_room/home.php';
}
async function delete_chatroom() {
    let response = await fetch('http://localhost/SK_PHP_PROJECTS/PHP_Chatting_room/delete_chatroom.php', {
        method: 'POST'
    });
    window.location = '/SK_PHP_PROJECTS/PHP_Chatting_room/deleted.html';
}

let autorefresh_messages = setInterval(getMessage, 1000);
let autorefresh_users = setInterval(getUsersList, 3000);

// function startAndStopAutoRefreshing() {
//     let autorefreshbutton = document.getElementById('autorefreshbutton');
//     if (autorefresh == null) {
//         autorefreshbutton.innerHTML = "OFF AutoRefresh"
//         autorefresh = setInterval(getMessage, 1000);
//     } else {
//         autorefreshbutton.innerHTML = "ON AutoRefresh"
//         clearInterval(autorefresh);
//         autorefresh = null
//     }
// }

function hideuserlist() {
    document.getElementsByClassName('chatroomcontainer')[0].style.display='flex'
    document.getElementsByClassName('userslistcontainer')[0].style.display='none'
}
function showuserlist() {
    document.getElementsByClassName('chatroomcontainer')[0].style.display='none'
    document.getElementsByClassName('userslistcontainer')[0].style.display='block'
}
window.addEventListener('resize',()=>{
    if (window.screen.width>900) {
        document.getElementsByClassName('chatroomcontainer')[0].style.display='flex'
        document.getElementsByClassName('userslistcontainer')[0].style.display='block'
    }

})